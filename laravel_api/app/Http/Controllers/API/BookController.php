<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // $books = Book::all();

        $books = Book::with(['addedBy:id,name'])->get();

        if ($books) {
            return response()->json(['status' => 'success', 'data' => $books], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No Book found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Check if validation passes, proceed with image handling
        if ($request->file('file')->isValid()) {
            $image = $request->file('file');

            // Ensure the file size is within limits and it's a valid image
            if ($image->isValid() && $image->getSize() <= 2048 * 1024) { // Check file size in bytes
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);

                $imageUrl = '/images/' . $imageName;

                // Get the authenticated user
                // $user = auth()->user();
                $user = User::find($validated['added_by']);

                // Check if the user has the admin role
                if (!$user->role->name == 'admin') {
                    return response()->json(['status' => 'error', 'error' => 'Only admins can add books.'], 403);
                }

                $book = Book::create([
                    'name' => $validated['name'],
                    'publisher' => $validated['publisher'],
                    'isbn' => $validated['isbn'],
                    'category' => $validated['category'],
                    'sub_category' => $validated['sub_category'],
                    'description' => $validated['description'],
                    'pages' => $validated['pages'],
                    'image' => $imageUrl,
                    'added_by' => $validated['added_by']
                ]);

                return response()->json(['status' => 'success', 'book' => $book], 201);
            } else {
                return response()->json(['status' => 'error', 'error' => 'Invalid image or exceeds file size limit (2MB)'], 422);
            }
        } else {
            return response()->json(['status' => 'error', 'error' => 'Failed to upload image'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $book = Book::with(['addedBy:id,name'])->find($id);

        if ($book !== null) {
            return response()->json(['status' => 'success', 'book' => $book], 200);
        } else {
            return response()->json(['status' => 'error', 'error' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, $id): JsonResponse
    {

        $book = Book::find($id);

        if (!$book) {
            return response()->json(['status' => 'error', 'error' => 'Book not found'], 404);
        }

        $validated = $request->validated();

        // Check if a new image file is provided
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $newImage = $request->file('file');

            // Ensure the file size is within limits and it's a valid image
            if ($newImage->isValid() && $newImage->getSize() <= 2048 * 1024) {
                // Delete the old image if it exists
                if ($book->image && file_exists(public_path($book->image))) {
                    unlink(public_path($book->image));
                }

                $imageName = time() . '.' . $newImage->getClientOriginalExtension();
                $newImage->move(public_path('images'), $imageName);

                $imageUrl = '/images/' . $imageName;
                $validate['image'] = $imageUrl; // Update the image URL in the database
            } else {
                return response()->json(['status' => 'error', 'error' => 'Invalid image or exceeds file size limit (2MB)'], 422);
            }
        }

        $validated = $request->validated();
        $book->update($validated);

        return response()->json(['status' => 'success', 'book' => $book], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['status' => 'error', 'error' => 'Book not found'], 404);
        }

        // Delete associated image if it exists
        if (File::exists(public_path($book->image))) {
            File::delete(public_path($book->image));
        }

        $book->delete();

        return response()->json(['status' => 'success', 'message' => 'Book deleted successfully'], 204);
    }

}





// $book->name = $request->input('name');
// $book->publisher = $request->input('publisher');
// $book->isbn = $request->input('isbn');
// $book->category = $request->input('category');
// $book->sub_category = $request->input('sub_category');
// $book->description = $request->input('description');
// $book->pages = $request->input('pages');
// // $book->image = $imageUrl;
// $book->added_by = $request->input('added_by');
// $book->update();