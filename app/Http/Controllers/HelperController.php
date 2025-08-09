<?php

namespace App\Http\Controllers;

use App\Models\Helper;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function index()
    {
        $data = Helper::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {


        $data = Helper::create($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function show($id)
    {
        $data = Helper::findOrFail($id);
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    public function update(Request $request, $id)
    {


        $data = Helper::findOrFail($id);
        $data->update($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $data = Helper::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
}
