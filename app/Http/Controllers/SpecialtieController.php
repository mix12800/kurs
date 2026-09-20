<?php

namespace App\Http\Controllers;

use App\Models\Specialtie;
use App\Http\Requests\StoreSpecialtieRequest;
use App\Http\Requests\UpdateSpecialtieRequest;
use Nette\Schema\Message;

class SpecialtieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['specialties' => Specialtie::all()]);
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
    public function store(StoreSpecialtieRequest $request)
    {
        $specialtie = Specialtie::create($request->all());
        return response()->json(['specialtie' => $specialtie]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialtie $specialtie)
    {
        return response()->json(['specialtie' => $specialtie]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialtie $specialtie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecialtieRequest $request, Specialtie $specialtie)
    {
        $specialtie->update($request->all());
        return response()->json(['specialtie' => $specialtie]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialtie $specialtie)
    {
        $specialtie->delete();
        return response()->json(['message' => 'ok']);
    }
}
