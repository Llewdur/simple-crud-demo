<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Http\Requests\LanguageRequest;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\LanguageCollection;

class LanguageController extends Controller
{
    // protected Language $language;

    // public function __construct(Language $language)
    // {
    //     $this->language = $language;
    // }

    public function index():LanguageCollection
    {
        return new LanguageCollection(Language::paginate());
    }

    public function create()
    {
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

    public function edit(Language $language)
    {
    }

    public function update(LanguageRequest $request, int $id)
    {
        $language = Language::findOrFail($id);
        $language->update($request->all());

        return new LanguageResource($language);
    }

    public function destroy(int $id)
    {
        $language = Language::findOrFail($id);
        $language->forceDelete();

        return response()->json([], 204);
    }
}
