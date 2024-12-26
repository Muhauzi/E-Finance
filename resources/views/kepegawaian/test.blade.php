<x-app-layout>
    <x-page-title>
        <h4 class="mb-sm-0">Kepegawaian</h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                <li class="breadcrumb-item">Kepegawaian</li>
                <li class="breadcrumb-item active">Tambah Pegawai</li>
            </ol>
        </div>
    </x-page-title>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Form Pegawai Baru</h4>
                </div><!-- end card header -->

                <div class="card-body d-flex justify-content-center mt-3" style="min-height: 100vh;">
                    <form method="post" action="{{ route('admin.pegawai.store') }}" enctype="multipart/form-data" class="col-lg-8">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="nameInput" class="form-label">Nama</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="nama">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="ttlInput" class="form-label">Tempat, Tanggal Lahir</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir">
                                    <input type="date" class="form-control" name="tanggal_lahir">
                                </div>
                            </div>
                        </div>

                        <!-- email -->
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="emailInput" class="form-label">Email</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="jenisKelaminInput" class="form-label">Jenis Kelamin</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <select class="form-select" name="jenis_kelamin">
                                        <option selected>Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Agama -->
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="agamaInput" class="form-label">Agama</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <select class="form-select" name="agama">
                                        <option selected>Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- No Tlp -->

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="noTlpInput" class="form-label">No Telepon</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="no_tlp">
                                </div>
                            </div>
                        </div>


                        <!-- Alamat -->

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="alamatInput" class="form-label">Alamat</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <textarea class="form-control" name="alamat" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- file cv -->

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="cvInput" class="form-label">CV</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="cv">
                                </div>
                            </div>
                        </div>

                        <!-- jabatan -->
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="jabatanInput" class="form-label">Jabatan</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <select class="form-select" name="jabatan">
                                        <option selected>Pilih Jabatan</option>
                                        <option value="CEO">CEO</option>
                                        <option value="Bendahara">Bendahara</option>
                                        <option value="Karyawan">Karyawan</option>
                                        <option value="Administrator">Administrator</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Golongan -->
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="golonganInput" class="form-label">Golongan</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <select class="form-select" name="golongan">
                                        <option selected>Pilih Golongan</option>
                                        <option value="I/a">I/a</option>
                                        <option value="I/b">I/b</option>
                                        <option value="I/c">I/c</option>
                                        <option value="I/d">I/d</option>
                                        <option value="II/a">II/a</option>
                                        <option value="II/b">II/b</option>
                                        <option value="II/c">II/c</option>
                                        <option value="II/d">II/d</option>
                                        <option value="III/a">III/a</option>
                                        <option value="III/b">III/b</option>
                                        <option value="III/c">III/c</option>
                                        <option value="III/d">III/d</option>
                                        <option value="IV/a">IV/a</option>
                                        <option value="IV/b">IV/b</option>
                                        <option value="IV/c">IV/c</option>
                                        <option value="IV/d">IV/d</option>
                                        <option value="IV/e">IV/e</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- buatkan akun user check box-->
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="buatAkunInput" class="form-label">Buat Akun untuk User ini</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <input type="checkbox" class="form-check-input" name="buat_akun">
                                </div>
                            </div>
                        </div>

                        <div class="add-user-section">
                            <!-- username -->
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <label for="usernameInput" class="form-label">Username</label>
                                </div>
                                <div class="col-lg-9">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="username">
                                    </div>
                                </div>
                            </div>

                            <!-- password -->
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <label for="passwordInput" class="form-label">Password</label>
                                </div>
                                <div class="col-lg-9">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="password" placeholder="Password digenerate otomatis menggunakan username" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- level user -->
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <label for="levelUserInput" class="form-label">Level User</label>
                                </div>
                                <div class="col-lg-9">
                                    <div class="input-group mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="level_user" id="levelUserAdmin" value="Admin">
                                            <label class="form-check-label" for="levelUserAdmin">Admin</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="level_user" id="levelUserBendahara" value="Bendahara">
                                            <label class="form-check-label" for="levelUserBendahara">Bendahara</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="level_user" id="levelUserUser" value="User">
                                            <label class="form-check-label" for="levelUserUser">User</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="level_user" id="levelUserPimpinan" value="Pimpinan">
                                            <label class="form-check-label" for="levelUserPimpinan">Pimpinan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.pegawai') }}" class="btn btn-secondary">
                                <i data-feather="x" style="width: 16px; height: 16px;"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buatAkun = document.querySelector('input[name="buat_akun"]');
            const addUserSection = document.querySelector('.add-user-section');

            // Initially hide the add-user-section if buat_akun is not checked
            if (!buatAkun.checked) {
                addUserSection.style.display = 'none';
            }

            buatAkun.addEventListener('change', function() {
                if (this.checked) {
                    addUserSection.style.display = 'block';
                } else {
                    addUserSection.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>