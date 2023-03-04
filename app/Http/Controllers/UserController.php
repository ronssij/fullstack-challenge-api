<?php

namespace App\Http\Controllers;

use App\Facades\Weather;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(request()->limit());

        return UserResource::collection($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $id)
    {
        return Weather::forecast(request('search'), request()->except('search'));
    }
}
