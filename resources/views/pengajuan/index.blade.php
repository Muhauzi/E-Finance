<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">List Pengajuan Dana</h4>

        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Keuangan</a></li>
                <li class="breadcrumb-item active">Pengajuan Dana</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-4">Selamat Datang!</h4>
                </div>
                <div class="card-body">
                    <div class="col-sm">
                        <div class="d-flex justify-content-sm-end mb-3">
                            <a href="{{ route('karyawan.pengajuan.create') }}" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Ajukan Dana</a>
                        </div>
                    </div>
                    <table class="table table-responsive">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Tujuan Pengajuan</th>
                                <th>Nominal Pengajuan</th>
                                <th>Verifikasi Atasan</th>
                                <th>Alokasi Bendahara</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            @if ($item->id_user == Auth::user()->id)
                            <tr class="text-center">
                                <td>{{ $key }}</td>
                                <td>{{ $item->tanggal_pengajuan }}</td>
                                <td>{{ $item->tujuan_pengajuan }}</td>
                                <td>Rp. {{ number_format($item->nominal_pengajuan, 0, ',', '.') }},-</td>
                                @if ($item->verifikasi_pimpinan == 'pending')
                                <td><span class="badge bg-warning">Pending</span></td>
                                @elseif ($item->verifikasi_pimpinan == 'disetujui')
                                <td><span class="badge bg-success">Disetujui</span></td>
                                @else
                                <td><span class="badge bg-danger">Ditolak</span></td>
                                @endif
                                <td>
                                    @if ($item->verifikasi_bendahara == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                    @elseif ($item->verifikasi_bendahara == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                    @else
                                    <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('karyawan.pengajuan.show', $item->id) }}" class="btn btn-sm btn-primary">
                                        <i class="ri-eye-line align-bottom me-1"></i> Detail
                                    </a>
                                    @if ($item->laporan)
                                    <a href="{{ asset('uploads/laporan_pengajuan/' . $item->laporan) }}" class="btn btn-sm btn-success" download>
                                        <i class="ri-download-2-line align-bottom me-1"></i> Download Laporan Pengajuan
                                    </a>
                                    @else
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#uploadLaporanModal{{ $item->id }}">
                                        <i class="ri-upload-2-line align-bottom me-1"></i> Upload Laporan Pengajuan
                                    </button>
                                    @endif

                                    <!-- Modal -->
                                    <div class="modal fade" id="uploadLaporanModal{{ $item->id }}" tabindex="-1" aria-labelledby="uploadLaporanModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="uploadLaporanModalLabel{{ $item->id }}">Upload Laporan Pengajuan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('karyawan.pengajuan.upload_laporan') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id_pengajuan" value="{{ $item->id }}">
                                                        <div class="mb-3">
                                                            <label for="laporan" class="form-label">Laporan</label>
                                                            <input type="file" class="form-control" id="laporan" name="file" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Upload</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>