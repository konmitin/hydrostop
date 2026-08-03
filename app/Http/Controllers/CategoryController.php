<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(20);

        return response([
            'data' => $categories->items(),
            'count' => Category::count()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ], 422);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        $categorySlug = Category::where('slug', $category->slug)->get();

        if ($categorySlug->count() >= 1) {
            return response([
                'errors' => [
                    'slug' => ['Код категории должен быть уникальным, укажите другое название или код']
                ]
            ], 422);
        }

        $category->save();

        return response([
            'data' => $category,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response([
            'data' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ], 422);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->slug = $request->slug ?? Str::slug($request->name);

        $categorySlug = Category::where('slug', $category->slug)->get();

        if ($categorySlug->count() >= 1) {
            return response([
                'errors' => [
                    'slug' => ['Код категории должен быть уникальным, укажите другое название или код']
                ]
            ], 422);
        }

        $category->save();

        return response([
            'data' => $category,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
