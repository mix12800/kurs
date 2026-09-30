<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;
use App\Models\User;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['offices' => Office::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfficeRequest $request)
    {
        $office = Office::create($request->all());
        return response()->json(['office' => $office]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        return response()->json(['office' => $office]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfficeRequest $request, Office $office)
    {
        $is_office = Office::where('num', $request->num)->first();

        if ($is_office && $is_office->id != $office->id) {
            return response()->json(['errors' => ['name' => ['Такое значение поля Номер уже существует.']]], 422);
        }

        $office->update($request->all());
        return response()->json(['office' => $office]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        $office->delete();
        return response()->json(["message" => "ok"]);
    }
}
