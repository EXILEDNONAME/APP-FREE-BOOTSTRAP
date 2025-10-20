@extends('layouts.backend.__templates.show', ['active' => 'false', 'date' => 'false', 'daterange' => 'false', 'file' => 'false', 'status' => 'false'])
@section('title', 'Datatable Relations')

@section('table-header')
<tr>
    <td class="align-middle font-weight-bold"> Table General </td>
    <td> {{ $data->application_table_general->name }} </td>
</tr>
<tr>
    <td class="align-middle font-weight-bold"> Description </td>
    <td> {{ $data->description }} </td>
</tr>
@endsection