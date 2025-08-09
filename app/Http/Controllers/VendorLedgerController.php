<?php

namespace App\Http\Controllers;

use App\Models\VendorLedger;
use Illuminate\Http\Request;

class VendorLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = VendorLedger::all();
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VendorLedger $vendorLedger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VendorLedger $vendorLedger)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VendorLedger $vendorLedger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VendorLedger $vendorLedger)
    {
        //
    }
}
