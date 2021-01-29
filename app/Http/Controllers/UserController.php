<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //: UserCollection
    public function index(Request $request)
    {
        $data = User::latest()->get();

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.ajax', compact('data'));

        // return new UserCollection(User::paginate());
    }

    public function create()
    {
    }

    public function store(UserRequest $request): UserResource
    {
        $user = User::create($request->all());

        return new UserResource($user);
    }

    public function show(int $id): UserResource
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function edit(int $id)
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
}
