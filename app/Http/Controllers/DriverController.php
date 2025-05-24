<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $data = Driver::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validation = Validator([
            'license_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $license_image = null;
        if ($request->license_image) {
            $image_name = time() . '.' . $request->license_image->extension();
            $request->license_image->move(public_path('uploads/driver'), $image_name);
            $license_image = $image_name;
        }
        $data = Driver::create($request->except('license_image') + ['license_image' => $license_image]);
        if ($data) {
            return response()->json([
                'status' => 'Success',
                'data' => $data
            ], 200);
        }
    }
    public function show($id)
    {
        $data = Driver::findOrFail($id);
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $validation = Validator([
            'license_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $data = Driver::findOrFail($id);

        $license_image = $data->license_image;
        if ($request->hasFile('license_image')) {
            if ($data->license_image && file_exists(public_path('uploads/driver/' . $data->license_image))) {
                unlink(public_path('uploads/driver/' . $data->license_image));
            }
            $image_name = time() . '.' . $request->license_image->extension();
            $request->license_image->move(public_path('uploads/driver'), $image_name);
            $license_image = $image_name;
        }

        $data->update($request->except('license_image') + ['license_image' => $license_image]);
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $data = Driver::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
}
