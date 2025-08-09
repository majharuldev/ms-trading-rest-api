<?php

namespace App\Http\Controllers;

use App\Models\Branch_Ledger;
use App\Models\Payment;
use App\Models\Purchase;
use App\Models\Supplier_Ledger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $data = Payment::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, $id)
    {


        DB::beginTransaction();

        try {
            $payment = Payment::findOrFail($id);
            $new_amount = $request->total_amount - $request->pay_amount;

            $payment->update([
                'date'          => $request->created_at ?? now(),
                'supplier_name' => $request->supplier_name,
                'category'      => $request->category,
                'item_name'     => $request->item_name,
                'quantity'      => $request->quantity,
                'unit_price'    => $request->unit_price,
                'total_amount'  => $request->total_amount,
                'due_amount'  => $new_amount,
                'remarks'       => $request->remarks,
                'pay_amount'      => $request->pay_amount,
                'driver_name'   => $request->driver_name,
                'branch_name'   => $request->branch_name,
                'vehicle_no'    => $request->vehicle_no,
                'created_by'    => $request->created_by,
            ]);

            Supplier_Ledger::create([
                'date'          => $request->created_at ?? now(),
                'payment_id'    => $payment->id,
                'supplier_name' => $request->supplier_name,
                'pay_amount'    => $request->pay_amount,
                'remarks'       => $request->remarks,
            ]);

            Branch_Ledger::create([
                'date'         => $request->created_at ?? now(),
                'branch_name'  => $request->branch_name,
                'payment_id'  => $payment->id,
                'remarks'      => $request->item_name,
                'cash_out'     => $request->pay_amount,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Payment updated successfully',
                'data'    => $payment,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }



    public function show($id)
    {
        $data = Payment::findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function store(Request $request, $id)
    {
        $data = Payment::findOrFail($id);
        $data->update($request->all());
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function destroy($id)
    {
        $data = Payment::findOrFail($id);
        $data->delete();
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
}
