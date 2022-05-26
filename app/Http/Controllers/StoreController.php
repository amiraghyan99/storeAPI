<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Http\Requests\StoreStoresRequest;
use App\Http\Requests\UpdateStoresRequest;

class StoreController extends Controller
{
//    for filter
    const QUERIES = ['search'];

    public function __construct()
    {
        $this->authorizeResource(Store::class, 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $stores = Store::filter(request()->only(static::QUERIES))->paginate()->withQueryString();

        return response()->json(compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreStoresRequest $request)
    {
        $stores = auth()->user()->stores()->create($request->validated());

        return response()->json(['stores' => $stores]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Store $stores
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Store $store)
    {
        return response()->json(compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateStoresRequest $request
     * @param \App\Models\Store $stores
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateStoresRequest $request, Store $store)
    {
        $store->update($request->validated());
        return response()->json([compact('store')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Store $stores
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Store $store)
    {
        $store->delete();
        return response()->json(['message' => 'The Store ' . $store->name . ' deleted.']);
    }
}
