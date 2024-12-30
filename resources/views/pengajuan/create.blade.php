<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">Pengajuan Dana</h4>

        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                <li class="breadcrumb-item active">Pengajuan Dana</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-4">Form Pengajuan Dana</h4>
                </div>
                <div class="card-body d-flex justify-content-center mt-3 row" style="min-height: 100vh;">
                    <div class="col-lg-4">
                        <form action="{{ route('karyawan.pengajuan.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Tujuan Pengajuan</label>
                                <input type="text" class="form-control" name="tujuan_pengajuan" value="{{ old('tujuan') }}">
                                @error('tujuan_pengajuan')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}">
                                @error('tanggal')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan_pengajuan">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('karyawan.pengajuan') }}" class="btn btn-danger me-2">
                                    <i class="ri-arrow-left-line align-bottom me-1"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-arrow-right-line align-bottom me-1"></i> Next
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>