<?php

namespace App\Http\Controllers;

use App\Models\Spec;
use App\Http\Requests\StoreSpecRequest;
use App\Http\Requests\UpdateSpecRequest;
use Nette\Schema\Message;

class SpecController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['specs' => Spec::all()]);
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
    public function store(StoreSpecRequest $request)
    {
        $Spec = Spec::create($request->all());
        return response()->json(['Spec' => $Spec]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Spec $Spec)
    {
        return response()->json(['Spec' => $Spec]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spec $Spec)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecRequest $request, Spec $Spec)
    {
        $Spec->update($request->all());
        return response()->json(['Spec' => $Spec]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spec $Spec)
    {
        $Spec->delete();
        return response()->json(['message' => 'ok']);
    }
}
