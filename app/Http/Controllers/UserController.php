<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    

// read all data
    public function index()
    {
        $user = User::all();

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

 

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'not found'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }




    public function store(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'name'     => 'required|string|max:255',
                'phone'    => 'required|string|max:20',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'role'     => 'required|string',
                'status'   => 'required|string',
            ]);
    
            // Create new User instance and assign values
            $user = new User();
            $user->name = $validatedData['name'];
            $user->phone = $validatedData['phone'];
            $user->email = $validatedData['email'];
            $user->password = bcrypt($validatedData['password']); // Hashing password
            $user->role = $validatedData['role'];
            $user->status = $validatedData['status'];
         
    
            // Save to DB
            $user->save();
    
            // Return success response
            return response()->json([
                'status' => 'success',
                'data'   => $user
            ], 201);
    
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    




    public function update(Request $request, $id)
    {
        try {
            // Find the Vehicle model by ID
            $model = User::findOrFail($id);  // Using findOrFail to ensure the model is found

            // Assign the incoming request data to the model attributes
            $model->name = $request->name;
            $model->phone = $request->phone;
            $model->email = $request->email;
       $model->password = bcrypt($request->password);

            $model->role = $request->role;
            $model->status = $request->status;
          
            // Save the updated model
            $model->save();

            // Return a success response
            return response()->json([
                'status' => 'success',
                'data' => $model
            ], 200);
        } catch (\Exception $e) {
            // Handle any exceptions or errors that occur
            return response()->json([
                'status' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }




    // delete user by id
    public function destroy($id)
    {
        $model = User::find($id);
    
        if (!$model) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }
    
        if ($model->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete user',
            ], 500);
        }
    }
    



}
