<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::whereNull('deleted_at')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return redirect()->route('categories.index')->with('success', 'category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        if ($category->trashed()) {
            return redirect()->route('categories.index')
                             ->with('error', 'The category is not available.');
        }
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if ($category->trashed()) {
            return redirect()->route('categories.index')
                             ->with('error', 'You cannot edit a deleted category.');
        }
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($category->trashed()) {
            return redirect()->route('categories.index')
                ->with('error', 'You cannot update a deleted category.');
        }
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', 'category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->trashed()) {
            return redirect()->route('categories.index')
                             ->with('error', 'This category has already been eliminated.');
        }
        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Category successfully removed.');
    }
}
