<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Http\Resources\ProductResource;
use App\Models\File;
use App\Models\Product;
use App\Services\FileService;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductFilter $filter)
    {
        $products = Product::filter($filter);
        $paginate = $products->paginate(20);

        return response([
            'data' => ProductResource::collection($paginate),
            'count' => Product::count()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ], 422);
        }

        $product = new Product();
        $product->fill($request->all());

        $product->price = preg_replace("/[^\d.]/", "", $request->price);

        if (empty($product->slug)) {
            $product->slug = Str::slug($product->name);
        } else {
            $product->slug = Str::slug($product->slug);
        }

        $productSlug = Product::where('slug', $product->slug)->get();

        if (!isset($request->category_id) || empty($request->category_id)) {
            return response([
                'errors' => [
                    'category' => ['Категория товара должна быть выбрана']
                ]
            ], 422);
        }

        if (!isset($request->status_id)) {
            return response([
                'errors' => [
                    'status' => ['Статус товара должен быть выбран']
                ]
            ], 422);
        }

        if ($productSlug->count() >= 1) {
            return response([
                'errors' => [
                    'slug' => ['Код товара должен быть уникальным, укажите другой код']
                ]
            ], 422);
        }

        $product->save();

        return response([
            'status' => 'success',
            'data' => new ProductResource($product)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response([
            'data' => new ProductResource($product)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'numeric:required',
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ], 422);
        }

        if (!isset($request->category['id'])) {
            return response([
                'errors' => [
                    'category' => ['Категория товара должна быть выбрана']
                ]
            ], 422);
        }

        if (!isset($request->status['id'])) {
            return response([
                'errors' => [
                    'status' => ['Статус товара должен быть выбран']
                ]
            ], 422);
        }

        $product->fill($request->all());
        $product->price = preg_replace("/[^\d.]/", "", $request->price);

        $product->status()->associate($request->status['id']);

        if (isset($request->branch['id']) && $request->branch['id'] > 0) {
            $product->branch()->associate($request->branch['id']);
        }

        if (isset($request->unit['id']) && $request->unit['id'] > 0) {
            $product->unit()->associate($request->unit['id']);
        }

        $product->category()->associate($request->category['id']);

        $fileService = new FileService('/products/' . $product->id);

        if (isset($request->frontImage['base64'])) {

            $fileDB = $fileService->downloadBase64(
                $request->frontImage['base64'],
                [
                    'real_name' => $request->frontImage['real_name'],
                    'mime' => $request->frontImage['mime'],
                ]
            );

            if (!$product->frontImage()->first()) {
                $product->frontImage()->attach($fileDB->id, ['name' => $fileDB->real_name, 'type' => 'front']);
            } else {
                $product->frontImage()->detach();
                $product->frontImage()->attach($fileDB->id, ['name' => $fileDB->real_name, 'type' => 'front']);
            }
        }

        if (isset($request->images)) {
            foreach ($request->images as $key => $image) {

                if (isset($image['deleted']) && $image['deleted'] == 'Y') {
                    $file = File::find($image['file_id']);

                    $product->images()->detach($file->id);
                    Storage::disk('public')->delete($file->path);
                    $file->delete();

                    continue;
                }

                if (isset($image['base64'])) {

                    $fileDB = $fileService->downloadBase64(
                        $image['base64'],
                        [
                            'real_name' => $image['real_name'],
                            'mime' => $image['mime'],
                        ]
                    );

                    $product->images()->attach($fileDB->id, ['name' => $image['name'], 'type' => 'image', 'position' => $image['position']]);
                } else {
                    $fileDB = File::find($image['file_id']);

                    $product->images()->updateExistingPivot($fileDB->id, ['name' => $image['name'], 'position' => $image['position']]);
                }
            }
        }

        if (isset($request->documents)) {
            foreach ($request->documents as $key => $image) {

                if (isset($image['deleted']) && $image['deleted'] == 'Y') {
                    $file = File::find($image['file_id']);

                    $product->documents()->detach($file->id);
                    Storage::disk('public')->delete($file->path);
                    $file->delete();

                    continue;
                }

                if (isset($image['base64'])) {

                    $fileDB = $fileService->downloadBase64(
                        $image['base64'],
                        [
                            'real_name' => $image['real_name'],
                            'mime' => $image['mime'],
                        ]
                    );

                    $product->images()->attach($fileDB->id, ['name' => $image['name'], 'type' => 'document', 'position' => $image['position']]);
                } else {
                    $fileDB = File::find($image['file_id']);

                    $product->documents()->updateExistingPivot($fileDB->id, ['name' => $image['name'], 'position' => $image['position']]);
                }
            }
        }

        if (empty($product->slug)) {
            $product->slug = Str::slug($product->name);
        } else {
            $product->slug = Str::slug($product->slug);
        }

        $productSlug = Product::where('slug', $product->slug)->whereNot('id', $product->id)->get();

        if ($productSlug->count() >= 1) {
            return response([
                'errors' => [
                    'slug' => ['Код товара должен быть уникальным, укажите другой код']
                ]
            ], 422);
        }

        if ($request->properties) {
            foreach ($request->properties as $key => $property) {
                $propertiesDouble = $product->properties()->where('property_id', $property['property_id'])->get();

                if ($propertiesDouble->count() > 1) {
                    $product->properties()->detach($propertiesDouble);
                }

                if (!$product->properties()->where('property_id', $property['property_id'])->first()) {
                    $product->properties()->attach(
                        $property['property_id'],
                        ['value' => $property['value'], 'is_hidden' => $property['is_hidden']]
                    );
                } else {
                    $product->properties()->updateExistingPivot(
                        $property['property_id'],
                        ['value' => $property['value'], 'is_hidden' => $property['is_hidden']]
                    );
                }
            }
        }

        $product->save();

        return response([
            'status' => 'success',
            'data' => new ProductResource($product)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $productPath = "/products/" . $product->id . "/";
        $frontImage = $product->frontImage()->first();

        if ($frontImage) {
            $product->frontImage()->detach();

            $file = File::find($frontImage->file_id);
            $file->delete();
        }

        $imagesIds = $product->images()->get()->modelKeys();

        if (count($imagesIds) > 0) {
            $product->images()->detach();

            $files = File::find($imagesIds);

            foreach ($files as $key => $file) {

                Storage::disk('public')->delete($file->path);
                $file->delete();
            }
        }

        $docIds = $product->documents()->get()->modelKeys();

        if (count($docIds) > 0) {
            $product->documents()->detach();

            $files = File::find($docIds);

            foreach ($files as $key => $file) {

                Storage::disk('public')->delete($file->path);
                $file->delete();
            }
        }

        $product->delete();

        return response([
            'message' => 'Товар успешно удален',
        ]);
    }
}
