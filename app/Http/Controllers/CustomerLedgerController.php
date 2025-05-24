<?php

namespace App\Http\Controllers;

use App\Models\Customer_ledger;
use Illuminate\Http\Request;

class CustomerLedgerController extends Controller
{
    public function index()
    {
        $data = Customer_ledger::all();
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function store(Request $request)
    {
        $data = Customer_ledger::create($request->all());
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function show($id)
    {
        $data = Customer_ledger::findOrFail($id);
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $data = Customer_ledger::findOrFail($id)->update($request->all());
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function destroy($id)
    {
        $data = Customer_ledger::findOrFail($id)->delete();
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
}
