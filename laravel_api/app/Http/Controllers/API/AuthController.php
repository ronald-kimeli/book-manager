<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::with(['role:id,name'])->get();
        return response()->json(['data' => $users]);
    }
    public function register(Request $request): JsonResponse
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|integer',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Authenticate the user
        Auth::login($user);

        // Generate a personal access token
        $token = $user->createToken('registerToken');
        $accessToken = $token->plainTextToken;

        return response()->json(['status' => 'success', 'user' => $user->only('name', 'email'), 'token' => $accessToken], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }
        $credentials = $request->only('email', 'password');

        // Check if the email exists in the database
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {

            return response()->json(['status' => 'error', 'errors' => ["error" => ['invalid credentials']]], 403);
        }

        // Generate a personal access token
        $token = $user->createToken('loginToken');
        $accessToken = $token->plainTextToken;

        // If both email and password are correct, generate an API token
        return response()->json(['status' => 'success', 'user' => $user->only('name', 'email'), 'token' => $accessToken], 200);
    }
    
    public function logout(Request $request): JsonResponse
    {

        $request->user()->currentAccessToken()->delete();

        return response()->json(['status' => 'success', 'message' => 'logged out successfully!'], 200);
    }

    public function delete($id): JsonResponse
    {
        $authenticatedUser = Auth::user();

        if ($authenticatedUser) {
            // Check if the authenticated user is the same as the user being deleted
            if ($authenticatedUser->role->name === 'admin') {
                $userToDelete = User::find($id);

                if ($userToDelete) {
                    $userToDelete->delete();
                    return response()->json(['message' => 'User deleted successfully'], 200);
                }

                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json(['error' => ["error" => ['Unauthorized action']]], 403);
        }

        return response()->json(['error' => ["error" => ['Unauthenticated']]], 401);
    }

    /**
     * Get a single user
     */

     public function show(string $id): JsonResponse
     {
         $user = User::with(['role:id,name'])->find($id);
 
         if ($user !== null) {
             return response()->json(['status' => 'success', 'user' => $user], 200);
         } else {
             return response()->json(['status' => 'error', 'error' => 'Not Found'], 404);
         }
     }

    public function restore($id): JsonResponse
    {
        $authenticatedUser = Auth::user();

        if ($authenticatedUser) {
            $userToRestore = User::withTrashed()->find($id);

            if ($userToRestore) {
                $userToRestore->restore();
                return response()->json(['message' => 'User restored successfully'], 200);
            }

            return response()->json(['message' => 'User not found or not soft deleted'], 404);
        }

        return response()->json(['error' => 'Unauthenticated'], 401);
    }
}
