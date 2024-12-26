<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">Account</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Keuangan</a></li>
                <li class="breadcrumb-item">Account</li>
                <li class="breadcrumb-item active">Edit Account</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Account</h4>
                </div><!-- end card header -->

                <div class="card-body d-flex justify-content-center mt-3" style="min-height: 100vh;">
                    <form action="{{ route('admin.account.update', $account->id) }}" method="POST" class="col-lg-6">
                        @csrf
                        @method('POST')
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="jenis_akunInput" class="form-label">Jenis Akun</label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-select" name="jenis_akun" disabled>
                                    <option value="Aset" {{ $account->jenis_akun == 'Aset' ? 'selected' : '' }}>Aset / Harta</option>
                                    <option value="Liabilitas " {{ $account->jenis_akun == 'Hutang' ? 'selected' : '' }}>Kewajiban / Hutang</option>
                                    <option value="Modal" {{ $account->jenis_akun == 'Modal' ? 'selected' : '' }}>Modal</option>
                                    <option value="Pendapatan" {{ $account->jenis_akun == 'Pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                                    <option value="Biaya" {{ $account->jenis_akun == 'Biaya' ? 'selected' : '' }}>Biaya</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="kode_akunInput" class="form-label">Kode Akun</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="kode_akun" value="{{ $account->kode_akun }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="nama_group_akunInput" class="form-label">Nama Akun</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="nama_group_akun" value="{{ $account->nama_group_akun }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="keteranganInput" class="form-label">Keterangan</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <textarea class="form-control" name="keterangan" rows="3">{{ $account->keterangan }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="check" style="width: 16px; height: 16px;"></i>
                                Simpan</button>
                            <a href="{{ route('admin.account') }}" class="btn btn-secondary">
                                <i data-feather="x" style="width: 16px; height: 16px;"></i>
                                Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>