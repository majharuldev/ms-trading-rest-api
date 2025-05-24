<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $data = Payment::create($request->all());
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function show($id)
    {
        $data = Payment::findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function update(Request $request, $id)
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
