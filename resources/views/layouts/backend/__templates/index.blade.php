@extends('layouts.backend.default')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Main </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus text-xs"></i></button>
                    <button type="button" class="btn btn-tool"><i class="fas fa-sync text-xs"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times text-xs"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="exilednoname_table" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th class="align-middle"></th>
                                <th class="align-middle"></th>
                                <th class="align-middle"> No </th>
                                @yield('table-header')
                                <th class="align-middle">Platform(s)</th>
                                <th class="align-middle">Engine version</th>
                                <th class="align-middle">CSS grade</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    // TABLE INDEX
    $(document).ready(function() {

        let table = $('#exilednoname_table').DataTable({
            // dom: 'tb',
            // info: false,
            // lengthChange: false,
            pageLength: 25,
            serverSide: true,
            searchDelay: 2000,
            "pagingType": "simple_numbers",
            ajax: {
                url: this_url,
                data: function(ex) {
                    ex.date = $('.table_filter_date').val();
                    if (daterange) {
                        const range = $('#dateRange').val();
                        if (range.includes(' to ')) {
                            ex.date_start = range.split(' to ')[0];
                            ex.date_end = range.split(' to ')[1];
                        } else {
                            ex.date_start = range;
                            ex.date_end = range;
                        }
                    }
                }
            },
            columns: [{
                    data: null,
                    name: 'checkbox',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return `<input type="checkbox" class="kt-checkbox checkable" data-id="${row.id}">`;
                    },
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    visible: false
                },
                {
                    data: null,
                    name: 'autonumber',
                    orderable: false,
                    searchable: false,
                    'className': 'text-center',
                    'width': '1',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                ...(status ? [{
                    data: 'status',
                    name: 'status',
                    orderable: true,
                    className: 'text-center text-nowrap',
                    width: '1',
                    render: function(data) {
                        if (data == 1) return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-mono"> ${translations.default.label.default} </span>`;
                        if (data == 2) return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-warning"> ${translations.default.label.pending} </span>`;
                        if (data == 3) return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-info"> ${translations.default.label.progress} </span>`;
                        if (data == 4) return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-success"> ${translations.default.label.success} </span>`;
                        if (data == 5) return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-destructive"> ${translations.default.label.failed} </span>`;
                    }
                }, ] : []),

                ...(file ? [{
                    data: 'file',
                    name: 'file',
                    orderable: false,
                    'className': 'text-center text-nowrap ',
                    'width': '1'
                }, ] : []),

                ...(date ? [{
                    data: 'date',
                    name: 'date',
                    orderable: true,
                    'className': 'text-nowrap',
                    'width': '1',
                    render: function(data, type, row) {
                        if (data == null) {
                            return '<center> - </center>'
                        } else {
                            return data;
                        }
                    }
                }, ] : []),

                ...(daterange ? [{
                        data: 'date_start',
                        orderable: true,
                        'className': 'align-middle text-nowrap',
                        'width': '1',
                        render: function(data, type, row) {
                            if (data == null) {
                                return '<center> - </center>'
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'date_end',
                        orderable: true,
                        'className': 'align-middle text-nowrap',
                        'width': '1',
                        render: function(data, type, row) {
                            if (data == null) {
                                return '<center> - </center>'
                            } else {
                                return data;
                            }
                        }
                    },
                ] : []),

                ...window.tableBodyColumns,

                ...(active ? [{
                    data: 'active',
                    name: 'active',
                    orderable: true,
                    'className': 'align-middle text-center',
                    'width': '1',
                    render: function(data, type, row) {
                        if (data == 0) {
                            return `<a class="flex justify-center table_active" data-id="${row.id}"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" /></a>`;
                        }
                        if (data == 1) {
                            return `<a class="flex justify-center table_inactive" data-id="${row.id}"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" checked="" /></a>`;
                        }
                        if (data == 2) {
                            return `<a class="flex justify-center" id="table_active" data-id="${row.id}"><input class="kt-switch kt-switch-sm kt-switch-mono" type="checkbox" /></a>`;
                        }
                    }
                }, ] : []),

                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                    <td>
                        <div class="kt-menu" data-kt-menu="true">
                            <div class="kt-menu-item" data-kt-menu-item-placement="bottom-end" data-kt-menu-item-placement-rtl="bottom-start" data-kt-menu-item-toggle="dropdown" data-kt-menu-item-trigger="hover">
                                <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"><i class="ki-filled ki-dots-vertical text-lg"></i></button>
                                <div class="kt-menu-dropdown kt-menu-default" data-kt-menu-dismiss="true">
                                    <div class="kt-menu-item"><a class="kt-menu-link" href="${this_url}/${row.id}"><span class="kt-menu-icon"><i class="ki-filled ki-search-list"></i></span><span class="kt-menu-title"> ${translations.default.label.view} </span></a></div>
                                    <div class="kt-menu-item"><a class="kt-menu-link" href="${this_url}/${row.id}/edit"><span class="kt-menu-icon"><i class="ki-filled ki-message-edit"></i></span><span class="kt-menu-title"> ${translations.default.label.edit} </span></a></div>
                                    <div class="kt-menu-item"><a class="kt-menu-link" data-id="${row.id}" data-kt-modal-toggle="#modalDelete"><span class="kt-menu-icon"><i class="ki-filled ki-trash-square"></i></span><span class="kt-menu-title"> ${translations.default.label.delete.delete} </span></a></div>
                                    ${extension === 'management-users' ? `<div class="kt-menu-item"><a class="kt-menu-link" data-id="${row.id}" data-kt-modal-toggle="#modalResetPassword"><span class="kt-menu-icon"><i class="ki-filled ki-key-square"></i></span><span class="kt-menu-title"> ${translations.default.label.reset_password} </span></a></div>` : ''}
                                </div>
                            </div>
                        </div>
                    </td>`;
                    }
                }
            ],
            buttons: [{
                    extend: 'print',
                    title: '',
                    exportOptions: {
                        columns: "thead th:not(.no-export)",
                        orthogonal: "Export",
                        format: {
                            body: function(data, row, column, node) {
                                return safeStrip(data, node);
                            }
                        }
                    }
                },
                {
                    extend: 'copyHtml5',
                    title: '',
                    autoClose: true,
                    exportOptions: {
                        columns: "thead th:not(.no-export)",
                        orthogonal: "Export",
                        format: {
                            body: function(data, row, column, node) {
                                return safeStrip(data, node);
                            }
                        }
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: '',
                    exportOptions: {
                        columns: "thead th:not(.no-export)",
                        orthogonal: "Export",
                        format: {
                            body: function(data, row, column, node) {
                                return safeStrip(data, node);
                            }
                        }
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: '',
                    exportOptions: {
                        columns: "thead th:not(.no-export)",
                        orthogonal: "Export",
                        format: {
                            body: function(data, row, column, node) {
                                return safeStrip(data, node);
                            }
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: '',
                    exportOptions: {
                        columns: "thead th:not(.no-export)",
                        orthogonal: "Export",
                        format: {
                            body: function(data, row, column, node) {
                                return safeStrip(data, node);
                            }
                        }
                    }
                },
            ],
            rowId: 'Collocation',
            select: {
                style: 'multi',
                selector: 'td:first-child .checkable',
            }
        });

        $('#export_print').on('click', function(e) {
            e.preventDefault();
            table.button(0).trigger();
        });
        $('#export_copy').on('click', function(e) {
            e.preventDefault();
            table.button(1).trigger();
        });
        $('#export_csv').on('click', function(e) {
            e.preventDefault();
            table.button(2).trigger();
        });
        $('#export_excel').on('click', function(e) {
            e.preventDefault();
            table.button(3).trigger();
        });
        $('#export_pdf').on('click', function(e) {
            e.preventDefault();
            table.button(4).trigger();
        });
    });
</script>
@endpush