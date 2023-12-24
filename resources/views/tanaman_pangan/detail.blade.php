@extends('layouts')
@section('title')
    Data Tanaman Pangan
@endsection
@section('style')
    {{-- <style>
        th {
            white-space: nowrap;
            /* Prevent text wrapping */
        }

        th:nth-child(1) {
            width: 5%;
            /* Adjust the width based on your needs */
        }

        th:nth-child(2) {
            width: 70%;
            /* Adjust the width based on your needs */
        }

        th:nth-child(3) {
            width: 25%;
            /* Adjust the width based on your needs */
        }
    </style> --}}
@endsection

@section('content')
    <section class="section">
        <div class="section-header ">
            <h1>Detail Produksi Tanaman {{ $dataBuah->buah->nama_buah }} </h1>
        </div>
        <div class="card card(-danger ">
            <div class="card-header">
                <a href="#" class="btn btn-icon icon-left btn-info btn-lg" onclick="window.history.go(-1); return false;"><i class="fas fa-chevron-circle-left"></i> Data Buah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-light table-hover row-border" style="width:100%" id="table-1">
                        <thead class="" id="header_table">
                            <tr>
                                <th class="text-center">
                                    Tahun
                                </th>
                                <th>Luas Lahan (Hektar)</th>
                                <th>Produktivitas (Kwintal/ Hektar) </th>
                                <th>Produksi (Ton)</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $value)
                                <tr>
                                    <td>{{ $value->tahun }}</td>
                                    <td>{{ $value->luas_lahan }} Ha</td>
                                    <td>{{ $value->produksi }} Kw/Ha</td>
                                    <td>{{ $value->produktivitas }} Ton</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#table-1' + ' thead tr')
                .clone(true)
                .addClass('filters')
                // .appendTo('#table-1' + ' thead');

            $('#table-1').DataTable({
                // orderCellsTop: true,
                fixedHeader: true,
            });
        });
        //     const dataColumns = [{
        //             data: 'id'
        //         },
        //         {
        //             data: 'nama_buah'
        //         },
        //         {
        //             data: 'aksi'
        //         },


        //     ];
        //     var arrayParams = {
        //         idTable: '#table-1',
        //         urlAjax: "{{ route('get.buah') }}",
        //         columns: dataColumns,
        //         defColumn: [{
        //             targets: [2],
        //             data: 'id',
        //             render: function(data, type, full, meta) {
        //                 return `<a class="btn btn-outline-info btn-lg detail"><i class="fas fa-info"></i> Detail</a>`
        //             },
        //         }]
        //     }
        //     loadAjaxDataTables(arrayParams);
        //     table.on('xhr', function() {
        //         jsonTables = table.ajax.json();
        //         // console.log( jsonTables.data[350]["id"] +' row(s) were loaded' );
        //     });
        // })
    </script>
@endsection
