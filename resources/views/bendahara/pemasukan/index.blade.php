<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">Keuangan</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Bendahara</a></li>
                <li class="breadcrumb-item">Keuangan</li>
                <li class="breadcrumb-item active">Uang Masuk</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Pemasukan Bulanan</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <a href="{{ route('keuangan.pemasukan.create') }}" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Input Pemasukan</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1 p-3">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="no">No</th>
                                        <th class="sort" data-sort="tanggal">Tanggal</th>
                                        <th class="sort" data-sort="sumber">Sumber</th>
                                        <th class="sort" data-sort="keterangan">Keterangan</th>
                                        <th class="sort" data-sort="diinput_oleh">Diinput Oleh</th>
                                        <th class="sort" data-sort="nominal">Nominal</th>
                                        <th class="sort" data-sort="aksi">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($data as $key => $item)
                                    <tr>
                                        <td class="no">{{ $key + 1 }}</td>
                                        <td class="tanggal">{{ $item->tanggal }}</td>
                                        <td class="sumber">{{ $item->sumber_pemasukan }}</td>
                                        <td class="keterangan">{{ $item->keterangan }}</td>
                                        <td class="diinput_oleh">{{ $item->username }}</td>
                                        <td class="nominal"><b>Rp. </b>{{ number_format($item->nominal, 0, ',', '.') }}</td>
                                        <td class="aksi">
                                            <a href="{{ route('keuangan.pemasukan.edit', $item->id_pemasukan) }}" class="btn btn-sm btn-warning">
                                                <i class="ri-pencil-fill me-1"></i>
                                            </a>
                                        </td>
                                    </tr>
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
        <!-- end col -->
    </div>
</x-app-layout>