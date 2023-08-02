<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ClientUserRequest;
use App\Models\ClientUser;

class ClientUserController extends Controller
{
    public function index()
    {
        return ClientUser::all();
    }

    public function store(ClientUserRequest $request)
    {
        return ClientUser::create($request->validated());
    }

    public function show(ClientUser $clientUser)
    {
        return $clientUser;
    }

    public function update(ClientUserRequest $request, ClientUser $clientUser)
    {
        $clientUser->update($request->validated());

        return $clientUser;
    }

    public function destroy(ClientUser $clientUser)
    {
        $clientUser->delete();

        return response()->json();
    }
}
