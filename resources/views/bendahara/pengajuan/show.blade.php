<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">Data Pengajuan Dana</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Bendahara</a></li>
                <li class="breadcrumb-item">Pengajuan Dana</li>
                <li class="breadcrumb-item active">Detail Pengajuan Dana</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0">
                        <h4>Detail Pengajuan Dana</h4>
                        <a href="{{ route('keuangan.pengajuan_dana') }}" class="btn btn-danger" style="float: right;">
                            <i class="ri-arrow-left-line align-middle me-1"></i>
                            Kembali
                        </a>
                    </div>
                </div><!-- end card header -->

                <div class="card-body d-flex justify-content-center mt-3" style="min-height: 100vh;">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <label for="nameInput" class="form-label">Tanggal</label>
                                        </td>
                                        <td>
                                            {{ $data->tanggal_pengajuan }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="sumber" class="form-label">Nama Pemohon</label>
                                        </td>
                                        <td>
                                            {{$data->nama}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="sumber" class="form-label">Tujuan Pengajuan</label>
                                        </td>
                                        <td>
                                            {{$data->tujuan_pengajuan}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="keteranganInput" class="form-label">Keterangan</label>
                                        </td>
                                        <td>
                                            {{ $data->keterangan_pengajuan }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <h4>Status Pengajuan</h4>
                                <table class="table">
                                    <tr>
                                        <td>
                                            <label for="nameInput" class="form-label">Verifikasi Atasan</label>
                                        </td>
                                        <td>
                                            @if (Auth::user()->role == 'Pimpinan' && $data->verifikasi_pimpinan == 'pending')
                                            <form action="{{ route('pimpinan.pengajuan_dana.verifikasi', $data->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <textarea name="keterangan_verifikasi" class="form-control mb-3" placeholder="Keterangan Verifikasi" required></textarea>

                                                <input type="hidden" name="verifikasi_pimpinan" id="verifikasi_pimpinan_hidden" value="">
                                                <button type="submit" class="btn btn-success mb-3" onclick="document.getElementById('verifikasi_pimpinan_hidden').value='disetujui'">
                                                    <i class="ri-check-line align-middle me-1"></i>
                                                    Setujui
                                                </button>
                                                <button type="submit" class="btn btn-danger mb-3" onclick="document.getElementById('verifikasi_pimpinan_hidden').value='ditolak'">
                                                    <i class="ri-close-line align-middle me-1"></i>
                                                    Tolak
                                                </button>
                                            </form>
                                            @else
                                            @if ($data->verifikasi_pimpinan == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                            @elseif ($data->verifikasi_pimpinan == 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                            @else
                                            <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="sumber" class="form-label">Alokasi Bendahara</label>
                                        </td>
                                        <td>
                                            @if ($data->verifikasi_pimpinan == 'disetujui' && Auth::user()->role == 'Bendahara')
                                            <form action="{{ route('keuangan.pengajuan_dana.verifikasi', $data->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <textarea name="keterangan_verifikasi" class="form-control mb-3" placeholder="Keterangan Verifikasi" required></textarea>

                                                <select name="verifikasi_bendahara" class="form-select mb-3 verif-bendahara" required>
                                                    <option value="">Pilih Keputusan</option>
                                                    <option value="disetujui">Disetujui</option>
                                                    <option value="ditolak">Ditolak</option>
                                                </select>

                                                <div class="pilih-account">
                                                    <label for="account" class="form-label">Pilih Account</label>
                                                    <select name="account" class="form-select mb-3" required>
                                                        <option value="">Pilih Account</option>
                                                        @foreach ($account as $account)
                                                        <option value="{{ $account->id }}">{{ $account->kode_akun . ' | ' . $account->nama_akun }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-success mb-3">
                                                    <i class="ri-check-line align-middle me-1"></i>
                                                    Verifikasi
                                                </button>
                                            </form>
                                            @else
                                            @if ($data->verifikasi_bendahara == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                            @elseif ($data->verifikasi_bendahara == 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                            @else
                                            <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Harga Satuan</th>
                                    <th scope="col">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail as $detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $detail->item }}</td>

                                    <td>{{ $detail->jumlah }}</td>

                                    <td>{{ $detail->satuan }}</td>

                                    <td>{{ 'Rp. ' . number_format($detail->harga_satuan, 0, ',', '.') }}</td>

                                    <td>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5>{{ 'Rp. ' . number_format($detail->total_harga, 0, ',', '.') }}</h5>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end">
                                        <h4>Total :</h4>
                                    </td>
                                    <td>
                                        <div class="total font-weight-bold">
                                            <h4>
                                                {{'Rp. ' . number_format($total_harga, 0, ',', '.')}}
                                            </h4>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Hitung total keseluruhan
        function updateGrandTotal() {
            let grandTotal = 0;
            $('.total-harga').each(function() {
                grandTotal += parseFloat($(this).val().replace(/[^0-9,-]+/g, "")) || 0;
            });
            $('.total').html('<strong>' + formatRupiah(grandTotal) + '</strong>'); // Tampilkan total pada elemen .total dengan font tebal
        }

        // Format angka menjadi format Rupiah
        function formatRupiah(angka) {
            const numberString = angka.toString().replace(/[^,\d]/g, '');
            const split = numberString.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                const separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp. ' + rupiah;
        }

        // tampilkan pilihan account saat value .verif-bendahara disetujui
        $(document).ready(function() {
            $('.pilih-account').hide(); // Default sembunyikan .pilih-account

            $('.verif-bendahara').change(function() {
            if ($(this).val() == 'disetujui') {
                $('.pilih-account').show();
            } else {
                $('.pilih-account').hide();
            }
            });
        });

        // alert if .verif-bendahara is empty
        $(document).ready(function() {
            $('.verif-bendahara').change(function() {
                if ($(this).val() == '') {
                    alert('Pilih verifikasi terlebih dahulu');
                }
            });
        });
    </script>

    <x-alert></x-alert>
    <x-confirm-alert></x-confirm-alert>
</x-app-layout>