<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment_Recived;
use App\Models\Branch_Ledger;
use App\Models\Customer_ledger;
use Illuminate\Support\Facades\DB;

class PaymentRecivedController extends Controller
{
    public function index()
    {
        $data = Payment_Recived::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
            // Insert into trips table
            $payment_rec = Payment_Recived::create([
                'customer_name' => $request->customer_name,
                'date'  => $request->date,
                'bill_ref'  => $request->bill_ref,
                'amount' => $request->amount,
                'status' => $request->status,
                'branch_name' => $request->branch_name,
                'remarks' => $request->remarks,
                'cash_type' => $request->cash_type,
                'created_by'   => $request->created_by,

            ]);

            // Insert into branch_ledgers
            Branch_Ledger::create([
                'date'               => $request->date,
                'payment_rec_id' => $payment_rec->id,
                'customer'           => $request->customer_name,
                'cash_in'      => $request->amount,
                'created_by'         => $request->created_by,
            ]);

            Customer_ledger::create([
                'bill_date'  => $request->date,
                'payment_rec_id' => $payment_rec->id,
                'customer_name'  => $request->customer_name,
                'rec_amount' => $request->amount,
                'created_by'  => $request->created_by,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => ' created successfully',
                'data'    => $payment_rec
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
        $data = Payment_Recived::findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Find and update the main Payment_Recived record
            $payment_rec = Payment_Recived::findOrFail($id);

            $payment_rec->update([
                'customer_name' => $request->customer_name,
                'date'          => $request->date,
                'bill_ref'      => $request->bill_ref,
                'amount'        => $request->amount,
                'status'        => $request->status,
                'branch_name'   => $request->branch_name,
                'remarks'       => $request->remarks,
                'cash_type'     => $request->cash_type,
                'created_by'    => $request->created_by,
            ]);

            // Update related Branch_Ledger
            Branch_Ledger::where('payment_rec_id', $payment_rec->id)
                ->update([
                    'date'       => $request->date,
                    'customer'   => $request->customer_name,
                    'cash_in'    => $request->amount,
                    'created_by' => $request->created_by,
                ]);

            // Update related Customer_ledger
            Customer_ledger::where('payment_rec_id', $payment_rec->id)
                ->update([
                    'bill_date'     => $request->date,
                    'customer_name' => $request->customer_name,
                    'rec_amount'    => $request->amount,
                    'created_by'    => $request->created_by,
                ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Updated successfully',
                'data'    => $payment_rec
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


    public function destroy($id)
    {
        $data = Payment_Recived::findOrFail($id);
        $data->delete();
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
}
