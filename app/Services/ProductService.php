<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Model;

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
            //Attach Categories
            $product->categories()->attach($request->category_ids);
            //Attach Colors
            $product->colors()->attach([1, 2]);
            //Attach Sizes
            $product->sizes()->attach([2, 4]);
            //Attach Materials
            $product->materials()->attach([1]);

            $imageService = new ImageService($product);
            //Upload and Store Images
            $imageService->storeMany($request->file('images'));

            $product->load_items();

            return $product;

        } catch (\Exception $exception) {
            dd($exception);
        }
    }

    /**
     * @param Product $product
     * @param UpdateProductRequest $request
     * @return Product
     */
    public function update(Product $product, UpdateProductRequest $request): Product
    {
        try {
            $product->update($request->validated());
            $product->categories()->sync($request->category_ids);

            $imageService = new ImageService($product);
            $imageService->update($request->file('images'));
        } catch (\Exception $exception) {
            dd($exception);
        }

        return $product->load(['categories']);
    }

    /**
     * @param Product $product
     * @return Product
     * @throws \Exception
     */
    public function delete(Product $product): Product
    {
        try {
            $imageService = new ImageService($product);
            $imageService->deleteAll();

            $product->delete();
        } catch (\Exception $exception) {
            dd($exception);
        }

        return $product;
    }

}
