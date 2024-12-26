<x-app-layout>
<x-page-title>
        <h4 class="mb-sm-0">Detail Account</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Keuangan</a></li>
                <li class="breadcrumb-item active">Detail Account</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail Account</h4>
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
                                    <a href="{{ route('admin.detail_account.create')}}" type="button" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Input Detail Account</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1 p-4">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="kode_akun">Kode Akun</th>
                                        <th class="sort" data-sort="nama_akun">Nama Akun</th>
                                        <th class="sort" data-sort="keterangan">Keterangan</th>
                                        <th class="sort"></th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($data as $key => $item)
                                    <tr>
                                        <td class="kode_akun">{{ $item->kode_akun }}</td>
                                        <td class="nama_akun">{{ $item->nama_akun }}</td>
                                        <td class="keterangan">{{ $item->keterangan }}</td>
                                        <td class="aksi">
                                            <a href="{{ route('admin.detail_account.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="ri-pencil-fill me-1"></i></a>
                                            <form action="{{ route('admin.detail_account.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="ri-delete-bin-6-fill me-1"></i></button>
                                            </form>
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
        <x-confirm-alert></x-confirm-alert>
            <x-alert></x-alert>
        <!-- end col -->
    </div>
</x-app-layout>