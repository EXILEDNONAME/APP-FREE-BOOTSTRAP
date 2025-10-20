<?php

namespace App\Http\Traits\Backend\__System\Controllers\Datatable\Extension;

use \Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

trait TrashController
{
    public function trash()
    {
        $statusName = property_exists($this, 'status') && $this->status ? $this->status : 'default';
        $statusFilter = DB::table('system_status_filters')->where('name', $statusName)->first();
        $attributes = json_decode($statusFilter->properties ?? '[]', true);

        $model = $this->model;
        $sort = $this->sort;
        $url = $this->url;

        if (request()->ajax()) {
            $query = $this->model::onlyTrashed();

            if (request('deleted_at')) {
                $query->whereDate('deleted_at', request('deleted_at'));
            }

            $datatable = DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('deleted_at', function ($order) {
                    return empty($order->deleted_at) ? NULL : \Carbon\Carbon::parse($order->deleted_at)->format('d F Y, H:i');
                })
                ->editColumn('description', function ($order) {
                    return nl2br(e($order->description));
                });
            foreach (['table_relation_1', 'table_relation_2', 'table_relation_3', 'table_relation_4', 'table_relation_5'] as $relation) {
                if ($this->$relation instanceof \Closure) {
                    $datatable = ($this->$relation)($datatable);
                }
            }
            return $datatable->rawColumns(['description'])->make(true);
        }
        return view($this->path . 'trash', compact(['attributes', 'model', 'sort', 'url']));
    }
}
