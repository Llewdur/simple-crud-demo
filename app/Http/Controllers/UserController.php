<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\DatatableCollection;
use App\Http\Resources\UserResource;
use App\Jobs\UserStoreJob;
use App\Models\Interest;
use App\Models\Language;
use App\Models\User;
use App\Models\UserInterest;
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
        $user = User::create($request->all());

        self::storeUserInterest($request, $user);

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
        $user = User::with('userInterests')->findOrFail($id);

        return response()->json($user);
    }

    public function update(UserRequest $request, int $id): UserResource
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        self::storeUserInterest($request, $user);

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

    private static function storeUserInterest(UserRequest $request, User $user): void
    {
        UserInterest::where('user_id', $user->id)->forceDelete();

        if (blank($request->interest_id)) {
            return;
        }

        foreach ($request->interest_id as $interest_id) {
            UserInterest::create([
                'user_id' => $user->id,
                'interest_id' => $interest_id,
            ]);
        }
    }
}
