<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">Pemasukan</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Bendahara</a></li>
                <li class="breadcrumb-item">Keuangan</li>
                <li class="breadcrumb-item active">Tambah Pemasukan</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Tambah Pemasukan</h4>
                </div><!-- end card header -->

                <div class="card-body d-flex justify-content-center mt-3" style="min-height: 100vh;">
                    <form action="{{ route('keuangan.pemasukan.store') }}" method="POST" class="col-lg-6">
                        @csrf
                        @method('POST')
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="nameInput" class="form-label">Tanggal</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}" >
                                </div>
                                @error('tanggal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="sumber" class="form-label">Sumber Pemasukan</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="sumber_pemasukan" value="{{ old('sumber_pemasukan') }}">
                                @error('sumber_pemasukan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="nameInput" class="form-label">Lokasi Akun</label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" data-choices data-choices-search="true" name="id_detail_account"
                                    id="choices-single-default">
                                    <option value="">Pilih Akun</option>
                                    @foreach ($data as $item)
                                    <option value="{{ $item->id }}" {{ old('id_detail_account') == $item->id ? 'selected' : '' }}>{{ $item->kode_akun . ' | ' . $item->nama_akun }}</option>
                                    @endforeach
                                </select>
                                @error('id_detail_account')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="nameInput" class="form-label">Nominal</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" class="form-control" name="nominal" aria-label="Satuan Rupiah" value="{{ old('nominal') }}">
                                </div>
                                @error('nominal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="nameInput" class="form-label">Saldo Akhir</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <h5 id="saldo_akhir">Rp.0</h5>
                                </div>
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
                                Simpan</button>
                            <a href="{{ route('keuangan.pemasukan') }}" class="btn btn-secondary">
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


    <script>
        const nominal = document.querySelector('input[name="nominal"]');
        const saldo_akhir = document.getElementById('saldo_akhir');

        nominal.addEventListener('input', function() {
            const nominalValue = nominal.value ? parseInt(nominal.value) : 0;
            const saldo_akhirValue = "Rp." + nominalValue.toLocaleString('id-ID');
            saldo_akhir.innerHTML = saldo_akhirValue;
        });
    </script>
</x-app-layout>