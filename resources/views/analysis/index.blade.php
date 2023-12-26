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
                        {{-- <form> --}}
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
                            <div class="input-group mb-3">
                                <input type="number" name="value" class="form-control" id="input-value" required>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-light" id="basic-addon2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg" id="btn_submit">Lihat Hasil
                                Analysis</button>
                        </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card card-success">
                    <div class="card-header">
                        <h4 id="text1">Hasil Analysis</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Luas Lahan:</strong> <text id="result_luas_lahan1"></text></p>
                        <p><strong>Produktivitas:</strong> <text id="result_produktivitas1"></text></p>
                        <p><strong>Produksi:</strong> <text id="result_produksi1"></text></p>
                        <p><strong>Kesimpulan:</strong> <text id="kesimpulan1" class="text-dark"></text></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-success">
                    <div class="card-header">
                        <h4 id="text2">Hasil Analysis</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Luas Lahan:</strong> <text id="result_luas_lahan2"></text></p>
                        <p><strong>Produktivitas:</strong> <text id="result_produktivitas2"></text></p>
                        <p><strong>Produksi:</strong> <text id="result_produksi2"></text></p>
                        <p><strong>Kesimpulan:</strong> <text id="kesimpulan2" class="text-dark"></text></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var luas_lahan = "",
            produktivitas = "",
            produksi = "",
            selectedVariable = "",
            value = "";

        var year = "",
            fruit = "",
            nama_buah = "";

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
                    $('#result_luas_lahan').text(luas_lahan + ' Hektar')
                    $('#result_produktivitas').text(produktivitas + ' Kwintal/Hektar')
                    $('#result_produksi').text(produksi + ' Ton')
                    console.log($('#select-fruit option:selected').text())
                    nama_buah = $('#select-fruit option:selected').text();
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

        function calculateLuasLahan(param) {
            var result_produksi, result_produktivitas;
            //jika produktivitas tetap
            result_produksi = param * produktivitas / 10
            $('#result_luas_lahan1').text(param + ' Hektar')
            $('#result_luas_lahan1').addClass('text-primary changed-text')
            $('#result_produktivitas1').text(produktivitas + ' Kwintal/Hektar')
            $('#result_produksi1').text(result_produksi + ' Ton')
            $('#result_produksi1').addClass('text-info result-text')
            $('#text1').text('Hasil Analysis Jika Produktivitas Tetap')
            $('#kesimpulan1').html(`
                Jika anda ingin Luas Lahan ${nama_buah} pada Tahun ${year} seluas <text class="text-warning">${param} Hektar</text>,
                dengan produktivitas tetap yaitu sebesar ${produktivitas} Kwintal/Hektar,
                Maka anda akan mendapatkan Produksi sebesar <strong><text class="text-info">${result_produksi} Ton</text></strong>
            `);

            //jika produksi tetap
            result_produktivitas = produksi * 10 / param
            $('#result_luas_lahan2').text(param + ' Hektar')
            $('#result_luas_lahan2').addClass('text-primary changed-text')
            $('#result_produktivitas2').text(result_produktivitas + ' Kwintal/Hektar')
            $('#result_produktivitas2').addClass('text-info result-text')
            $('#result_produksi2').text(produksi + ' Ton')
            $('#text2').text('Hasil Analysis Jika Produksi Tetap')
            $('#kesimpulan2').html(`
                Jika anda ingin Luas Lahan ${nama_buah} pada Tahun ${year} seluas <text class="text-warning">${param} Hektar</text>,
                dengan produksi tetap yaitu sebesar ${produksi} Ton,
                Maka anda akan mendapatkan Produktivitas sebesar <strong><text class="text-info">${result_produktivitas} Kwintal/Hektar</text></strong>
            `);
        }

        function calculateProduktivitas(param) {
            var result_produksi, result_luas_lahan;
            //jika luas_lahan tetap
            result_produksi = param * luas_lahan / 10
            $('#result_produktivitas1').text(param + ' Kwintal/Hektar')
            $('#result_produktivitas1').addClass('text-primary changed-text')
            $('#result_luas_lahan1').text(luas_lahan + ' Hektar')
            $('#result_produksi1').text(result_produksi + ' Ton')
            $('#result_produksi1').addClass('text-info result-text')
            $('#text1').text('Hasil Analysis Jika Luas Lahan Tetap')
            $('#kesimpulan1').html(`
                Jika anda ingin Produktivitas ${nama_buah} pada Tahun ${year} sebesar <text class="text-warning">${param} Kwintal/Hektar</text>,
                dengan Luas Lahan tetap yaitu sebesar ${luas_lahan} Hektar,
                Maka anda akan mendapatkan Produksi sebesar <strong><text class="text-info">${result_produksi} Ton</text></strong>
            `);

            //jika produksi tetap
            result_luas_lahan = produksi * 10 / param
            $('#result_produktivitas2').text(param + ' Kwintal/Hektar')
            $('#result_produktivitas2').addClass('text-primary changed-text')
            $('#result_luas_lahan2').text(result_luas_lahan + ' Hektar')
            $('#result_luas_lahan2').addClass('text-info result-text')
            $('#result_produksi2').text(produksi + ' Ton')
            $('#text2').text('Hasil Analysis Jika Produksi Tetap')
            $('#kesimpulan2').html(`
                Jika anda ingin Produktivitas ${nama_buah} pada Tahun ${year} sebesar <text class="text-warning">${param} Kwintal/Hektar</text>,
                dengan produksi tetap yaitu sebesar ${produksi} Ton,
                Maka anda akan membutuhkan Luas Lahan sebesar <strong><text class="text-info">${result_luas_lahan} Hektar</text></strong>
            `);
        }

        function calculateProduksi(param) {
            var result_produktivitas, result_luas_lahan;
            //jika luas_lahan tetap
            result_produktivitas = param * luas_lahan / 10
            $('#result_produksi1').text(param + ' Ton')
            $('#result_produksi1').addClass('text-primary changed-text')
            $('#result_luas_lahan1').text(luas_lahan + ' Hektar')
            $('#result_produktivitas1').text(result_produktivitas + ' Ton')
            $('#result_produktivitas1').addClass('text-info result-text')
            $('#text1').text('Hasil Analysis Jika Luas Lahan Tetap')
            $('#kesimpulan1').html(`
                Jika anda ingin Produksi ${nama_buah} pada Tahun ${year} sebesar <text class="text-warning">${param} Ton</text>,
                dengan Luas Lahan tetap yaitu sebesar ${luas_lahan} Hektar,
                Maka anda akan mendapatkan Produktivitas sebesar <strong><text class="text-info">${result_produktivitas} Kwintal/Hektar</text></strong>
            `);

            //jika produktivitas tetap
            result_luas_lahan = param * produktivitas / 10
            $('#result_produksi2').text(param + ' Ton')
            $('#result_produksi2').addClass('text-primary changed-text')
            $('#result_produktivitas2').text(produktivitas + ' Kwintal/Hektar')
            $('#result_luas_lahan2').text(result_luas_lahan + ' Ton')
            $('#result_luas_lahan2').addClass('text-info result-text')
            $('#text2').text('Hasil Analysis Jika Produktivitas Tetap')
            $('#kesimpulan2').html(`
                Jika anda ingin Produksi ${nama_buah} pada Tahun ${year} sebesar <text class="text-warning">${param} Ton</text>,
                dengan Produktivitas tetap yaitu sebesar ${produktivitas} Kwintal/Hektar,
                Maka anda akan membutuhkan Luas Lahan sebesar <strong><text class="text-info">${result_luas_lahan} Kwintal/Hektar</text></strong>
            `);
        }

        function showResult(param) {
            if (luas_lahan != "" && produksi != "" && produktivitas != "" && selectedVariable != "") {
                if (selectedVariable == 'luas_lahan')
                    calculateLuasLahan(param)
                else if (selectedVariable == 'produktivitas')
                    calculateProduktivitas(param)
                else if (selectedVariable == 'produksi')
                    calculateProduksi(param)
            } else {
                alert("Kamu Belum Memilih Data/ Variable Untuk Dianalysis")
            }
        }

        $(document).ready(function() {

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

            $('#select-variable').change(function() {
                selectedVariable = $(this).val();
                if (selectedVariable == 'luas_lahan') {
                    $('#basic-addon2').text('Hektar')
                } else if (selectedVariable == 'produktivitas')
                    $('#basic-addon2').text('Kwintal/Hektar')
                else if (selectedVariable == 'produksi')
                    $('#basic-addon2').text('Ton')

            })

            // $('#input-value').change(function() {
            //     value = $(this).val();
            //     showResult(value)
            // })

            $('#btn_submit').click(function() {
                if (value != "")
                    showResult(value)
                else alert("Kamu Belum Memasukkan Nilai yang Ingin Diubah")
            })

            $('#input-value').keyup(function() {
                value = $(this).val();
                showResult(value)
            })
        })
    </script>
@endsection
