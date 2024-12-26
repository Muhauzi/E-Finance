<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">Keuangan</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Bendahara</a></li>
                <li class="breadcrumb-item">Keuangan</li>
                <li class="breadcrumb-item active">Uang Keluar</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Pengeluaran Bulanan</h4>
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
                                    <a href="{{ route('keuangan.pengeluaran.create') }}" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Input Pengeluaran</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1 p-3">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="no">No</th>
                                        <th class="sort" data-sort="tanggal">Tanggal</th>
                                        <th class="sort" data-sort="keterangan">Keterangan</th>
                                        <th class="sort" data-sort="jenis_pengeluaran">Jenis Pengeluaran</th>
                                        <th class="sort" data-sort="nominal">Nominal</th>
                                        <th class="sort" data-sort="struk">Struk</th>
                                        <th class="sort" data-sort="aksi">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($data as $key => $item)
                                    <tr>
                                        <td class="no">{{ $key }}</td>
                                        <td class="tanggal">{{ $item->tanggal }}</td>
                                        <td class="keterangan">{{ $item->keterangan }}</td>
                                        <td class="jenis_pengeluaran">{{ $item->jenis_pengeluaran }}</td>
                                        <td class="nominal">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                                        <td class="struk">
                                            @if ($item->images)
                                            <a href="{{ asset('pengeluaran/struk/' . $item->images['file']) }}" target="_blank">
                                            <i class="ri-file-download-line align-middle me-1"></i>    
                                            Lihat Struk</a>
                                            @else
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadStrukModal">
                                                <i class="ri-upload-2-line align-middle me-1"></i>
                                                Upload Struk
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="uploadStrukModal" tabindex="-1" aria-labelledby="uploadStrukModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="uploadStrukModalLabel">Upload Struk</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- cspell: disable -->
                                                            <form action="{{ route('keuangan.pengeluaran.upload_struk') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('POST')
                                                                <input type="hidden" name="pengeluaran_id" value="{{ $item->id }}">
                                                                <div class="mb-3">
                                                                    <label for="struk" class="form-label">Struk</label>
                                                                    <input type="file" class="form-control" id="struk" name="struk_nota" required accept=".pdf">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Upload</button>
                                                            </form>
                                                            <!-- cspell: enable -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </td>
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

    <!-- dropzone min -->
    <script src="assets/libs/dropzone/dropzone-min.js"></script>
    <script>
        var dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
        dropzonePreviewNode.id = "";
        var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
        dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
        var dropzone = new Dropzone(".dropzone", {
            url: "{{ route('keuangan.pengeluaran.upload_struk') }}",
            method: "post",
            previewTemplate: previewTemplate,
            previewsContainer: "#dropzone-preview",
        });
    </script>

    <x-alert></x-alert>

</x-app-layout>