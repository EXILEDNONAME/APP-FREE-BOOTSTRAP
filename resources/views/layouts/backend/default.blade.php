<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | DataTables</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/backend/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/backend/css/adminlte.min.css">
    <style>
        /* Custom Modern Sorting Icons - Tailwind Style */
        table.dataTable thead .sorting,
        table.dataTable thead .sorting_asc,
        table.dataTable thead .sorting_desc {
            position: relative;
            line-height: 0.75;
            cursor: pointer;
            padding-right: 30px !important;
        }

        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc:after {
            position: absolute;
            display: block;
            opacity: 0.3;
            right: 10px;
            line-height: 2.25;
            font-size: 0.9em;
        }

        /* Default sorting icon - kedua panah muncul */
        table.dataTable thead .sorting:before {
            content: "\f0de";
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            top: 8px;
            color: #6c757d;
            opacity: 0.3;
        }

        table.dataTable thead .sorting:after {
            content: "\f0dd";
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            bottom: 8px;
            color: #6c757d;
            opacity: 0.3;
        }

        /* Ascending - panah atas biru, bawah tetap abu */
        table.dataTable thead .sorting_asc:before {
            content: "\f0de";
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            top: 8px;
            opacity: 1;
            color: rgb(0, 130, 170);
        }

        table.dataTable thead .sorting_asc:after {
            content: "\f0dd";
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            bottom: 8px;
            opacity: 0.3;
            color: #6c757d;
        }

        /* Descending - panah bawah biru, atas tetap abu */
        table.dataTable thead .sorting_desc:before {
            content: "\f0de";
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            top: 8px;
            opacity: 0.3;
            color: #6c757d;
        }

        table.dataTable thead .sorting_desc:after {
            content: "\f0dd";
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            bottom: 8px;
            opacity: 1;
            color: rgb(0, 130, 170);
        }

        /* Modern card styling */
        /* .card {
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        } */

        /* Modern table styling */
        .table thead th {
            border-bottom: 2px solid #e9ecef;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* DataTables modern wrapper */
        .dataTables_wrapper .dataTables_length select {
            padding: 0.375rem 2rem 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            margin-left: 0.5rem;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #000000;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }
    </style>

</head>

<body class="sidebar-mini layout-navbar-fixed layout-fixed layout-footer-fixed">
    <div class="wrapper">
        @include('layouts.backend.__includes.navbar')
        @include('layouts.backend.__includes.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <!-- BREADCRUMB -->
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        @include('layouts.backend.__includes.footer')

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <script src="/assets/backend/plugins/jquery/jquery.min.js"></script>
    <script src="/assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/backend/plugins/jszip/jszip.min.js"></script>
    <script src="/assets/backend/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/assets/backend/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/assets/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/assets/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="/assets/backend/js/adminlte.min.js"></script>
    <script src="/assets/backend/js/demo.js"></script>

    <script>
        fetch("{{ route('assets.lang') }}").then(response => {
            return response.json();
        }).then(data => {
            translations = data;
        });
        window.translations = {
            default: {
                label: {
                    no_data_available: "{{ __('default.label.no_data_available') }}",
                    no_data_matching: "{{ __('default.label.no_data_matching') }}",
                }
            }
        };
    </script>

    <script>
        var this_url = "{{ URL::Current() }}";
        var active = "{{ !empty($active) && $active == 'true' ? 'true' : '' }}";
        var date = "{{ !empty($date) && $date == 'true' ? 'true' : '' }}";
        var daterange = "{{ !empty($daterange) && $daterange == 'true' ? 'true' : '' }}";
        var extension = "{{ !empty($extension) && $extension != '' ? $extension : '' }}";
        var file = "{{ !empty($file) && $file == 'true' ? 'true' : '' }}";
        var status = "{{ !empty($status) && $status == 'true' ? 'true' : '' }}";
        var sort = "{{ !empty($sort) && $sort > 0 ? $sort : '1, desc' }}";
        window.tableBodyColumns = [
            @yield('table-body')
        ];
    </script>

    @stack('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>