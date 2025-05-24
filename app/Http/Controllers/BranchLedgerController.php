<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch_Ledger;

class BranchLedgerController extends Controller
{
    public function index()
    {
        $data = Branch_Ledger::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function store(Request $request)
    {
        $data = Branch_Ledger::create($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function show($id)
    {
        $data = Branch_Ledger::findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $data = Branch_Ledger::findOrFail($id);
        $data->update($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function destroy($id)
    {
        $data = Branch_Ledger::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
}
