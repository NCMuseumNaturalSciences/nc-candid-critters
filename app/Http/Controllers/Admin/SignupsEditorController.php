<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SignupsDataTable;
use App\DataTables\SignupsDataTablesEditor;
use DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class SignupsEditorController extends Controller
{
    public function indexeditor(SignupsDataTable $dataTable)
    {
        return $dataTable->render('admin.signups.datatables-editor');
    }
    public function index()
    {
        return view('admin.signups.datatables-editor');
    }
    public function store(SignupsDataTablesEditor $editor)
    {
        return $editor->process(request());
    }

    /**
     * Signups Datatable
     */
    public function getSignupsData()
    {
        $models = DB::table('signups')
            ->select([
                'id',
                'first_name',
                'last_name',
                'email',
                'training_assigned_yn'
            ]);
        return DataTables::of($models)
            ->editColumn('training_assigned_yn', function($model) {
                if ($model->training_assigned_yn == 1) {
                    return "Yes";
                } elseif ($model->training_assigned_yn == 0) {
                    return "No";
                } else {
                    return "";
                };
            })
            ->make(true);
    }
}
