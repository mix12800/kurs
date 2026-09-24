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
        return response()->json(['offices' => Office::with('doctor')->get()]);
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
        $user = User::where('id', $request->doctor_id)->first();
        if ($user->role == 'doctor') {
            $office = Office::create($request->all());
            return response()->json(['office' => $office]);
        }
        return response()->json(['errors' => ["doctor_id" => ["Нельзя добавить пациента в кабинет."]]], 422);
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        $office = Office::with('doctor.spec')->find($office->id);
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
        $user = User::where('id', $request->doctor_id)->first();
        if ($user->role == 'doctor') {
            $office = Office::create($request->all());
            return response()->json(['office' => $office]);
        }
        return response()->json(['errors' => ["doctor_id" => ["Нельзя добавить пациента в кабинет."]]], 422);
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
