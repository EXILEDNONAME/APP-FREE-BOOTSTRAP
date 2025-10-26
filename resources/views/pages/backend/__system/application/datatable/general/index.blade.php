@extends('layouts.backend.__templates.index', ['page' => 'datatable-index', 'activities' => 'false', 'charts' => 'false', 'active' => 'false', 'date' => 'false', 'daterange' => 'false', 'file' => 'false', 'status' => 'false'])
@section('title', 'Datatable Generals')

@section('table-header')
<th class="align-middle"> Name </th>
<th class="align-middle"> Description </th>
@endsection

@section('table-body')
{ data: 'name', 'className': 'text-nowrap align-middle' },
{ data: 'description', 'className': 'text-nowrap align-middle' },
@endsection