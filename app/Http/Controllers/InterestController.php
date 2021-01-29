<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\InterestRequest;
use App\Http\Resources\InterestResource;
use DataTables;

class InterestController extends Controller
{
    //: InterestCollection
    public function index(Request $request)
    {
        $data = Interest::latest()->get();

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

        return view('interests.ajax', compact('data'));

        // return new InterestCollection(Interest::paginate());
    }

    public function create()
    {
    }

    public function store(InterestRequest $request): InterestResource
    {
        $interest = Interest::create($request->all());

        return new InterestResource($interest);
    }

    public function show(int $id): InterestResource
    {
        $interest = Interest::findOrFail($id);

        return new InterestResource($interest);
    }

    public function edit(int $id)
    {
        $interest = Interest::findOrFail($id);
        return response()->json($interest);
    }

    public function update(InterestRequest $request, int $id): InterestResource
    {
        $interest = Interest::findOrFail($id);
        $interest->update($request->all());

        return new InterestResource($interest);
    }

    public function destroy(int $id): JsonResponse
    {
        $interest = Interest::findOrFail($id);
        $interest->forceDelete();

        return response()->json([], 204);
    }
}
