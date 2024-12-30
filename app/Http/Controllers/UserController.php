<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Exception;

use App\Models\User;

class UserController extends Controller

{
    public function update(Request $request)
    {
    
    }

    public function show()
    {

        $user = Auth::user(); 
        
        $user = User::with(['country:id,name'])  // 'country' relationship, only select id and name
            ->select('id', 'name', 'email', 'isActive', 'countryId')  // Select only the required columns
            ->find($user->id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'isActive' => $user->isActive,
            'country' => $user->country->name,  // Get country name
        ], 200);

    }

    public function destroy()
    {

    }
}
