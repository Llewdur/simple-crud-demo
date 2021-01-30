<?php

namespace App\Http\Resources;

use DataTables;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DatatableCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return Datatables::of($this->collection)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '
                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit">Edit</a>
                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete">Delete</a>
                ';
            })
            ->rawColumns(['actions']);
    }
}
