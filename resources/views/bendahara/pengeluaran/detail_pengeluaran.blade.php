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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-alert></x-alert>
    <x-confirm-alert></x-confirm-alert>
</x-app-layout>