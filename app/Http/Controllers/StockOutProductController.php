<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockOutProduct;

class StockOutProductController extends Controller
{
    public function index()
    {
        $data = StockOutProduct::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {

        $lastStock = StockOutProduct::orderBy('id', 'desc')->value('total_stock') ?? 0;


        $newTotalStock = $lastStock - $request->stock_out;

        // Create stock out entry
        $stock_out = StockOutProduct::create([
            'date'             => $request->date,
            'vehicle_name'     => $request->vehicle_name,
            'driver_name'      => $request->driver_name,
            'stock_out'        => $request->stock_out,
            'total_stock'      => $newTotalStock,
            'product_category' => $request->product_category,
            'product_name'     => $request->product_name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Stock out created successfully.',
            'data'    => $stock_out
        ], 201);
    }

    public function show($id)
    {
        $data = StockOutProduct::findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $stock_out = StockOutProduct::findOrFail($id);

        // Get the last total_stock excluding the current record
        $lastStock = StockOutProduct::where('id', '!=', $id)
            ->orderBy('id', 'desc')
            ->value('total_stock') ?? 0;

        // Calculate the new total stock
        $newTotalStock = $lastStock - $request->stock_out;

        // Update the record
        $stock_out->update([
            'date'             => $request->date,
            'vehicle_name'     => $request->vehicle_name,
            'driver_name'      => $request->driver_name,
            'stock_out'        => $request->stock_out,
            'total_stock'      => $newTotalStock,
            'product_category' => $request->product_category,
            'product_name'     => $request->product_name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Stock out updated successfully.',
            'data'    => $stock_out
        ], 200);
    }

    public function destroy($id)
    {
        $data = StockOutProduct::findOrFail($id);
        $data->delete();
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
}
