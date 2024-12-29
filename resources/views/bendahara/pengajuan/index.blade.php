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
                    <h4 class="card-title">List Pengajuan Dana</h4>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Pemohon</th>
                                <th>Tujuan Pengajuan</th>
                                <th>Nominal Pengajuan</th>
                                <th>Verifikasi Atasan</th>
                                <th>Alokasi Bendahara</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->tanggal_pengajuan }}</td>
                                <td>{{ $item->nama }}</td>
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
                                    <a href="{{ route('keuangan.pengajuan_dana.show', $item->id) }}" class="btn btn-sm btn-primary">
                                        <i class="ri-eye-line align-bottom me-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>