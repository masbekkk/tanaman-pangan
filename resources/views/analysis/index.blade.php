@extends('layouts')
@section('title')
    Analysis Tanaman Pangan
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
            <h1>Analysis What If Produksi Tanaman Pangan di Yogyakarta</h1>
        </div>
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    {{-- <div class="card-header">
                        <h4>Masukkan Data Untuk Melihat Hasil</h4>
                    </div> --}}
                    <div class="card-body">
                        <p>Pilih Data untuk Dianalisa</p>
                        <div class="form-group">
                            <label>Tahun</label>
                            <select name="year" class="form-control select2" id="select-year" required>
                                <option value="">Pilih Tahun...</option>
                                @foreach ($tahun as $value)
                                    <option value="{{ $value->tahun }}">{{ $value->tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Buah</label>
                            <select name="fruit" class="form-control" id="select-fruit" required>
                                <option value="">Pilih Buah...</option>
                                @foreach ($buah as $value)
                                    <option value="{{ $value->id }}">{{ $value->nama_buah }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <h6 class="text-success" id="text-result">Data saat ini</h6>
                            <p><strong>Luas Lahan:</strong> <text id="result_luas_lahan"></text></p>
                            <p><strong>Produktivitas:</strong> <text id="result_produktivitas"></text></p>
                            <p><strong>Produksi:</strong> <text id="result_produksi"></text></p>
                        </div>

                    </div>
                    
                </div>
            </div>
            <div class="col">
                <div class="card card-info">
                    {{-- <div class="card-header">
                        <h4 class="text-success" id="text-result">Data saat ini</h4>
                    </div> --}}
                    <div class="card-body">
                        <p>Masukkan Data Untuk Melihat Hasil</p>
                        <div class="form-group">
                            <label>Variabel yang Ingin Diubah</label>
                            <select name="variable" class="form-control" id="select-variable" required>
                                <option value="">Pilih Variabel...</option>
                                <option value="luas_lahan"> Luas Lahan (Hektar)</option>
                                <option value="produktivitas">Produktivitas (Kwintal/Hektar)</option>
                                <option value="produksi">Produksi (Ton)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="number" name="value" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">Lihat Hasil Analysis</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var luas_lahan, produktivitas, produksi;
        function loadSelectedData(fruit, year) {
            $.ajax({
                url: `/analys-buah/${fruit}/${year}`,
                method: "GET",
                async: true,
                dataType: 'json',
                beforeSend: function(xhr) {
                    Swal.fire({
                        title: 'Sedang memuat data... ',
                        html: 'Mohon ditunggu!',
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success: function(data) {
                    Swal.close()
                    luas_lahan = data.luas_lahan
                    produktivitas = data.produktivitas
                    produksi = data.produksi
                    $('#result_luas_lahan').text(luas_lahan)
                    $('#result_produktivitas').text(produktivitas)
                    $('#result_produksi').text(produksi)
                    console.log($('#select-fruit option:selected').text())
                    var nama_buah = $('#select-fruit option:selected').text();
                    $('#text-result').text(
                        `Data ${nama_buah} pada Tahun ${year}`
                    )

                },
                error: function(xhr) {
                    Swal.close()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ada kesalahan dalam memuat data. Coba lagi!',
                    })
                    console.log(xhr.statusText + xhr.responseText)
                }
            });
        }

        $(document).ready(function() {
            var year = "",
                fruit = "";
            
            $('#select-year').change(function() {
                year = $(this).val();

                if (year != "" && fruit != "") {
                    loadSelectedData(fruit, year)
                }
            })

            $('#select-fruit').change(function() {
                fruit = $(this).val();
                // console.log($('#select-fruit option:selected').text())
                if (fruit != "" && year != "") {
                    loadSelectedData(fruit, year)
                }
            })
        })
    </script>
@endsection
