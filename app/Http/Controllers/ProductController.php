<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Store;
use App\Services\ImageService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{


    /**
     * @var array|string[]
     */
    public static array $filterKeys = ['search', 'sortBy'];

    /**
     * @var ProductService
     */
    protected ProductService $productService;

    public function __construct()
    {
        $this->authorizeResource(Product::class);
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
        $products = Product::search(request()->only(self::$filterKeys ))->paginate()->withQueryString();

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
    public function show(Store $store, Product $product): ProductResource
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
    public function update(UpdateProductRequest $request, Store $store, Product $product): ProductResource
    {
        $product = $this->productService->update($product, $request);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Store $store
     * @param Product $product
     * @return ProductResource
     */
    public function destroy(Store $store, Product $product): ProductResource
    {
        $product = $this->productService->delete($product);
        return new ProductResource($product);
    }
}
