<?php

namespace App\Http\Controllers;

use App\Models\Parts;
use Illuminate\Http\Request;

class PartsController extends Controller
{
    public function index()
    {
        $data = Parts::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function store(Request $request)
    {
        $data = Parts::create($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function show($id)
    {
        $data = Parts::findOrFail($id);
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $data = Parts::findOrFail($id);
        $data->update($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function destroy($id)
    {
        $data = Parts::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
}
