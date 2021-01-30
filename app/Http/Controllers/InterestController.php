<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterestRequest;
use App\Http\Resources\DatatableCollection;
use App\Http\Resources\InterestResource;
use App\Models\Interest;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class InterestController extends Controller
{
    public function index(): View
    {
        return view('interests.index');
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

    public function edit(int $id): JsonResponse
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

    public function datatable(): DatatableCollection
    {
        $interests = Interest::latest()->get();

        return new DatatableCollection($interests);
    }
}
