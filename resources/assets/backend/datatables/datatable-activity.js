$(document).ready(function () {
    let defaultSort = sort.split(',').map((item, index) => { return index === 0 ? parseInt(item.trim()) : item.trim(); });
    let table = $('#exilednoname_table').DataTable({
        dom: 'tb', info: false, lengthChange: false, pageLength: 25, serverSide: true, searchDelay: 2000,
        "pagingType": "simple_numbers",
        "initComplete": function (settings, json) {
            $('#exilednoname_table_info').appendTo('#kt-pagination');
            $('.dt-paging').appendTo('#kt-pagination');
            $('#dt-length-0').appendTo('#ex_table_length');
            $('#exilednoname_table_filter').appendTo('#ex_table_filter');
        },
        ajax: {
            url: this_url,
            data: function (ex) {
                ex.date = $('.table_filter_date').val();
                ex.deleted_at = $('.table_filter_deleted_at').val();
                if (daterange) {
                    const range = $('#dateRange').val();
                    if (range.includes(' to ')) { ex.date_start = range.split(' to ')[0]; ex.date_end = range.split(' to ')[1]; }
                    else { ex.date_start = range; ex.date_end = range; }
                }
                ex.filter_status = $('.filter_status').val();
            }
        },
        language: {
            loadingRecords: "",
            emptyTable: `<div class="flex flex-col items-center justify-center text-gray-500"><span class="block text-center"> ${translations.default.label.no_data_available} ... </span></div>`,
            zeroRecords: `<div class="flex flex-col items-center justify-center text-gray-500"><span class="block text-center"> ${translations.default.label.no_data_matching} ... </span></div>`,
        },
        drawCallback: function () { renderPaginationWindow(this.api(), document.getElementById("kt-pagination"), 1); },
        columns: [
            { data: 'created_at', name: 'created_at', visible: false },
            {
                data: null, name: 'autonumber', orderable: false, searchable: false, 'className': 'text-center', 'width': '1',
                render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }
            },
            {
                data: 'description', name: 'description', orderable: true, 'className': 'align-middle', 'width': '1',
                render: function (data, type, row) {
                    if (data == 'created') return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-success"> ${translations.default.label.created} </span>`;
                    if (data == 'updated') return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-warning"> ${translations.default.label.updated} </span>`;
                    if (data == 'deleted') return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-destructive"> ${translations.default.label.deleted} </span>`;
                    if (data == 'restored') return `<span class="kt-badge kt-badge-outline kt-badge-stroke kt-badge-sm kt-badge-info"> ${translations.default.label.restore} </span>`;
                }
            },
            {
                data: 'subjects', name: 'subjects', orderable: true, 'className': 'text-nowrap',
                render: function (data, type, row) { if (data == null) { return '<center> - </center>' } else { return data; } }
            },
            {
                data: 'causer_id', name: 'causer_id', orderable: true, 'className': 'text-nowrap',
                render: function (data, type, row) { if (data == null) { return '<center> - </center>' } else { return data; } }
            },
            { data: 'updated_at', 'className': 'text-nowrap' },
        ],
        buttons: [
            {
                extend: 'print', title: '', exportOptions: {
                    columns: "thead th:not(.no-export)", orthogonal: "Export",
                    format: { body: function (data, row, column, node) { return safeStrip(data, node); } }
                }
            },
            {
                extend: 'copyHtml5', title: '', autoClose: true, exportOptions: {
                    columns: "thead th:not(.no-export)", orthogonal: "Export",
                    format: { body: function (data, row, column, node) { return safeStrip(data, node); } }
                }
            },
            {
                extend: 'csvHtml5', title: '', exportOptions: {
                    columns: "thead th:not(.no-export)", orthogonal: "Export",
                    format: { body: function (data, row, column, node) { return safeStrip(data, node); } }
                }
            },
            {
                extend: 'excelHtml5', title: '', exportOptions: {
                    columns: "thead th:not(.no-export)", orthogonal: "Export",
                    format: { body: function (data, row, column, node) { return safeStrip(data, node); } }
                }
            },
            {
                extend: 'pdfHtml5', title: '', exportOptions: {
                    columns: "thead th:not(.no-export)", orthogonal: "Export",
                    format: { body: function (data, row, column, node) { return safeStrip(data, node); } }
                }
            },
        ],
        rowId: 'Collocation',
        select: {
            style: 'multi',
            selector: 'td:first-child .checkable',
        },
        order: [5, 'desc']
    });

    $('#export_print').on('click', function (e) { e.preventDefault(); table.button(0).trigger(); });
    $('#export_copy').on('click', function (e) { e.preventDefault(); table.button(1).trigger(); });
    $('#export_csv').on('click', function (e) { e.preventDefault(); table.button(2).trigger(); });
    $('#export_excel').on('click', function (e) { e.preventDefault(); table.button(3).trigger(); });
    $('#export_pdf').on('click', function (e) { e.preventDefault(); table.button(4).trigger(); });
});