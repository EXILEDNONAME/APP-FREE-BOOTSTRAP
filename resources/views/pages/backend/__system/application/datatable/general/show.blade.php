@extends('layouts.backend.__templates.show', ['active' => 'false', 'date' => 'false', 'daterange' => 'false', 'file' => 'false', 'status' => 'false'])
@section('title', 'Datatable Generals')

@section('table-header')
<tr>
    <td class="align-middle text-nowrap"> Name </td>
    <td> {{ $data->name }} </td>
</tr>
<tr>
    <td class="align-middle text-nowrap"> Description </td>
    <td class="align-middle"> {!! nl2br(e($data->description)) !!} </td>
</tr>
@endsection