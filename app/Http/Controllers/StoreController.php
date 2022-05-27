<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoreResource;
use App\Models\Store;
use App\Http\Requests\StoreStoresRequest;
use App\Http\Requests\UpdateStoresRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StoreController extends Controller
{

    public static string $searchable_key = '';

    public function __construct()
    {
        self::$searchable_key = Store::getSearchableKey();
        $this->authorizeResource(Store::class, 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $stores = Store::search(request()->only(self::$searchable_key ))->paginate()->withQueryString();
        return StoreResource::collection($stores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStoresRequest $request
     * @return StoreResource
     */
    public function store(StoreStoresRequest $request): StoreResource
    {
        $store = auth()->user()->stores()->create($request->validated());
        return new StoreResource($store);
    }

    /**
     * Display the specified resource.
     *
     * @param Store $store
     * @return StoreResource
     */
    public function show(Store $store): StoreResource
    {
        return new StoreResource($store);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateStoresRequest $request
     * @param \App\Models\Store $stores
     * @return StoreResource
     */
    public function update(UpdateStoresRequest $request, Store $store): StoreResource
    {
        $store->update($request->validated());
        return (new StoreResource($store))->additional($this->withMessage("The Store $store->name updated successfully"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Store $store
     * @return StoreResource
     */
    public function destroy(Store $store): StoreResource
    {
        $store->delete();
        return new StoreResource($store);
    }

    public function withMessage(string $message, bool $status = true): array
    {
        return ['message' => $message, 'status' => (int)$status];
    }
}
