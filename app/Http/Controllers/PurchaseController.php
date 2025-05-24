<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

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
        $validation = Validator([
            'bill_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $bill_image = null;

        if ($request->bill_image) {
            $image_name = time() . '.' . $request->bill_image->extension();
            $request->bill_image->move(public_path('uploads/purchase'), $image_name);
            $bill_image = $image_name;
        }
        $data = Purchase::create($request->except('bill_image') + ['bill_image' => $bill_image]);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
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
        $validation = Validator([
            'bill_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $data = Purchase::findOrFail($id);
        $bill_image = $data->bill_image;
        if ($request->hasFile('bill_image')) {
            if ($data->bill_image && file_exists(public_path('uploads/purchase/' . $data->bill_image))) {
                unlink(public_path('uploads/purchase/' . $data->bill_image));

                $image_name = time() . '.' . $request->bill_image->extension();
                $request->bill_image->move(public_path('uploads/purchase'), $image_name);
                $bill_image = $image_name;
            }
            $data->update($request->except('bill_image') + ['bill_image' => $bill_image]);
        }
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function destroy($id)
    {
        $data = Purchase::findOrFail($id);
        $data->delete();
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
}
