<?php

namespace App\Http\Controllers;

use App\Models\Trip;

use App\Models\Branch_Ledger;
use App\Models\Customer_ledger;
use App\Models\driverLedger;
use App\Models\VendorLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::beginTransaction();

        try {
            // Insert into trips table
            $trip = Trip::create([
                'customer'           => $request->customer,
                'date'               => $request->date,
                'load_point'         => $request->load_point,
                'unload_point'       => $request->unload_point,
                'transport_type'     => $request->transport_type,
                'vehicle_no'         => $request->vehicle_no,
                'total_rent'         => $request->total_rent,
                'quantity'           => $request->quantity,
                'dealer_name'        => $request->dealer_name,
                'driver_name'        => $request->driver_name,
                'fuel_cost'          => $request->fuel_cost,
                'do_si'              => $request->do_si,
                'driver_mobile'      => $request->driver_mobile,
                'challan'            => $request->challan,
                'sti'                => $request->sti,
                'model_no'           => $request->model_no,
                'co_u'               => $request->co_u,
                'masking'            => $request->masking,
                'unload_charge'      => $request->unload_charge,
                'extra_fare'         => $request->extra_fare,
                'vehicle_rent'       => $request->vehicle_rent,
                'goods'              => $request->goods,
                'distribution_name'  => $request->distribution_name,
                'remarks'            => $request->remarks,
                'no_of_trip'         => $request->no_of_trip,
                'vehicle_mode'       => $request->vehicle_mode,
                'per_truck_rent'     => $request->per_truck_rent,
                'vat'                => $request->vat,
                'total_rent_cost'    => $request->total_rent_cost,
                'driver_commission'  => $request->driver_commission,
                'road_cost'          => $request->road_cost,
                'food_cost'          => $request->food_cost,
                'total_exp'      => $request->total_exp,
                'trip_rent'          => $request->trip_rent,
                'advance'            => $request->advance,
                'd_day'            => $request->d_day,
                'd_amount'            => $request->d_amount,
                'd_total'            => $request->d_total,
                'due_amount'         => $request->due_amount,
                'ref_id'             => $request->ref_id,
                'body_fare'          => $request->body_fare,
                'parking_cost'       => $request->parking_cost,
                'night_guard'        => $request->night_guard,
                'toll_cost'          => $request->toll_cost,
                'feri_cost'          => $request->feri_cost,
                'police_cost'        => $request->police_cost,
                'driver_adv'         => $request->driver_adv,
                'chada'              => $request->chada,
                'callan_cost'              => $request->callan_cost,
                'others_cost'              => $request->others_cost,
                'labor'        => $request->labor,
                'vehicle_size'        => $request->vehicle_size,
                'vehicle_category'        => $request->vehicle_category,

                'status'        => "Pending",
            ]);


            if ($request->transport_type == "own_transport") {

                DriverLedger::create([
                    'date'               => $request->date,
                    'driver_name'        => $request->driver_name,
                    'trip_id'            => $trip->id,
                    'load_point'         => $request->load_point,
                    'unload_point'       => $request->unload_point,
                    'driver_commission'  => $request->driver_commission,
                    'driver_adv'         => $request->driver_adv,
                    'parking_cost'       => $request->parking_cost,
                    'night_guard'        => $request->night_guard,
                    'toll_cost'          => $request->toll_cost,
                    'feri_cost'          => $request->feri_cost,
                    'police_cost'        => $request->police_cost,
                    'chada'              => $request->chada,
                    'branch_name'       => $request->branch_name,
                    'callan_cost'              => $request->callan_cost,
                    'others_cost'              => $request->others_cost,
                    'labor'        => $request->labor,
                    'total_exp'      => $request->total_exp,
                ]);
            } else {

                VendorLedger::create([
                    'date'               => $request->date,
                    'driver_name'        => $request->driver_name,
                    'trip_id'            => $trip->id,
                    'load_point'         => $request->load_point,
                    'unload_point'       => $request->unload_point,
                    'customer'         => $request->customer,
                    'vendor_name'         => $request->vendor_name,
                    'vehicle_no'       => $request->vehicle_no,
                    'trip_rent'        => $request->total_exp,
                    'advance'          => $request->advance,
                    'due_amount'          => $request->due_amount,

                ]);
            }

            // Insert into branch_ledgers
            Branch_Ledger::create([
                'date'               => $request->date,
                'unload_point'       => $request->unload_point,
                'customer'           => $request->customer,
                'trip_id'            => $trip->id,
                'branch_name'       => $request->branch_name,
                'status'             => $request->status,
                'cash_out'      => $request->total_exp,
                'created_by'         => $request->created_by,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Trip created successfully',
                'data'    => $trip
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Find and update the trip
            $trip = Trip::findOrFail($id);

            $trip->update([
                'customer'           => $request->customer,
                'date'               => $request->date,
                'load_point'         => $request->load_point,
                'unload_point'       => $request->unload_point,
                'transport_type'     => $request->transport_type,
                'vehicle_no'         => $request->vehicle_no,
                'total_rent'         => $request->total_rent,
                'quantity'           => $request->quantity,
                'dealer_name'        => $request->dealer_name,
                'driver_name'        => $request->driver_name,
                'fuel_cost'          => $request->fuel_cost,
                'do_si'              => $request->do_si,
                'driver_mobile'      => $request->driver_mobile,
                'challan'            => $request->challan,
                'sti'                => $request->sti,
                'model_no'           => $request->model_no,
                'co_u'               => $request->co_u,
                'masking'            => $request->masking,
                'unload_charge'      => $request->unload_charge,
                'extra_fare'         => $request->extra_fare,
                'vehicle_rent'       => $request->vehicle_rent,
                'goods'              => $request->goods,
                'distribution_name'  => $request->distribution_name,
                'remarks'            => $request->remarks,
                'no_of_trip'         => $request->no_of_trip,
                'vehicle_mode'       => $request->vehicle_mode,
                'per_truck_rent'     => $request->per_truck_rent,
                'vat'                => $request->vat,
                'total_rent_cost'    => $request->total_rent_cost,
                'driver_commission'  => $request->driver_commission,
                'road_cost'          => $request->road_cost,
                'food_cost'          => $request->food_cost,
                'total_exp'          => $request->total_exp,
                'trip_rent'          => $request->trip_rent,
                'advance'            => $request->advance,
                'd_day'            => $request->d_day,
                'd_amount'            => $request->d_amount,
                'd_total'            => $request->d_total,
                'due_amount'         => $request->due_amount,
                'ref_id'             => $request->ref_id,
                'body_fare'          => $request->body_fare,
                'parking_cost'       => $request->parking_cost,
                'night_guard'        => $request->night_guard,
                'toll_cost'          => $request->toll_cost,
                'feri_cost'          => $request->feri_cost,
                'police_cost'        => $request->police_cost,
                'driver_adv'         => $request->driver_adv,
                'chada'              => $request->chada,
                'callan_cost'              => $request->callan_cost,
                'others_cost'              => $request->others_cost,

                'labor'              => $request->labor,
                'status'        => $request->status,
            ]);

            // Update ledger based on transport type
            if ($request->transport_type == "own_transport") {
                DriverLedger::updateOrCreate(
                    ['trip_id' => $trip->id],
                    [
                        'date'               => $request->date,
                        'driver_name'        => $request->driver_name,
                        'load_point'         => $request->load_point,
                        'unload_point'       => $request->unload_point,
                        'driver_commission'  => $request->driver_commission,
                        'driver_adv'         => $request->driver_adv,
                        'parking_cost'       => $request->parking_cost,
                        'night_guard'        => $request->night_guard,
                        'toll_cost'          => $request->toll_cost,
                        'feri_cost'          => $request->feri_cost,
                        'police_cost'        => $request->police_cost,
                        'chada'              => $request->chada,
                        'callan_cost'              => $request->callan_cost,
                        'others_cost'              => $request->others_cost,
                        'fuel_cost'              => $request->fuel_cost,
                        'labor'              => $request->labor,
                        'total_exp'          => $request->total_exp,
                    ]
                );
            } else {
                VendorLedger::updateOrCreate(
                    ['trip_id' => $trip->id],
                    [
                        'date'        => $request->date,
                        'driver_name' => $request->driver_name,
                        'load_point'  => $request->load_point,
                        'unload_point' => $request->unload_point,
                        'customer'    => $request->customer,
                        'vehicle_no'  => $request->vehicle_no,
                        'trip_rent'   => $request->total_exp,
                        'advance'    => $request->advance,
                        'due_amount'  => $request->due_amount,
                    ]
                );
            }

            // Update Branch Ledger
            Branch_Ledger::updateOrCreate(
                ['trip_id' => $trip->id],
                [
                    'date'         => $request->date,
                    'unload_point' => $request->unload_point,
                    'customer'     => $request->customer,
                    'status'       => $request->status,
                    'branch_name'       => $request->branch_name,
                    'cash_out'     => $request->total_exp,
                    'created_by'   => $request->created_by,
                ]
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Trip updated successfully',
                'data'    => $trip
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }


    public function show($id)
    {
        $data = Trip::findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }


    public function Bill(Request $request, $id)
    {


        DB::beginTransaction();

        try {
            $trip = Trip::findOrFail($id);
            $trip->update(['status' => 'approved']);

            Customer_ledger::create([
                'woring_date' => $request->date,
                'load_point' => $request->load_point,
                'trip_id' => $trip->id,
                'unload_point' => $request->unload_point,
                'customer_name' => $request->customer,
                'vehicle_no' => $request->vehicle_no,
                'bill_amount' => $request->total_rent,
                'chalan' => $request->challan,
                'driver_name' => $request->driver_name,
                'qty' => $request->quantity,
                'fuel_cost' => $request->fuel_cost,
                'body_cost' => $request->body_cost,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Trip updated successfully',
                'data' => $trip
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
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
