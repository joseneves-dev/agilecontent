<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use Exception;

use App\Models\User;

class UserController extends Controller

{
    public function update(Request $request)
    {

        if ($request->only(['name', 'email', 'password', 'countryId', 'isActive']) == []) {
            return response()->json([
                'message' => 'No data provided to update.',
            ], 400);  
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . Auth::id(),
            'password' => 'string|min:8',
            'countryId' => 'exists:countries,id',
            'isActive' => 'boolean',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422); 
        }
    
        $user = Auth::user();
       
        $user = User::findOrFail($user->id);

        if (!$user->isActive) {
            return response()->json([
                'message' => 'User is inactive, cannot update.',
            ], 403);  // Forbidden status (403) for trying to update an inactive user
        }

        DB::beginTransaction();
    
        try {

            $user->name = $request->name ?? $user->name;
            $user->email = $request->email ?? $user->email;
            $user->password = $request->password ? Hash::make($request->password) : $user->password;
            $user->countryId = $request->countryId ?? $user->countryId;
            $user->isActive = $request->has('isActive') ? $request->isActive : $user->isActive;
    
            $user->save();
    
            DB::commit();
    
            return response()->json([
                'message' => 'User updated successfully',
                'user' => $user
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'message' => 'User update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show()
    {

        $user = Auth::user(); 
        
        $user = User::with(['country:id,name'])  
            ->select('id', 'name', 'email', 'isActive', 'countryId')  
            ->find($user->id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'isActive' => $user->isActive,
            'country' => $user->country->name,  
        ], 200);

    }

    public function destroy()
    {
        $user = Auth::user();
       
        $user = User::findOrFail($user->id);

        DB::beginTransaction();

        try {
            $user->delete();
    
            DB::commit();
    
            return response()->json([
                'message' => 'User deleted successfully'
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'message' => 'User deletion failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
