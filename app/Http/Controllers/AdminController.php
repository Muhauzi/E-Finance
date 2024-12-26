<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

use App\Models\UserModel;
use App\Models\DataPegawaiModel;
use App\Models\AccountModel;
use App\Models\DetailAccountModel;

class AdminController extends Controller
{
    use ValidatesRequests;
    public function index()
    {
        return view('dashboard');
    }

    public function pegawai()
    {
        $data = DataPegawaiModel::all();
        return view('kepegawaian.index', compact('data'));
    }

    public function tambahPegawai()
    {
        return view('kepegawaian.create');
    }

    public function simpanPegawai(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'cv' => 'required',
            'jabatan' => 'required',
            'golongan' => 'required',
        ]);

        $data = new DataPegawaiModel();
        $data->id = rand(100000, 999999);
        $data->nama = $request->nama;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->agama = $request->agama;
        $data->alamat = $request->alamat;
        $data->no_telepon = $request->no_telepon;
        $data->jabatan = $request->jabatan;
        $data->golongan = $request->golongan;

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/cv/', $filename);
            $data->cv = $filename;
        }

        $data->save();

        if ($request->has('buat_akun') && $request->buat_akun == true) {
            $user = new UserModel();
            $user->username = $request->username;
            $user->role = $request->level_user;
            $user->email = $request->email;
            $user->password = bcrypt($request->username);
            $user->id_data_pegawai = $data->id;
            $user->save();
        }

        return redirect()->route('admin.pegawai')->with('success', 'Data berhasil disimpan');
    }

    public function editPegawai($id)
    {
        $pegawai = DataPegawaiModel::find($id);
        $user = UserModel::where('id_data_pegawai', $id)->first();
        return view('kepegawaian.edit', compact('pegawai', 'user'));
    }

    public function updatePegawai(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'jabatan' => 'required',
            'golongan' => 'required',
        ]);

        $data = DataPegawaiModel::find($id);
        $data->nama = $request->nama;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->agama = $request->agama;
        $data->alamat = $request->alamat;
        $data->no_telepon = $request->no_telepon;
        $data->jabatan = $request->jabatan;
        $data->golongan = $request->golongan;

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/cv/', $filename);
            $data->cv = $filename;
        }

        $data->save();

        if ($request->has('buat_akun') && $request->buat_akun == true) {
            $user = UserModel::where('id_data_pegawai', $id)->first();
            $user->username = $request->username;
            $user->role = $request->level_user;
            $user->email = $request->email;
            if ($request->has('password') && $request->password != null) {
                $user->password = bcrypt($request->password);
            } else {
                $user->password = $user->password;
            }
            $user->save();
        }

        return redirect()->route('admin.pegawai')->with('success', 'Data berhasil diupdate');
    }

    public function hapusPegawai($id)
    {
        $data = DataPegawaiModel::find($id);
        if (Auth::user()->id_data_pegawai == $id) {
            return redirect()->route('admin.pegawai')->with('error', 'Tidak bisa menghapus data sendiri');
        }
        $user = UserModel::where('id_data_pegawai', $id)->first();
        if ($user) {
            $user->delete();
        }
        $data->delete();
        return redirect()->route('admin.pegawai')->with('success', 'Data berhasil dihapus');
    }

    // account akuntansi

    public function account()
    {
        $data = AccountModel::all();
        return view('account.index', compact('data'));
    }

    public function tambahAccount()
    {
        return view('account.create');
    }

    public function simpanAccount(Request $request)
    {
        $this->validate($request, [
            'jenis_akun' => 'required',
            'nama_group_akun' => 'required',
            'keterangan' => 'required',
        ]);

        $data = new AccountModel();
        $data['jenis_akun'] = $request->jenis_akun;

        // Tentukan prefix berdasarkan jenis akun
        switch ($request->jenis_akun) {
            case 'Aset':
                $prefix = '1-';
                break;
            case 'Liabilitas':
                $prefix = '2-';
                break;
            case 'Modal':
                $prefix = '3-';
                break;
            case 'Pendapatan':
                $prefix = '4-';
                break;
            case 'Biaya':
                $prefix = '5-';
                break;
            default:
                $prefix = '0-';
                break;
        }

        $init = '01';
        $kode_akun = $prefix . $init;

        $existingAccount = AccountModel::all();
        foreach ($existingAccount as $account) {
            if ($account->kode_akun == $kode_akun) {
                $init = (int) explode('-', $kode_akun)[1] + 1;
                $kode_akun = $prefix . str_pad($init, 2, '0', STR_PAD_LEFT);
                $existingAccount = AccountModel::where('kode_akun', $kode_akun)->first();
                break;
            }
        }
        $data->kode_akun = $kode_akun;
        $data->nama_group_akun = $request->nama_group_akun;
        $data->keterangan = $request->keterangan;

        // Simpan data
        $data->save();

        return redirect()->route('admin.account')->with('success', 'Data berhasil disimpan');
    }


    public function editAccount($id)
    {
        $account = AccountModel::find($id);
        return view('account.edit', compact('account'));
    }

    public function updateAccount(Request $request, $id)
    {
        $this->validate($request, [
            'nama_group_akun' => 'required',
            'keterangan' => 'required',
        ]);

        $data = AccountModel::find($id);
        $data->nama_group_akun = $request->nama_group_akun;
        $data->keterangan = $request->keterangan;

        $data->save();

        return redirect()->route('admin.account')->with('success', 'Data berhasil diupdate');
    }

    public function hapusAccount($id)
    {
        $data = AccountModel::find($id);
        $data->delete();
        return redirect()->route('admin.account')->with('success', 'Data berhasil dihapus');
    }

    // detail account

    public function detailAccount()
    {
        $data = DetailAccountModel::all();
        $account = AccountModel::all();
        return view('detail_account.index', compact('data', 'account'));
    }

    public function createDetailAccount()
    {
        $account = AccountModel::all();
        return view('detail_account.create', compact('account'));
    }

    public function storeDetailAccount(Request $request)
    {
        $this->validate($request, [
            'group_akun' => 'required',
            'nama_account' => 'required',
            'keterangan' => 'required',
            'jenis_akun' => 'required',
        ]);

        // Ambil akun utama berdasarkan group_akun
        $account = AccountModel::find($request->group_akun);

        // Inisialisasi init
        $init = 1;
        $kode_akun = $account->kode_akun . '/' . str_pad($init, 3, '0', STR_PAD_LEFT);

        // Periksa apakah kode_akun sudah ada, dan tambahkan init jika perlu
        while (DetailAccountModel::where('kode_akun', $kode_akun)->exists()) {
            $init++;
            $kode_akun = $account->kode_akun . '/' . str_pad($init, 3, '0', STR_PAD_LEFT);
        }

        // Data input untuk detail akun
        $input = [
            'jenis_akun' => $request->jenis_akun,
            'account_id' => $request->group_akun,
            'nama_akun' => $request->nama_account,
            'keterangan' => $request->keterangan,
            'kode_akun' => $kode_akun,
        ];

        // Simpan detail akun ke database
        DetailAccountModel::create($input);

        return redirect()->route('admin.detail_account')->with('success', 'Data berhasil disimpan');
    }


    public function editDetailAccount($id)
    {
        $account = AccountModel::all();
        $detailAccount = DetailAccountModel::find($id);
        return view('detail_account.edit', compact('account', 'detailAccount'));
    }

    public function updateDetailAccount(Request $request, $id)
    {
        $this->validate($request, [
            'group_akun' => 'required',
            'nama_account' => 'required',
            'keterangan' => 'required',
            'jenis_akun' => 'required',
        ]);

        $data = DetailAccountModel::find($id);
        $data->jenis_akun = $request->jenis_akun;
        $data->account_id = $request->group_akun;
        $data->nama_akun = $request->nama_account;
        $data->keterangan = $request->keterangan;

        $data->save();

        return redirect()->route('admin.detail_account')->with('success', 'Data berhasil diupdate');
    }

    public function deleteDetailAccount($id)
    {
        $data = DetailAccountModel::find($id);
        $data->delete();
        return redirect()->route('admin.detail_account')->with('success', 'Data berhasil dihapus');
    }
}
