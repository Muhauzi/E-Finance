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
                    <div class="col-lg-8">
                        <table>
                            <tr>
                                <td>
                                    <label for="nameInput" class="form-label">Tanggal</label>
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="sumber" class="form-label">Jenis Pengeluaran</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="jenis_pengeluaran" value="{{ old('jenis_pengeluaran') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="keteranganInput" class="form-label">Keterangan</label>
                                </td>
                                <td>
                                    <textarea class="form-control" readonly name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                                </td>
                            </tr>
                        </table>

                        <hr>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Harga Satuan</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">
                                        <button type="button" class="btn btn-primary" id="addRow">
                                            <i data-feather="plus" style="width: 16px; height: 16px;"></i>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="text" class="form-control" name="item[]" value="{{ $item->item }}">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="jumlah[]" value="{{ $item->jumlah }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="satuan[]" value="{{ $item->satuan }}">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="harga_satuan[]" value="{{ $item->harga_satuan }}">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control total-harga" name="total_harga[]" value="{{ $item->total_harga }}">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" id="deleteRow">
                                            <i data-feather="trash" style="width: 16px; height: 16px;"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end">Total</td>
                                    <td>
                                        <div class="total font-weight-bold"></div>
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
    </script>

    <x-alert></x-alert>
    <x-confirm-alert></x-confirm-alert>
</x-app-layout>