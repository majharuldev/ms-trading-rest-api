<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $data = Trip::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $data = Trip::create($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $data = Trip::findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $data = Trip::findOrFail($id);
        $data->update($request->all());
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $data = Trip::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
}
