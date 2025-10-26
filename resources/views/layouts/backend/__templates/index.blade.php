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
                                <th class="align-middle" width="1"></th>
                                <th class="align-middle" width="1"></th>
                                <th class="align-middle" width="1"> No </th>
                                @yield('table-header')
                                <th class="align-middle" width="1"></th>
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

        let defaultSort = sort.split(',').map((item, index) => {
            return index === 0 ? parseInt(item.trim()) : item.trim();
        });
        let table = $('#exilednoname_table').DataTable({
            // dom: 'tb',
            // info: false,
            // lengthChange: false,
            pageLength: 25,
            serverSide: true,
            searchDelay: 2000,
            "pagingType": "simple_numbers",
            rowId: 'Collocation',
            select: {
                style: 'multi',
                selector: 'td:first-child .checkable',
            },
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
            headerCallback: function(thead, data, start, end, display) {
                thead.getElementsByTagName('th')[0].innerHTML = `<input id="check" type="checkbox" class="kt-checkbox group-checkable" data-kt-datatable-row-check="true" value="0" />`;
            },
            columns: [{
                    data: null,
                    name: 'checkbox',
                    'className': 'text-center align-middle',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return `<input type="checkbox" class="checkable" data-id="${row.id}">`;
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
                    'className': 'text-center align-middle',
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
                        <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                      
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item" href="#"> View </a>
                      <a class="dropdown-item" href="#"> Edit </a>
                      <a class="dropdown-item" href="#"> Delete </a>
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
            order: [defaultSort]
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

    // GROUP CHECKABLE
    $('#exilednoname_table').on('change', '.group-checkable', function() {
        const checked = $(this).is(':checked');

        $('#exilednoname_table').DataTable().rows().every(function() {
            const $checkbox = $(this.node()).find('.checkable');
            $checkbox.prop('checked', checked);
            checked ? this.select() : this.deselect();
        });

        const count = $('#exilednoname_table').DataTable().rows({
            selected: true
        }).count();
        $('#exilednoname_selected').text(count);
        const isChecked = count > 0;
        $('#checkbox_batch').toggleClass('hidden', !isChecked);
        toast_notification(isChecked ? translations.default.notification.row_checked : translations.default.notification.row_unchecked);
    });

    // CHECKABLE
    $('#exilednoname_table').on('change', '.checkable', function() {
        $(this).closest('tr').toggleClass('selected', $(this).is(':checked'));
        $('#exilednoname_selected').html($('#exilednoname_table').DataTable().rows('.selected').nodes().length);
        $('#checkbox_batch').toggleClass('hidden', $('#exilednoname_table').DataTable().rows('.selected').nodes().length === 0);
        document.querySelector('#check').indeterminate = $('#exilednoname_table').DataTable().rows('.selected').nodes().length > 0;
    });
</script>
@endpush