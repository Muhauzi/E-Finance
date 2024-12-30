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
                                Saldo Awal Dari {{$saldo_awal->nama_akun ?? '-'}}</p>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fs-4 flex-grow-1 mb-0">Rp. <span class="counter-value"
                                        data-target="{{$saldo_awal->nominal ?? '-'}}">
                                        {{ isset($saldo_awal->nominal) ? number_format($saldo_awal->nominal, 0, ',', '.') : '-' }}
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
                                <th>Nama</th>
                                <th>Nama Akun</th>
                                <th>Tujuan Pengajuan</th>
                                <th>Nominal</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuan as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-3">
                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                                class="img-fluid rounded-circle" alt="...">
                                        </div>
                                        <h5 class="mb-0">{{$item->nama}}</h5>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="mb-0">{{$item->nama_akun}}</h5>
                                </td>
                                <td>
                                    <h5 class="mb-0">{{$item->tujuan_pengajuan}}</h5>
                                </td>
                                <td>
                                    <h5 class="mb-0">Rp. {{number_format($item->nominal_pengajuan, 0, ',', '.')}}</h5>
                                </td>
                                <td>
                                    <h5 class="mb-0">{{$item->created_at}}</h5>
                                </td>
                                <td>
                                    <h5 class="mb-0">
                                        @if ($item->verifikasi_pimpinan == 'pending' && $item->verifikasi_bendahara == 'pending')
                                            <span class="badge bg-soft-warning text-warning">Pending (25%)</span>
                                        @elseif ($item->verifikasi_pimpinan == 'disetujui')
                                            <span class="badge bg-soft-info text-info">In Progress (50%)</span>
                                        @elseif ( $item->verifikasi_bendahara == 'disetujui')
                                            <span class="badge bg-soft-success text-success">Approved (100%)</span>
                                        @else
                                            <span class="badge bg-soft-danger text-danger">Rejected</span>
                                        @endif
                                    </h5>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            // Data pengeluaran dan pemasukan dari backend
            const pengeluaran = @json($pengeluaran); // {"Januari": 0, "Februari": 0, ...}
            const pemasukan = @json($pemasukan); // {"Januari": 0, "Februari": 0, ...}

            // Konversi data pengeluaran dan pemasukan ke array
            const bulan = Object.keys(pengeluaran); // ["Januari", "Februari", ..., "Desember"]
            const dataPengeluaran = Object.values(pengeluaran); // [0, 0, ..., 2116000]
            const dataPemasukan = Object.values(pemasukan); // [0, 0, ..., ...]

            console.log({
                bulan,
                dataPengeluaran,
                dataPemasukan
            }); // Debugging

            document.addEventListener("DOMContentLoaded", function() {
                var options = {
                    series: [{
                            name: 'Pemasukan',
                            data: dataPemasukan
                        },
                        {
                            name: 'Pengeluaran',
                            data: dataPengeluaran
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
                        categories: bulan
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
                            formatter: val => "Rp " + val.toLocaleString()
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