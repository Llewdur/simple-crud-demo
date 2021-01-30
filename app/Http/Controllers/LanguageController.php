<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageRequest;
use App\Http\Resources\DatatableCollection;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class LanguageController extends Controller
{
    public function index(): View
    {
        return view('languages.index');
    }

    public function store(LanguageRequest $request): LanguageResource
    {
        $language = Language::create($request->all());

        return new LanguageResource($language);
    }

    public function show(int $id): LanguageResource
    {
        $language = Language::findOrFail($id);

        return new LanguageResource($language);
    }

    public function edit(int $id): JsonResponse
    {
        $language = Language::findOrFail($id);

        return response()->json($language);
    }

    public function update(LanguageRequest $request, int $id): LanguageResource
    {
        $language = Language::findOrFail($id);
        $language->update($request->all());

        return new LanguageResource($language);
    }

    public function destroy(int $id): JsonResponse
    {
        $language = Language::findOrFail($id);
        $language->forceDelete();

        return response()->json([], 204);
    }

    public function datatable(): DatatableCollection
    {
        $languages = Language::latest()->get();

        return new DatatableCollection($languages);
    }
}
