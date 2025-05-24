<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    public function index()
    {
        $data = Employee::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validation = validator([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg',
        ]);
        $image = null;
        if ($request->image) {
            $image_name = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/employee'), $image_name);
            $image = $image_name;
        }
        $data = Employee::create($request->except('image') + ['image' => $image]);
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function show($id)
    {
        $data = Employee::findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $validation = validator([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg'
        ]);
        $image = null;
        $data = Employee::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($data->image && file_Exists(public_path('uploads/employee/' . $data->image))) {
                unlink(public_path('uploads/employee/' . $data->image));
            }
            $image_name = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/employee'), $image_name);
            $image = $image_name;
        }

        $data->update($request->except('image') + ['image' => $image]);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function destroy($id)
    {
        $data = Employee::findOrFail($id);
        $data->delete();
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
}
