<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use App\Http\Requests\StoreStoresRequest;
use App\Http\Requests\UpdateStoresRequest;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Stores $stores)
    {
        $stores = $stores->paginate();

        return response()->json(compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreStoresRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreStoresRequest $request)
    {
        $status = 200;
        $stores = auth()->user()->stores()->create($request->validated());

        return response()->json(['stores' => $stores, $status]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Stores $stores
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $status = 1;
        $stores = Stores::find($id);
        if (!$stores) $status = 0;
        return response()->json(['stores' => $stores, 'status' => $status]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Stores $stores
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $stores = Stores::find($id);
        return response()->json(['stores' => $stores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateStoresRequest $request
     * @param \App\Models\Stores $stores
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateStoresRequest $request, $id)
    {
        $status = 400;
        $stores = Stores::find($id);
        if ($stores) {
            $status = 200;
            $stores->update($request->validated());
        }

        return response()->json(['stores' => $stores, 'status' => $status], $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Stores $stores
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $status = 400;
        $stores = Stores::find($id);
        if ($stores) {
            $status = 200;
            $stores->delete();
        }
        return response()->json(compact('status'), $status);
    }
}
