<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\DatatableCollection;
use App\Http\Resources\UserResource;
use App\Jobs\UserStoreJob;
use App\Models\Interest;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $interests = Interest::orderBy('name')->get();
        $languages = Language::orderBy('name')->get();

        return view('users.index', compact(['interests', 'languages']));
    }

    public function store(UserRequest $request): UserResource
    {
        $request['password'] = Hash::make($request['email']);
        $user = User::create($request->except('interest_id'));

        $user->interests()->sync($request->interest_id);

        UserStoreJob::dispatch($user)->onQueue('default');

        return new UserResource($user);
    }

    public function show(int $id): UserResource
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function edit(int $id): JsonResponse
    {
        $user = User::with('interests')->findOrFail($id);

        return response()->json($user);
    }

    public function update(UserRequest $request, int $id): UserResource
    {
        $user = User::findOrFail($id);
        $user->update($request->except('interest_id'));

        $user->interests()->sync($request->interest_id);

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
