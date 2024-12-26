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

                <div class="card-body d-flex justify-content-left mt-3" style="min-height: 100vh;">
                    <form action="{{ route('keuangan.pemasukan.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-lg-6">
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
                        </div>

                        <hr>

                        <div class="col-lg-12">
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
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" name="item[]" value="{{ old('item') }}"></td>
                                        <td><input type="number" class="form-control jumlah" name="jumlah[]" value="{{ old('jumlah') }}"></td>
                                        <td><input type="text" class="form-control" name="satuan[]" value="{{ old('satuan') }}"></td>
                                        <td><input type="number" class="form-control harga-satuan" name="harga_satuan[]" value="{{ old('harga_satuan') }}"></td>
                                        <td><input type="text" class="form-control total-harga" readonly></td>
                                        <td>
                                            <button type="button" class="btn btn-danger removeRow">
                                                <i data-feather="trash"></i>
                                            </button>
                                        </td>
                                    </tr>
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

                            <!-- upload struk nota -->
                            <div class="col-lg-6">
                                <h4>Upload Struk/Nota</h4>
                                <input type="file"
                                    class="filepond filepond-input-multiple"
                                    multiple
                                    name="filepond"
                                    data-allow-reorder="true"
                                    data-max-file-size="3MB"
                                    data-max-files="3">
                            </div>


                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i data-feather="check" style="width: 16px; height: 16px;"></i>
                                    Simpan</button>
                                <a href="{{ route('pemasukan') }}" class="btn btn-secondary">
                                    <i data-feather="x" style="width: 16px; height: 16px;"></i>
                                    Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let rowIndex = 1;

            // Tambah baris
            $('#addRow').on('click', function() {
                rowIndex++;
                const tr = `
        <tr>
            <td>${rowIndex}</td>
            <td><input type="text" class="form-control" name="item[]"></td>
            <td><input type="number" class="form-control jumlah" name="jumlah[]" value="0"></td>
            <td><input type="text" class="form-control" name="satuan[]"></td>
            <td><input type="number" class="form-control harga-satuan" name="harga_satuan[]" value="0"></td>
            <td><input type="text" class="form-control total-harga" readonly></td>
            <td>
                <button type="button" class="btn btn-danger removeRow">
                    <i data-feather="trash"></i>
                </button>
            </td>
        </tr>`;
                $('tbody').append(tr);
                feather.replace(); // Refresh icons
            });

            // Hapus baris
            $(document).on('click', '.removeRow', function() {
                $(this).closest('tr').remove();
                updateRowNumbers();
                updateGrandTotal();
            });

            // Perbarui nomor baris
            function updateRowNumbers() {
                $('tbody tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
            }

            // Hitung total harga per baris
            $(document).on('input', '.jumlah, .harga-satuan', function() {
                const row = $(this).closest('tr');
                const jumlah = parseFloat(row.find('.jumlah').val()) || 0;
                const hargaSatuan = parseFloat(row.find('.harga-satuan').val()) || 0;
                const totalHarga = jumlah * hargaSatuan;
                row.find('.total-harga').val(formatRupiah(totalHarga)); // Gunakan .val() untuk input field

                updateGrandTotal();
            });

            // Hitung total keseluruhan
            function updateGrandTotal() {
                let grandTotal = 0;
                $('.total-harga').each(function() {
                    grandTotal += parseFloat($(this).val().replace(/[^0-9,-]+/g,"")) || 0;
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
        });
    </script>

    <x-alert></x-alert>
    <x-confirm-alert></x-confirm-alert>

    <script src="assets/libs/filepond/filepond.min.js"></script>
    <script src="assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
    <script src="assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>


    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileEncode
        );

        FilePond.create(
            document.querySelector('input[type="file"]'), {
                allowMultiple: true,
                maxFiles: 3,
                maxFileSize: '3MB',
            }
        );
    </script>
</x-app-layout>