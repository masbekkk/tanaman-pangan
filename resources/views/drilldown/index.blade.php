@extends('layouts')
@section('title')
    Drilldown Tanaman Pangan
@endsection
@section('style')
    <!-- Include Highcharts theme -->
    <link rel="stylesheet" href="{{ asset('css/highcharts_theme.css') }}">

    <!-- Include your custom styles -->
    <style>
        .highcharts-container {
            width: 100%;
            height: 400px;
            margin-bottom: 1em;
            /* Add space between charts */
        }
    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header ">
            <h1>Drilldown Produksi Tanaman </h1>
        </div>
        <div class="card card-success ">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a id="nav_all" class="nav-link pilih_category" data-category="all"
                            data-link-ajax="{{ route('buah.pertahun') }}" aria-current="true"
                            href="#all_categories">Yogyakarta</a>
                    </li>
                    <li class="nav-item">
                        <a id="nav_luas_lahan" class="nav-link pilih_category" data-category="luas_lahan"
                            data-link-ajax="{{ route('buah.luasLahan') }}" aria-current="true" href="#luas_lahan">Luas
                            Lahan</a>
                    </li>
                    <li class="nav-item">
                        <a id="nav_produksi" class="nav-link pilih_category" data-category="produksi"
                            data-link-ajax="{{ route('buah.produksi') }}" aria-current="true" href="#produksi">Produksi</a>
                    </li>
                    <li class="nav-item">
                        <a id="nav_produktivitas" class="nav-link pilih_category" data-category="produktivitas"
                            data-link-ajax="{{ route('buah.produktivitas') }}" aria-current="true"
                            href="#produktivitas">Produktivitas</a>
                    </li>

                </ul>
            </div>
            <!-- Container for the charts -->
            <div class="card-body" id="chart_container">

            </div>

            <div class="card-footer"></div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        function loadDrilldown(value, drilldown, others) {
            Highcharts.chart(others.idContainer, {
                chart: {
                    type: 'column'
                },
                title: {
                    align: 'center',
                    text: others.title + ' Tanaman Pangan Tahun 2009 - 2022'
                },
                subtitle: {
                    align: 'center',
                    text: 'Klik bar untuk melihat detail'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total ' + others.yTitle + ' (' + others.satuan + ')'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f} ' + others.satuan
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} ' + others
                        .satuan + '</b> dari total<br/>'
                },

                series: [{
                    name: 'Buah',
                    colorByPoint: true,
                    data: value
                }],
                drilldown: {
                    breadcrumbs: {
                        position: {
                            align: 'right'
                        }
                    },
                    series: drilldown
                },
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                enabled: false
                            }
                        }
                    }]
                }
            });
        }

        function loadAjaxChart(category, url, others) {
            $.ajax({
                url: url,
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
                    // console.log(data.results);
                    if (category == 'all') {
                        // alert(category)
                        $('#chart_container').html(
                            `
                        <figure class="highcharts-figure">
                    <div id="containerLuasLahan" class="highcharts-container"></div>
                </figure>

                <figure class="highcharts-figure">
                    <div id="containerProduksi" class="highcharts-container"></div>
                </figure>

                <figure class="highcharts-figure">
                    <div id="containerProduktivitas" class="highcharts-container"></div>
                </figure>
                        `
                        )
                        var otherParam = {
                            idContainer: 'containerLuasLahan',
                            title: 'Luas Panen',
                            yTitle: 'Luas Panen',
                            satuan: 'Hektar',
                        }
                        loadDrilldown(data.resultsLuasLahan, data.drilldownLuasLahan, otherParam);

                        var otherParam = {
                            idContainer: 'containerProduksi',
                            title: 'Produksi',
                            yTitle: 'Produksi',
                            satuan: 'Ton',
                        }
                        loadDrilldown(data.resultsProduksi, data.drilldownProduksi, otherParam);

                        var otherParam = {
                            idContainer: 'containerProduktivitas',
                            title: 'Produktivitas',
                            yTitle: 'Produktivitas',
                            satuan: 'Kwintal/Hektar',
                        }
                        loadDrilldown(data.resultsProduktivitas, data.drilldownProduktivitas, otherParam);
                    } else if (category == 'luas_lahan') {
                        $('#chart_container').html(
                            `
                        <figure class="highcharts-figure">
                    <div id="containerLuasLahan" class="highcharts-container"></div>
                </figure>`);

                        var otherParam = {
                            idContainer: 'containerLuasLahan',
                            title: 'Luas Panen',
                            yTitle: 'Luas Panen',
                            satuan: 'Hektar',
                        }
                        loadDrilldown(data.buahByLuasLahan, data.drillDownBuahByLuasLahan, otherParam);
                    } else if (category == 'produksi') {
                        $('#chart_container').html(
                            `
                        <figure class="highcharts-figure">
                    <div id="containerProduksi" class="highcharts-container"></div>
                </figure>`);

                        var otherParam = {
                            idContainer: 'containerProduksi',
                            title: 'Produksi',
                            yTitle: 'Produksi',
                            satuan: 'Ton',
                        }
                        loadDrilldown(data.buahByProduksi, data.drillDownBuahByProduksi, otherParam);
                    } else if (category == 'produktivitas') {
                        $('#chart_container').html(
                            `
                            <figure class="highcharts-figure">
                    <div id="containerProduktivitas" class="highcharts-container"></div>
                </figure>`
                        );
                        var otherParam = {
                            idContainer: 'containerProduktivitas',
                            title: 'Produktivitas',
                            yTitle: 'Produktivitas',
                            satuan: 'Kwintal/Hektar',
                        }
                        loadDrilldown(data.buahByProduktivitas, data.drillDownBuahByProduktivitas, otherParam);
                    }
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
            $('#nav_all').addClass('active');
            loadAjaxChart('all', "{{ route('buah.pertahun') }}");

            $('.pilih_category').click(function(e) {
                e.preventDefault();
                $('.pilih_category').removeClass("active");
                var category = $(this).data('category');
                var url = $(this).data('link-ajax');
                loadAjaxChart(category, url);
                $('#nav_' + category).addClass('active');

            })
        })
    </script>
@endsection
