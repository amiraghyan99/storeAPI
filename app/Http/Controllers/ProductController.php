<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Store;
use App\Services\ImageUploadService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    protected $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Store $store
     * @return AnonymousResourceCollection
     */
    public function index(Store $store): AnonymousResourceCollection
    {
        $products = $store->products()->with(['categories', 'colors'])->paginate();
        return ProductResource::collection($products)->additional(compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @param Store $store
     * @return ProductResource
     */
    public function store(StoreProductRequest $request, Store $store): ProductResource
    {
        $product = $this->productService->store($store, $request);

        return new ProductResource($product->load('categories'));

    }

    /**
     * Display the specified resource.
     *
     * @param Store $store
     * @param Product $product
     * @return ProductResource
     */
    public function show(Store $store, Product $product)
    {
        return new ProductResource($product->load('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Store $store
     * @param Product $product
     * @return ProductResource
     */
    public function update(UpdateProductRequest $request, Store $store, Product $product)
    {
        $product = $this->productService->update($product, $request);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Store $store
     * @param Product $product
     * @return Response
     */
    public function destroy(Store $store, Product $product)
    {
        $product = $this->productService->delete($product);
        return $product;
    }
}
