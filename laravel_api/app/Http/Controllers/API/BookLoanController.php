<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\BookLoan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookLoanStoreRequest;
use App\Http\Requests\BookLoanUpdateRequest;

class BookLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookloans = BookLoan::all();

        if ($bookloans) {
            return response()->json(['status' => 'success', 'data' => $bookloans], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No Book Loan found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookLoanStoreRequest $request)
    {
        $validated = $request->validated();

        // Admin should not request for a bookloan
        $user = User::find($validated['user_id']);

        if ($user->role->name == 'admin') {
            return response()->json(['status' => 'error', 'error' => 'Unauthorized.'], 403);
        }

        $bookloan = BookLoan::create($validated);

        return response()->json(['status' => 'success', 'bookloan' => $bookloan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bookloan = BookLoan::find($id);

        if (!$bookloan) {
            return response()->json(['status' => 'error', 'error' => 'Book Loan not found'], 404);
        }

        return response()->json(['status' => 'success', 'bookloan' => $bookloan], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookLoanUpdateRequest $request, string $id)
    {
        $bookloan = BookLoan::find($id);

        if (!$bookloan) {
            return response()->json(['status' => 'error', 'error' => 'Book Loan not found'], 404);
        }

        $user = User::find($request->input('user_id'));

        if ($user->role->name == 'admin') {
            return response()->json(['status' => 'error', 'error' => 'Unauthorized.'], 403);
        }

        $validated = $request->validated();

        $bookloan->update($validated);

        return response()->json(['status' => 'success', 'bookloan' => $bookloan], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bookloan = BookLoan::find($id);

        if (!$bookloan) {
            return response()->json(['status' => 'error', 'error' => 'Loan not found'], 404);
        }

        $bookloan->delete();

        return response()->json(['status' => 'success', 'message' => 'Loan deleted successfully'], 200);
    }
}
