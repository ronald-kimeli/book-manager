<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function editImage(ImageRequest $request, $id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['status' => 'error', 'error' => 'Book not found'], 404);
        }

        $validated = $request->validated();

        $image = $request->file('file');
        // Proceed with image update if the request contains a valid image
        if ($image->isValid() && $image->getSize() <= 2048 * 1024) { // Check file size in bytes
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $imageUrl = '/images/' . $imageName;

            // Delete previous image if it exists
            if (file_exists(public_path($book->image))) {
                unlink(public_path($book->image));
            }

            // Update book's image field
            $book->update(['image' => $imageUrl]);

            return response()->json(['status' => 'success', 'message' => 'Book image updated successfully'], 200);
        }

        return response()->json(['status' => 'error', 'error' => 'Invalid image or exceeds file size limit (2MB)'], 422);
    }

    /**
     * Delete Image alone
     */

    public function deleteImage($id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['status' => 'error', 'error' => 'Book not found'], 404);
        }

        // Delete associated image if it exists
        if (!empty($book->image) && file_exists(public_path($book->image))) {
            unlink(public_path($book->image));

            // Update book's image field to null
            $book->update(['image' => null]);

            return response()->json(['status' => 'success', 'message' => 'Book image deleted successfully'], 200);
        }
        return response()->json(['status' => 'error', 'error' => 'Image not found'], 404);
    }

}
