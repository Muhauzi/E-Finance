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
                    <div class="card-title mb-0">
                        <h4>Detail Pengeluaran</h4>
                        <button type="button" class="btn btn-primary" onclick="window.history.back();" style="float: right;">
                            <i class="ri-arrow-go-back-line align-middle me-1"></i>
                            Kembali
                        </button>
                    </div>
                </div><!-- end card header -->

                <div class="card-body d-flex justify-content-center mt-3" style="min-height: 100vh;">
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <table class="table">
                                <tr>
                                    <td>
                                        <label for="nameInput" class="form-label">Tanggal</label>
                                    </td>
                                    <td>
                                        {{ $data->tanggal }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="sumber" class="form-label">Jenis Pengeluaran</label>
                                    </td>
                                    <td>
                                        {{$data->jenis_pengeluaran}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="keteranganInput" class="form-label">Keterangan</label>
                                    </td>
                                    <td>
                                        {{ $data->keterangan }}
                                    </td>
                                </tr>
                            </table>
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

                        <div class="struk">
                            <h5>Struk</h5>
                            @if ($struk == null)
                            <form class="col-lg-4" action="{{ route('keuangan.pengeluaran.upload_struk', $data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="pengeluaran_id" value="{{ $data->id }}">
                                <input type="file" name="struk_nota" id="struk" class="form-control">
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="ri-upload-cloud-line align-middle me-1"></i>
                                    Upload Struk</button>
                            </form>
                            @else
                            <a class="btn btn-success" href="{{ asset('pengeluaran/struk/' . $image_path) }}" target="_blank">
                                <i class="ri-file-download-line align-middle me-1"></i>
                                Lihat Struk</a>
                            @endif
                        </div>
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
    </script>

    <x-alert></x-alert>
    <x-confirm-alert></x-confirm-alert>
</x-app-layout>