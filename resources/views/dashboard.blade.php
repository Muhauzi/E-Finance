<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">Dashboard</h4>

        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-xl-4">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span
                                class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                <i data-feather="briefcase" class="text-primary"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 overflow-hidden ms-3">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                Pengajuan Dana</p>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                        data-target="9">0</span></h4>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div><!-- end col -->

        <div class="col-xl-4">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span
                                class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                <i data-feather="dollar-sign" class="text-primary"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 overflow-hidden ms-3">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                Saldo Awal Dari {{$saldo_awal->nama_akun}}</p>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fs-4 flex-grow-1 mb-0">Rp. <span class="counter-value"
                                        data-target="{{$saldo_awal->nominal}}">
                                    {{ number_format($saldo_awal->nominal, 0, ',', '.') }}
                                    </span></h4>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div><!-- end col -->

        <div class="col-xl-4">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span
                                class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                <i data-feather="dollar-sign" class="text-primary"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 overflow-hidden ms-3">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                Saldo Akhir</p>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fs-4 flex-grow-1 mb-0">Rp. <span class="counter-value"
                                        data-target="{{$saldo_akhir}}">
                                    {{ number_format($saldo_akhir, 0, ',', '.') }}
                                    </span></h4>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div><!-- end col -->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Rekapitulasi Kas Keuangan Bulanan</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="rekapitulasi-bulanan" class="apex-charts" dir="ltr">
                    </div>
                </div><!-- end card-body -->

            </div><!-- end card -->
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Pengajuan Dana</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <!-- Table Head -->
                    <table class="table align-middle table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Student</th>
                                <th scope="col">Course</th>
                                <th scope="col">Author</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Process</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Milana Scot</td>
                                <td>UI/UX design</td>
                                <td>Mitchell Flores</td>
                                <td>$450</td>
                                <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><a href="javascript:void(0);" class="link-success">Confirmed</a></td>
                            </tr>
                            <tr>
                                <td>Jassica Welsh</td>
                                <td>3d Animation</td>
                                <td>Dan Evgeni</td>
                                <td>$860</td>
                                <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><a href="javascript:void(0);" class="link-warning">Waiting</a></td>
                            </tr>
                            <tr>
                                <td>Leslie Alexander</td>
                                <td>Logotype Design</td>
                                <td>Olimpia Jordan</td>
                                <td>$450</td>
                                <td>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td><a href="javascript:void(0);" class="link-warning">Waiting</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            // Area chart keuangan
            var series = {
                "rekapkas": {
                    "pengeluaran": [
                        8107.85,
                        8128.0,
                        8122.9,
                        8165.5,
                        8340.7,
                        8423.7,
                        8423.5,
                        8514.3,
                        8481.85,
                        8487.7,
                        8506.9,
                        8626.2
                    ],
                    "pemasukan": [
                        8423.7,
                        8423.5,
                        8514.3,
                        8481.85,
                        8487.7,
                        8506.9,
                        8626.2,
                        8668.95,
                        8668.95,
                        8668.95,
                        8668.95,
                        8668.95
                    ],
                    "bulan": [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec"
                    ]
                }
            }
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var options = {
                    series: [{
                        name: 'Pengeluaran',
                        data: series.pengeluaran.y
                    }],
                    chart: {
                        type: 'area',
                        height: 350,
                        zoom: {
                            enabled: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    xaxis: {
                        type: 'datetime',
                        categories: series.pengeluaran.x
                    },
                    tooltip: {
                        x: {
                            format: 'dd MMM yyyy'
                        },
                    },
                    colors: ['#556ee6']
                };

                var chart = new ApexCharts(document.querySelector("#area_chart_pengeluaran"), options);
                chart.render();
            });

            document.addEventListener("DOMContentLoaded", function() {
                var options = {
                    series: [{
                            name: 'Pemasukan',
                            data: series.pemasukan.prices
                        },
                        {
                            name: 'Pengeluaran',
                            data: series.pengeluaran.y
                        }
                    ],
                    chart: {
                        type: 'area',
                        height: 350,
                        zoom: {
                            enabled: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    xaxis: {
                        type: 'datetime',
                        categories: series.pemasukan.dates
                    },
                    tooltip: {
                        x: {
                            format: 'dd MMM yyyy'
                        },
                    },
                    colors: ['#34c38f', '#556ee6']
                };

                var chart = new ApexCharts(document.querySelector("#area_chart_pemasukan"), options);
                chart.render();
            });

            document.addEventListener("DOMContentLoaded", function() {
                var options = {
                    series: [{
                            name: 'Pemasukan',
                            data: series.rekapkas.pemasukan
                        },
                        {
                            name: 'Pengeluaran',
                            data: series.rekapkas.pengeluaran
                        }
                    ],
                    chart: {
                        type: 'area',
                        height: 350,
                        zoom: {
                            enabled: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    xaxis: {
                        categories: series.rekapkas.bulan
                    },
                    yaxis: {
                        title: {
                            text: 'Rupiah'
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "Rp " + val + " Ribu"
                            }
                        }
                    },
                    colors: ['#00E396', '#FF4560']
                };

                var chart = new ApexCharts(document.querySelector("#rekapitulasi-bulanan"), options);
                chart.render();
            });
        </script>
        <!-- apexcharts -->
        <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/libs/moment/moment.js') }}"></script>

        <!-- areacharts init -->
        <script src="{{ asset('assets/js/pages/apexcharts-area.init.js') }}"></script>
</x-app-layout>