<?php

use \Illuminate\Support\Facades\DB;

function DatatableGenerals(?string $search = null)
{
  $data = DB::table('system_application_table_generals')
    ->select('id', 'name')
    ->where('active', 1)
    ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
    ->when(!$search, fn($q) => $q->limit(10)) // Limit cuma untuk initial load
    ->orderBy('name')
    ->get()
    ->map(fn($item) => [
      'id' => $item->id,
      'name' => $item->name,
    ]);

  return response()->json($data);
}

function filter_DatatableGenerals()
{
  $items = DB::table('system_application_table_generals')->orderBy('name', 'asc')->pluck('name', 'name')->toArray();
  return $items;
}
