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
                                    <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                                </div>
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="ttlInput" class="form-label">Tempat, Tanggal Lahir</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                                    <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                </div>
                                @error('tempat_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @error('tanggal_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- email -->
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="emailInput" class="form-label">Email</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>
                                @error('agama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- No Tlp -->
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="noTlpInput" class="form-label">No Telepon</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="no_telepon" value="{{ old('no_telepon') }}">
                                </div>
                                @error('no_telepon')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="alamatInput" class="form-label">Alamat</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <textarea class="form-control" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                                </div>
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
                                @error('cv')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
                                        <option value="CEO" {{ old('jabatan') == 'CEO' ? 'selected' : '' }}>CEO</option>
                                        <option value="Bendahara" {{ old('jabatan') == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                                        <option value="Karyawan" {{ old('jabatan') == 'Karyawan' ? 'selected' : '' }}>Karyawan</option>
                                        <option value="Administrator" {{ old('jabatan') == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                                    </select>
                                </div>
                                @error('jabatan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
                                        <option value="I/a" {{ old('golongan') == 'I/a' ? 'selected' : '' }}>I/a</option>
                                        <option value="I/b" {{ old('golongan') == 'I/b' ? 'selected' : '' }}>I/b</option>
                                        <option value="I/c" {{ old('golongan') == 'I/c' ? 'selected' : '' }}>I/c</option>
                                        <option value="I/d" {{ old('golongan') == 'I/d' ? 'selected' : '' }}>I/d</option>
                                        <option value="II/a" {{ old('golongan') == 'II/a' ? 'selected' : '' }}>II/a</option>
                                        <option value="II/b" {{ old('golongan') == 'II/b' ? 'selected' : '' }}>II/b</option>
                                        <option value="II/c" {{ old('golongan') == 'II/c' ? 'selected' : '' }}>II/c</option>
                                        <option value="II/d" {{ old('golongan') == 'II/d' ? 'selected' : '' }}>II/d</option>
                                        <option value="III/a" {{ old('golongan') == 'III/a' ? 'selected' : '' }}>III/a</option>
                                        <option value="III/b" {{ old('golongan') == 'III/b' ? 'selected' : '' }}>III/b</option>
                                        <option value="III/c" {{ old('golongan') == 'III/c' ? 'selected' : '' }}>III/c</option>
                                        <option value="III/d" {{ old('golongan') == 'III/d' ? 'selected' : '' }}>III/d</option>
                                        <option value="IV/a" {{ old('golongan') == 'IV/a' ? 'selected' : '' }}>IV/a</option>
                                        <option value="IV/b" {{ old('golongan') == 'IV/b' ? 'selected' : '' }}>IV/b</option>
                                        <option value="IV/c" {{ old('golongan') == 'IV/c' ? 'selected' : '' }}>IV/c</option>
                                        <option value="IV/d" {{ old('golongan') == 'IV/d' ? 'selected' : '' }}>IV/d</option>
                                        <option value="IV/e" {{ old('golongan') == 'IV/e' ? 'selected' : '' }}>IV/e</option>
                                    </select>
                                </div>
                                @error('golongan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- buatkan akun user check box-->
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="buatAkunInput" class="form-label">Buat Akun untuk User ini</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group mb-3">
                                    <input type="checkbox" class="form-check-input" name="buat_akun" {{ old('buat_akun') ? 'checked' : '' }}>
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
                                        <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                    </div>
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                            <input class="form-check-input" type="radio" name="level_user" id="levelUserAdmin" value="Admin" {{ old('level_user') == 'Admin' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="levelUserAdmin">Admin</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="level_user" id="levelUserBendahara" value="Bendahara" {{ old('level_user') == 'Bendahara' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="levelUserBendahara">Bendahara</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="level_user" id="levelUserUser" value="User" {{ old('level_user') == 'User' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="levelUserUser">User</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="level_user" id="levelUserPimpinan" value="Pimpinan" {{ old('level_user') == 'Pimpinan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="levelUserPimpinan">Pimpinan</label>
                                        </div>
                                    </div>
                                    @error('level_user')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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