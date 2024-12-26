<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">Detail Account</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Keuangan</a></li>
                <li class="breadcrumb-item">Account</li>
                <li class="breadcrumb-item active">Edit Detail Account</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Detail Account</h4>
                </div><!-- end card header -->

                <div class="card-body d-flex justify-content-center mt-3" style="min-height: 100vh;">
                    <form action="{{ route('admin.detail_account.update', $detailAccount->id) }}" method="POST" class="col-lg-6">
                        @csrf
                        @method('POST')
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="jenis_akunInput" class="form-label">Jenis Akun</label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control @error('jenis_akun') is-invalid @enderror" name="jenis_akun">
                                    <option value="Aset" {{ $detailAccount->jenis_akun == 'Aset' ? 'selected' : '' }}>Aset / Harta</option>
                                    <option value="Liabilitas" {{ $detailAccount->jenis_akun == 'Hutang' ? 'selected' : '' }}>Kewajiban / Hutang</option>
                                    <option value="Modal" {{ $detailAccount->jenis_akun == 'Modal' ? 'selected' : '' }}>Modal</option>
                                    <option value="Pendapatan" {{ $detailAccount->jenis_akun == 'Pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                                    <option value="Biaya" {{ $detailAccount->jenis_akun == 'Biaya' ? 'selected' : '' }}>Biaya</option>
                                </select>
                                @error('jenis_akun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="kode_akunInput" class="form-label">Kode Akun</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control @error('kode_akun') is-invalid @enderror" name="kode_akun" value="{{ $detailAccount->kode_akun }}">
                                @error('kode_akun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="group_akunInput" class="form-label">Group Akun</label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control @error('group_akun') is-invalid @enderror" name="group_akun">
                                    @foreach ($account as $item)
                                    <option value="{{ $item->id }}" {{ $detailAccount->group_akun == $item->id ? 'selected' : '' }}>{{ $item->nama_group_akun }}</option>
                                    @endforeach
                                </select>
                                @error('group_akun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="nama_account" class="form-label">Nama Account</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control @error('nama_account') is-invalid @enderror" name="nama_account" value="{{ $detailAccount->nama_akun }}">
                                @error('nama_account')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="keteranganInput" class="form-label">Keterangan</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3">{{ $detailAccount->keterangan }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="check" style="width: 16px; height: 16px;"></i>
                                Simpan</button>
                            <a href="{{ route('admin.detail_account') }}" class="btn btn-secondary">
                                <i data-feather="x" style="width: 16px; height: 16px;"></i>
                                Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>