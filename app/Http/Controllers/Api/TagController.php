<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Requests\Api\StoreTagRequest;
use App\Http\Requests\Api\UpdateTagRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->integer('per_page', 10);

        $tags = Tag::whereNull('deleted_at')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $tags->items(),
            'pagination' => [
                'current_page' => $tags->currentPage(),
                'last_page' => $tags->lastPage(),
                'per_page' => $tags->perPage(),
                'total' => $tags->total(),
                'from' => $tags->firstItem(),
                'to' => $tags->lastItem(),
                'next_page_url' => $tags->nextPageUrl(),
                'prev_page_url' => $tags->previousPageUrl(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request): JsonResponse
    {
        $tag = Tag::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tag created successfully.',
            'data' => $tag,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag): JsonResponse
    {
        if ($tag->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'The tag is not available.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateTagRequest $request,
        Tag $tag
    ): JsonResponse {
        if ($tag->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'A deleted tag cannot be updated.',
            ], 404);
        }

        $tag->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tag updated successfully.',
            'data' => $tag,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag): JsonResponse
    {
        if ($tag->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'This tag has already been removed.',
            ], 404);
        }

        // Guardamos la información antes de eliminarlo.
        $deletedTag = [
            'id' => $tag->id,
            'name' => $tag->name,
        ];

        $tag->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tag deleted successfully.',
            'data' => $deletedTag,
        ]);
    }
}
