<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Payment;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\StockOutProduct;
use App\Models\Supplier_Ledger;
use Illuminate\Support\Facades\DB;
use App\Models\Branch_Ledger;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function index()
    {
        $data = Purchase::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }



    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            if ($request->hasFile('bill_image')) {
                $image_name = time() . '.' . $request->bill_image->extension();
                $request->bill_image->move(public_path('uploads/purchase'), $image_name);
                $image = $image_name;
            } else {
                $image = null;
            }

            // 1. Insert into purchases table
            $purchase = Purchase::create([
                'date'             => $request->date,
                'supplier_name'    => $request->supplier_name,
                'category'         => $request->category,
                'item_name'        => $request->item_name,
                'quantity'         => $request->quantity,
                'unit_price'       => $request->unit_price,
                'purchase_amount'  => $request->purchase_amount,
                'bill_image'       => $image,
                'remarks'          => $request->remarks,
                'driver_name'      => $request->driver_name,
                'branch_name'      => $request->branch_name,
                'fuel_capacity'      => $request->fuel_capacity,
                'fuel_category'      => $request->fuel_category,
                'service_cost'      => $request->service_cost,
                'vehicle_no'       => $request->vehicle_no,
                'status'           => "pending",
                'priority'           => $request->priority,
                'validity'           => $request->validity,
                'created_by'       => $request->created_by,
            ]);


            if ($request->category == "engine_oil") {


                $lastStock = StockOutProduct::orderBy('id', 'desc')->value('total_stock') ?? 0;


                $newTotalStock = $lastStock + $request->quantity;


                StockOutProduct::create([
                    'date'              => $request->date,
                    'product_category'  => 'Purchase',
                    'product_name'      => $request->product_name,
                    'purchase_id'       => $purchase->id,
                    'stock_in'          => $request->quantity,
                    'total_stock'       => $newTotalStock,
                ]);
            }


            Supplier_Ledger::create([
                'date'            => $request->date,
                'mode'            => 'Purchase',
                'purchase_id'     => $purchase->id,
                'purchase_amount'  => $request->purchase_amount,
                'unit_price'      => $request->unit_price,
                'created_by'      => $request->created_by,
                'catagory'        => $request->category,
                'supplier_name'   => $request->supplier_name,
                'item_name'       => $request->item_name,
                'quantity'        => $request->quantity,
                'remarks'         => $request->remarks,
            ]);


            Payment::create([
                'date'             => $request->date,
                'supplier_name'    => $request->supplier_name,
                'category'         => $request->category,
                'item_name'        => $request->item_name,
                'purchase_id'        => $purchase->id,
                'quantity'         => $request->quantity,
                'unit_price'       => $request->unit_price,
                'total_amount'  => $request->purchase_amount,
                'remarks'          => $request->remarks,
                'driver_name'      => $request->driver_name,
                'branch_name'      => $request->branch_name,
                'pay_amount'      => "0",
                'due_amount'      =>$request->purchase_amount ,
                'vehicle_no'       => $request->vehicle_no,
                'status'           => "pending",
                'created_by'       => $request->created_by,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Purchase created successfully',
                'data'    => $purchase
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }



    public function show($id)
    {
        $data = Purchase::findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $purchase = Purchase::findOrFail($id);

            // Handle bill image update
            if ($request->hasFile('bill_image')) {
                $imageName = time() . '.' . $request->bill_image->extension();
                $request->bill_image->move(public_path('uploads/purchase'), $imageName);
                $image = $imageName;
            } else {
                $image = $purchase->bill_image; // Keep existing if not changed
            }

            // 1. Update purchase table
            $purchase->update([
                 'date'             => $request->date,
                'supplier_name'    => $request->supplier_name,
                'category'         => $request->category,
                'item_name'        => $request->item_name,
                'quantity'         => $request->quantity,
                'unit_price'       => $request->unit_price,
                'purchase_amount'  => $request->purchase_amount,
                'bill_image'       => $image,
                'remarks'          => $request->remarks,
                'driver_name'      => $request->driver_name,
                'branch_name'      => $request->branch_name,
                'fuel_capacity'      => $request->fuel_capacity,
                'fuel_category'      => $request->fuel_category,
                'service_cost'      => $request->service_cost,
                'vehicle_no'       => $request->vehicle_no,
                'status'           => "pending",
                'priority'           => $request->priority,
                'validity'           => $request->validity,
                'created_by'       => $request->created_by,
            ]);

            // 2. Update or create stock if engine oil
            if ($request->category == "engine_oil") {
                $lastStock = StockOutProduct::where('id', '!=', $id)
                    ->orderBy('id', 'desc')
                    ->value('total_stock') ?? 0;

                $newTotalStock = $lastStock + $request->quantity;

                StockOutProduct::updateOrCreate(
                    ['purchase_id' => $purchase->id],
                    [
                        'date'             => $request->date,
                        'product_category' => 'Purchase',
                        'product_name'     => $request->product_name,
                        'stock_in'         => $request->quantity,
                        'total_stock'      => $newTotalStock,
                    ]
                );
            }

            // // 3. Update branch ledger
            // Branch_Ledger::updateOrCreate(
            //     ['purchase_id' => $purchase->id],
            //     [
            //         'date'         => $request->date,
            //         'branch_name'  => $request->branch_name,
            //         'remarks'      => $request->item_name,
            //         'cash_out'     => $request->purchase_amount,
            //         'created_by'   => $request->created_by,
            //     ]
            // );

            // 4. Update supplier ledger
            Supplier_Ledger::updateOrCreate(
                ['purchase_id' => $purchase->id],
                [
                    'date'            => $request->date,
                    'mode'            => 'Purchase',
                    'purchase_amount' => $request->purchase_amount,
                    'unit_price'      => $request->unit_price,
                    'created_by'      => $request->created_by,
                    'catagory'        => $request->category,
                    'supplier_name'   => $request->supplier_name,
                    'item_name'       => $request->item_name,
                    'quantity'        => $request->quantity,
                    'remarks'         => $request->remarks,
                ]
            );

            // 5. Update payment
            Payment::updateOrCreate(
                ['purchase_id' => $purchase->id],
                [
                    'date'          => $request->date,
                    'supplier_name' => $request->supplier_name,
                    'category'      => $request->category,
                    'item_name'     => $request->item_name,
                    'quantity'      => $request->quantity,
                    'unit_price'    => $request->unit_price,
                    'total_amount'  => $request->purchase_amount,
                    'remarks'       => $request->remarks,
                    'pay_amount'      => "0",
                    'due_amount'      =>$request->purchase_amount ,
                    'driver_name'   => $request->driver_name,
                    'branch_name'   => $request->branch_name,
                    'vehicle_no'    => $request->vehicle_no,
                    'status'        => 'pending',
                    'created_by'    => $request->created_by,
                ]
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Purchase updated successfully',
                'data'    => $purchase
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
