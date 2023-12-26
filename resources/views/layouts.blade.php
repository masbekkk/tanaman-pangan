<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('logo/logo_rentcon.jpeg') }}" />
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css?ver=1.1"
        type="text/css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css?ver=1.1" type="text/css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/components.css') }}" type="text/css">


    <!-- fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fira+Sans:ital,wght@1,500&family=Kanit:wght@500&family=Oswald:wght@500&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    {{-- css datatables --}}
    <!-- Table Style -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css"> --}}
    <style>
        thead input {
            width: 100%;
        }

        #table-1 {
            width: 100%;
            min-width: 100%;
        }

        #table-1 thead {
            width: 100%;
            min-width: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .select {
            width: 100%;
        }
    </style>

    <!-- Page Specific CSS File -->
    @yield('style')
</head>

<body>
    @yield('modal')
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar ">
                <div class="mr-auto ">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars burger-icon-navbar"></i></a></li>
                        <li><a href="/" class="nav-link nav-link-lg ">
                                <div class="judul-navbar active">SISTEM INFORMASI EKSEKUTIF PRODUKSI TANAMAN PANGAN DI
                                    YOGYAKARTA</div>
                            </a></li>
                    </ul>

                </div>
                <ul class="navbar-nav navbar-right">
                    <li>
                        <div class="d-sm-none d-lg-inline-block text-dark">
                            <strong>Hai, Pengunjung!</strong>
                        </div>
                    </li>

                </ul>
            </nav>

            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="/" class="text-white">SIE - PANGAN JOGJA </a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="/" class="text-white">SIEPJ</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{ Route::is('drilldown') ? 'active' : '' }}"><a class="nav-link"
                                href="
                                    {{ route('drilldown') }}
                                    "><i
                                    class="fas fa-chart-bar"></i> <span>
                                    Drilldown</span></a></li>
                        <li class="menu-header">Data Buah</li>
                        <li class="{{ Route::is('data.buah') || Route::is('detail.buah') ? 'active' : '' }}"><a class="nav-link"
                                href="
                                    {{ route('data.buah') }}
                                    "><i
                                    class="fas fa-layer-group"></i> <span>
                                    Data Buah</span></a></li>

                        <li class="menu-header">Analysis What If</li>
                        <li class="{{ Route::is('analysis') ? 'active' : '' }}"><a class="nav-link"
                                href="
                                                {{ route('analysis') }}
                                                "><i
                                    class="fas fa-table"></i> <span>
                                    Analysis What If</span></a></li>
                    </ul>
                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">

                    </div>

                </aside>
            </div>
        </div>

        <div class="main-content" style="min-height= 698px;">
            {{-- <section class="section" style="min-height: 616px;"> --}}
            {{-- @include('sweetalert::alert') --}}
            @yield('content')
            {{-- </section> --}}
        </div>

        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>
            </div>
            <div class="footer-right">
                {{-- Made With ♥ by <a href="https://www.instagram.com/berkahbekhan.inc/"><text>Mohammad Subkhan
                        @berkahbekhan.inc</text></a> --}}
            </div>

        </footer>
    </div>

</body>

{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<!-- sweetalert js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Template JS File -->
<script src="{{ asset('js/stisla.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

{{-- js datatables --}}
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
{{-- <script src="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css"></script> --}}
{{-- js buttons datatables --}}

<script>
    var table, jsonTables;
    // {{-- function load datatables  --}}
    function loadAjaxDataTables(params) {
        // Setup - add a text input to each footer cell

        $(params.idTable + ' thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo(params.idTable + ' thead');

        table = $(params.idTable).DataTable({
            // orderCellsTop: true,
            fixedHeader: true,
            // dom: 'Plfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            processing: true,
            // scrollX: true,
            // pagingType: 'numbers',
            // serverSide: true,
            initComplete: function() {
                var api = this.api();
                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function(colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');

                        // On every keypress in this input
                        $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('change', function(e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr =
                                    '({search})'; //$(this).parents('th').find('select').val();

                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value + ')))') :
                                        '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function(e) {
                                e.stopPropagation();

                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
            ajax: params.urlAjax,
            columns: params.columns,
            columnDefs: params.defColumn,
        });

        $('#form_filter').submit(function(e) {
            e.preventDefault();
            var tingkat = $('#tingkat').val();
            var kelas = $('#kelas').val();
            var url = '/ajax-rekap/poin-disiplin/' + tingkat + '/' + kelas;
            table.ajax.url(url).load();
        });

        // $('.type_form_select').change(function() {
        //     alert("oke");
        // })

    }
</script>
<!-- Page Specific JS File -->
@yield('script')

</html>
