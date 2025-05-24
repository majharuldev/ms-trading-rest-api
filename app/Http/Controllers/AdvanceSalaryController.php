<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdvanceSalary;

class AdvanceSalaryController extends Controller
{
    public function index()
    {
        $data = AdvanceSalary::all();
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $data = AdvanceSalary::create($request->all());
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $data = AdvanceSalary::findOrFail($id);
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $data = AdvanceSalary::findOrFail($id);
        $data->update($request->all());
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $data = AdvanceSalary::findOrFail($id)->delete();
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
}
