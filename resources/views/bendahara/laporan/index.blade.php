<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">Laporan Keuangan</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Keuangan</a></li>
                <li class="breadcrumb-item active">Laporan</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Laporan</h4>

                </div><!-- end card header -->

                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <form id="filterForm" method="GET">
                                        <div class="input-group">
                                            <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="Filter by Date" value="{{ request('tanggal') }}">
                                            <button type="button" id="filterBtn" class="btn btn-primary">Filter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <!-- cetak laporan btn -->
                                    <a href="{{ route('keuangan.laporan.cetak') }}" class="btn btn-primary">
                                        <i class="ri-printer-line me-1"></i>
                                        Cetak Laporan
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1 p-4">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="tanggal">Tanggal</th>
                                        <th class="sort" data-sort="keterangan">Keterangan</th>
                                        <th class="sort text-center" data-sort="Pengeluaran">Pengeluaran</th>
                                        <th class="sort text-center" data-sort="Pemasukan">Pemasukan</th>
                                        <th class="sort text-center" data-sort="Saldo-Akhir">Saldo Akhir</th>
                                        <th class="sort"></th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all" id="tableBody">
                                    @foreach ($data as $key => $item)
                                    <tr>
                                        <td class="tanggal">{{ $item->tanggal }}</td>
                                        <td class="keterangan">{{ $item->keterangan }}</td>
                                        <td class="Pengeluaran text-center"><strong>{{ $item->pengeluaran == 0 ? '-' : 'Rp. ' . number_format($item->pengeluaran, 0, ',', '.') . ',-' }}</strong></td>
                                        <td class="Pemasukan text-center"><strong>{{ $item->pemasukan == 0 ? '-' : 'Rp. ' . number_format($item->pemasukan, 0, ',', '.') . ',-'  }}</strong></td>
                                        <td class="Saldo-Akhir text-center"><strong>Rp. {{ number_format($item->saldo_akhir, 0, ',', '.') }},-</strong></td>
                                        @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="#">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="#">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <x-confirm-alert></x-confirm-alert>
        <x-alert></x-alert>
        <!-- end col -->
    </div>

    <script>
        document.getElementById('filterBtn').addEventListener('click', function() {
            const filterDate = document.getElementById('tanggal').value; // Ambil nilai input tanggal
            const rows = document.querySelectorAll('#tableBody tr'); // Ambil semua baris tabel

            if (!filterDate) {
                alert("Harap masukkan tanggal untuk memfilter!");
                return;
            }

            let hasData = false;

            rows.forEach(row => {
                const rowDate = row.getAttribute('data-tanggal'); // Ambil atribut tanggal dari setiap baris

                if (rowDate === filterDate) {
                    row.style.display = ''; // Tampilkan baris jika tanggal sesuai
                    hasData = true;
                } else {
                    row.style.display = 'none'; // Sembunyikan baris yang tidak sesuai
                }
            });

            if (!hasData) {
                alert(`Tidak ada data ditemukan untuk tanggal ${filterDate}`);
            }
        });
    </script>
</x-app-layout>