<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductService
{

    /**
     * @param Store $store
     * @param StoreProductRequest $request
     * @return Model
     */
    public function store(Store $store, StoreProductRequest $request): Model
    {

        try {
            $product = $store->products()->create($request->except('category_ids'));
            $product->categories()->attach($request->category_ids);
            $product->colors()->attach([1, 2]);

            $imageUpload = new ImageUploadService($product);


            $imageUpload->storeMany($request->file('images'), $product);




            $product->load(['categories', 'images']);
        } catch (\Exception $exception) {
            dd($exception);
        }

        return $product;

    }

    /**
     * @param Product $product
     * @param UpdateProductRequest $request
     * @return Product
     */
    public function update(Product $product, UpdateProductRequest $request): Product
    {
        $product->update($request->validated());
        $product->categories()->sync($request->category_ids);

        return $product->load(['categories']);
    }

    /**
     * @param Product $product
     * @return Product
     */
    public function delete(Product $product): Product
    {
        try {
            $product->delete();
            $product->images()->delete();
        } catch (\Exception $exception) {
            dd($exception);
        }

        return $product;
    }

}
