<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageRequest;
use App\Http\Resources\LanguageCollection;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    //: LanguageCollection
    public function index(Request $request)
    {
        $data = Language::latest()->get();

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

        return view('languages.ajax', compact('data'));

        // return new LanguageCollection(Language::paginate());
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

    public function edit(int $id)
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
}
