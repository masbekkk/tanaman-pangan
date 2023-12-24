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
            <h1>Data Tanaman Pangan </h1>
        </div>
        <div class="card card-danger ">
            {{-- <div class="card-header">
                <a href="" data-target="#addVDCMasterModal"
                    class="btn btn-icon icon-left btn-primary btn-lg"><i class="fas fa-pen-alt"></i> Add Data</a>
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-light table-hover row-border" style="width:100%" id="table-1">
                        <thead class="" id="header_table">
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Nama Buah</th>
                                <th>Aksi</th>


                            </tr>
                        </thead>
                        <tbody>

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
            const dataColumns = [{
                    data: 'id'
                },
                {
                    data: 'nama_buah'
                },
                {
                    data: 'aksi'
                },


            ];
            var arrayParams = {
                idTable: '#table-1',
                urlAjax: "{{ route('get.buah') }}",
                columns: dataColumns,
                defColumn: [{
                    targets: [2],
                    data: 'id',
                    render: function(data, type, full, meta) {
                        return `<a href="/detail-buah/${full.id}" class="btn btn-outline-info btn-lg detail"><i class="fas fa-info"></i> Detail</a>`
                    },
                }]
            }
            loadAjaxDataTables(arrayParams);
            table.on('xhr', function() {
                jsonTables = table.ajax.json();
                // console.log( jsonTables.data[350]["id"] +' row(s) were loaded' );
            });

            // $('.detail').click( function(e) {
            //     alert("ok")
            // $('#header-table').html(
            //     `
        //     <th>#</th>
        //     <th>Tahun OWEEEEE</th>
        //     <th>Aksi</th>`
            // );
            // })

            // $(document).on('click', `.detail`, function(e) {
            //     // alert("ok")
            //     $('#header-table').html(
            //         `
            //         <tr>
            //         <th>#</th>
            //         <th>Tahun OWEEEEE</th>
            //         <th>Aksi</th>
            //         </tr>
            //         `
            //     );
            // });
        })
    </script>
@endsection
