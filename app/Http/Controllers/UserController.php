<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\DatatableCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('users.index');
    }

    public function store(UserRequest $request): UserResource
    {
        $request['password'] = Hash::make($request['email']);
        $user = User::create($request->all());

        return new UserResource($user);
    }

    public function show(int $id): UserResource
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function edit(int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    public function update(UserRequest $request, int $id): UserResource
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return new UserResource($user);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->forceDelete();

        return response()->json([], 204);
    }

    public function datatable(): DatatableCollection
    {
        $users = User::latest()->get();

        return new DatatableCollection($users);
    }
}
