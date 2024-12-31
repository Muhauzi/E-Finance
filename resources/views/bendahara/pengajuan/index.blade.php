<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">List Pengajuan Dana</h4>

        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Keuangan</a></li>
                <li class="breadcrumb-item active">Pengajuan Dana</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Pengajuan Dana</h4>
                </div>
                <div class="card-body row">
                    <!-- <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for names.." class="search-box ms-2"> -->
                    <div class="col-sm-auto">
                        <div>
                            <div class="search-box ms-2">
                                <input type="text" class="form-control search" id="searchInput" onkeyup="searchTable()" placeholder="Search...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                    <table class="table table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Pemohon</th>
                                <th>Tujuan Pengajuan</th>
                                <th>Nominal Pengajuan</th>
                                <th>Verifikasi Atasan</th>
                                <th>Alokasi Bendahara</th>
                                <th>Laporan PJ</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->tanggal_pengajuan }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->tujuan_pengajuan }}</td>
                                <td>Rp. {{ number_format($item->nominal_pengajuan, 0, ',', '.') }},-</td>
                                @if ($item->verifikasi_pimpinan == 'pending')
                                <td><span class="badge bg-warning">Pending</span></td>
                                @elseif ($item->verifikasi_pimpinan == 'disetujui')
                                <td><span class="badge bg-success">Disetujui</span></td>
                                @else
                                <td><span class="badge bg-danger">Ditolak</span></td>
                                @endif
                                <td>
                                    @if ($item->verifikasi_bendahara == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                    @elseif ($item->verifikasi_bendahara == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                    @else
                                    <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->laporan)
                                    <a href="{{ asset('uploads/laporan_pengajuan/' . $item->laporan) }}" class="btn btn-sm btn-success" download>
                                        <i class="ri-download-2-line align-bottom me-1"></i> Unduh</a>
                                    @else
                                    <span class="badge bg-danger">Belum Ada Laporan</span>
                                    @endif
                                </td>
                                <td>
                                    @if (Auth::user()->role == 'Pimpinan')
                                    <a href="{{ route('pimpinan.pengajuan_dana.show', $item->id) }}" class="btn btn-primary">Detail</a>
                                    @elseif (Auth::user()->role == 'Bendahara')
                                    <a href="{{ route('keuangan.pengajuan_dana.show', $item->id) }}" class="btn btn-primary">Detail</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end mt-3">
                        <div id="pagination" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px;"></div>
                    </div>

                    <script>
                        function searchTable() {
                            var input, filter, table, tr, td, i, j, txtValue;
                            input = document.getElementById("searchInput");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("dataTable");
                            tr = table.getElementsByTagName("tr");
                            for (i = 1; i < tr.length; i++) {
                                tr[i].style.display = "none";
                                td = tr[i].getElementsByTagName("td");
                                for (j = 0; j < td.length; j++) {
                                    if (td[j]) {
                                        txtValue = td[j].textContent || td[j].innerText;
                                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                            tr[i].style.display = "";
                                            break;
                                        }
                                    }
                                }
                            }
                        }

                        function paginateTable() {
                            var table, tr, i, pageSize, pageCount, currentPage, pagination;
                            table = document.getElementById("dataTable");
                            tr = table.getElementsByTagName("tr");
                            pageSize = 10;
                            pageCount = Math.ceil((tr.length - 1) / pageSize);
                            currentPage = 1;
                            pagination = document.getElementById("pagination");

                            function showPage(page) {
                                currentPage = page;
                                for (i = 1; i < tr.length; i++) {
                                    tr[i].style.display = "none";
                                }
                                for (i = (page - 1) * pageSize + 1; i <= page * pageSize && i < tr.length; i++) {
                                    tr[i].style.display = "";
                                }
                                updatePagination();
                            }

                            function updatePagination() {
                                var i, pageLink;
                                pagination.innerHTML = "";
                                for (i = 1; i <= pageCount; i++) {
                                    pageLink = document.createElement("a");
                                    pageLink.href = "#";
                                    pageLink.innerHTML = i;
                                    pageLink.className = (i === currentPage) ? "active" : "";
                                    pageLink.onclick = (function(page) {
                                        return function() {
                                            showPage(page);
                                            return false;
                                        };
                                    })(i);
                                    pagination.appendChild(pageLink);
                                }
                            }

                            showPage(1);
                        }

                        document.addEventListener("DOMContentLoaded", function() {
                            paginateTable();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>