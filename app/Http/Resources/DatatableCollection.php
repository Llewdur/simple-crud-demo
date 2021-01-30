<?php

namespace App\Http\Resources;

use App\Models\User;
use DataTables;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DatatableCollection extends ResourceCollection
{
    public const COLUMN_NAME = 'actions';

    public function toArray($request)
    {
        return Datatables::of($this->collection)
            ->addIndexColumn()
            ->addColumn(self::COLUMN_NAME, function ($row) {
                return self::getEditButton($row) . ' ' . self::getDeleteButton($row);
            })
            ->rawColumns([self::COLUMN_NAME]);
    }

    private static function getEditButton($row): string
    {
        return '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit">Edit</a>';
    }

    private static function getDeleteButton($row): string
    {
        $deleteButton = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete">Delete</a>';
        $loggedInUserText = 'Logged in user';

        return self::isLoggedInUser($row) ? $loggedInUserText : $deleteButton;
    }

    private static function isLoggedInUser($row): bool
    {
        return $row instanceof User && auth()->user()->id === $row->id;
    }
}
