<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">Pengeluaran</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Bendahara</a></li>
                <li class="breadcrumb-item">Keuangan</li>
                <li class="breadcrumb-item active">Input Pengeluaran</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Form Input Pengeluaran</h4>
                </div><!-- end card header -->

                <div class="card-body d-flex justify-content-center mt-3" style="min-height: 100vh;">
                    <form action="{{ route('keuangan.pengeluaran.store') }}" method="POST" class="col-lg-8">
                        @csrf
                        @method('POST')
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="nameInput" class="form-label">Tanggal</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}">
                                </div>
                                @error('tanggal')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="sumber" class="form-label">Jenis Pengeluaran</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="jenis_pengeluaran" value="{{ old('jenis_pengeluaran') }}">
                                @error('jenis_pengeluaran')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="keteranganInput" class="form-label">Keterangan</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <textarea class="form-control" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                                </div>
                                @error('keterangan')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="check" style="width: 16px; height: 16px;"></i>
                                Next</button>
                            <a href="{{ route('keuangan.pengeluaran') }}" class="btn btn-secondary">
                                <i data-feather="x" style="width: 16px; height: 16px;"></i>
                                Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-alert></x-alert>
    <x-confirm-alert></x-confirm-alert>
</x-app-layout>