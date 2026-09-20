<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserReqest;
use App\Http\Requests\RegistrationUserReqest;
use App\Http\Requests\RoleRequest;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function role(RoleRequest $request, User $user)
    {
        $user->role = $request->role;
        $user->specialty_id = ($request->role == 'doctor') ? $request->specialty_id : null;
        $user->save();
        return response()->json(['user' => $user]);
    }

    public function registration(RegistrationUserReqest $request)
    {
        $user = User::create($request->all());
        return response()->json(['token' => $user->createToken('api_token')->plainTextToken, 'user' => $user]);
    }

    public function auth(AuthUserReqest $request)
    {
        $user = User::where('login', $request->login)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json(['token' => $user->createToken('api_token')->plainTextToken, 'user' => $user]);
        }
        return response()->json(['errors' => ['login' => ['Ошибка вхорда.']]], 422);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['users' => User::all()]);
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
    public function store(RegistrationUserReqest $request)
    {
        $user = User::create($request->all());
        return response()->json(['user' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if ($user->id == Auth::id() || Auth::user()->role == 'admin') {
            return response()->json(['user' => $user]);
        }
        return response()->json(['error' => ['code' => 403, 'message' => 'Доступ запрещен']], 403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($user->id == Auth::id() || Auth::user()->role == 'admin') {
            $user->update($request->all());
            return response()->json(['user' => $user]);
        }
        return response()->json(['error' => ['code' => 403, 'message' => 'Доступ запрещен']], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id == Auth::id() || Auth::user()->role == 'admin') {
            $user->delete();
            return response()->json(['message' => 'ok']);
        }
        return response()->json(['error' => ['code' => 403, 'message' => 'Доступ запрещен']], 403);
    }
}
