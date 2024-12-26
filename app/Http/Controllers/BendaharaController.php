<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;


use App\Models\PemasukanModel;
use App\Models\PengeluaranModel;
use App\Models\DetailPengeluaran;
use App\Models\PengeluaranImages;
use App\Models\DetailAccountModel;
use App\Models\SaldoModel;
use App\Models\LaporanPengajuanModel;
use App\Models\PengajuanModel;


class BendaharaController extends Controller
{
    public function index()
    {
        $modelSaldo = new SaldoModel();
        $modelPemasukan = new PemasukanModel();
        $modelPengeluaran = new PengeluaranModel();
        $saldo_akhir = $modelSaldo->getSaldoAll()->sum('nominal') + $modelPemasukan->sum('nominal');
        $saldo_awal = $modelSaldo->getSaldoAll()->first();
        $pemasukan = $modelPemasukan->getTotalPemasukanBulanan();
        $pengeluaran = $modelPengeluaran->getTotalPengeluaranBulanan();

        // dd($saldo_awal, $saldo_akhir, $pemasukan, $pengeluaran);

        return view('dashboard', compact('saldo_awal', 'saldo_akhir', 'pemasukan', 'pengeluaran'));
    }

    public function saldo()
    {
        $model = new SaldoModel();
        $modelPemasukan = new PemasukanModel();
        $data = $model->getSaldoAll();
        foreach ($data as $key => $value) {
            $pemasukan = $modelPemasukan->getPemasukanByAccount($value->detail_account_id)->first();
            if ($pemasukan && $value->detail_account_id == $pemasukan->id_detail_account) {
                $value->nominal += $modelPemasukan->where('id_detail_account', $value->detail_account_id)->sum('nominal');
            }
        }
        return view('bendahara.saldo.index', compact('data'));
    }

    public function tambahSaldo()
    {
        $data = DetailAccountModel::all();
        return view('bendahara.saldo.create', compact('data'));
    }

    public function simpanSaldo(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'account_id' => 'required|exists:detail_account,id',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'required',
        ]);

        $data = new SaldoModel();
        $data->tanggal = $request->tanggal;
        $data->detail_account_id = $request->account_id;
        $data->nominal = $request->nominal;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect()->route('keuangan.saldo')->with('success', 'Saldo berhasil ditambahkan');
    }


    // Pemasukan
    public function pemasukan()
    {
        $model = new PemasukanModel();
        $data = $model->getPemasukanAll();
        return view('bendahara.pemasukan.index', compact('data'));
    }

    public function createPemasukan()
    {
        $data = DetailAccountModel::all();
        return view('bendahara.pemasukan.create', compact('data'));
    }

    public function storePemasukan(Request $request)
    {
        $request->validate([
            'id_detail_account' => 'required|exists:detail_account,id',
            'sumber_pemasukan' => 'required',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'required',
            'tanggal' => 'required|date',
        ]);

        $data = new PemasukanModel();
        $data->id_detail_account = $request->id_detail_account;
        $data->sumber_pemasukan = $request->sumber_pemasukan;
        $data->nominal = $request->nominal;
        $data->keterangan = $request->keterangan;
        $data->tanggal = $request->tanggal;
        $data->id_penginput = Auth::user()->id;
        $data->save();

        return redirect()->route('keuangan.pemasukan')->with('success', 'Data berhasil ditambahkan');
    }

    public function editPemasukan($id)
    {
        $pemasukan = PemasukanModel::find($id);
        $data = DetailAccountModel::all();
        return view('bendahara.pemasukan.edit', compact('pemasukan', 'data'));
    }

    public function updatePemasukan(Request $request, $id)
    {
        $data = PemasukanModel::find($id);
        $request->validate([
            'id_detail_account' => 'required|exists:detail_account,id',
            'sumber_pemasukan' => 'required',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'required',
            'tanggal' => 'required|date',
        ]);

        $data->id_detail_account = $request->id_detail_account;
        $data->sumber_pemasukan = $request->sumber_pemasukan;
        $data->nominal = $request->nominal;
        $data->keterangan = $request->keterangan;
        $data->tanggal = $request->tanggal;
        $data->id_penginput = Auth::user()->id;

        $data->save();

        return redirect()->route('keuangan.pemasukan')->with('success', 'Data berhasil diubah');
    }


    public function pengeluaran()
    {
        $model = new PengeluaranModel();
        $data = $model->getDataPengeluaran();
        foreach ($data as $key => $value) {
            $total = 0;
            foreach ($value->pengeluaranDetail as $key => $detail) {
                $total += $detail->total_harga;
            }
            $value->total = $total;
        }

        // get images path
        foreach ($data as $key => $value) {
            $images = [];
            foreach ($value->pengeluaranImages as $key => $image) {
                $images['file'] = $image->image_path;
            }
            $value->images = $images;
        }

        // dd($data);

        return view('bendahara.pengeluaran.index', compact('data'));
    }

    public function createPengeluaran()
    {
        return view('bendahara.pengeluaran.create');
    }

    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_pengeluaran' => 'required',
            'keterangan' => 'required',
        ]);

        $data = new PengeluaranModel();
        $data->tanggal = $request->tanggal;
        $data->jenis_pengeluaran = $request->jenis_pengeluaran;
        $data->keterangan = $request->keterangan;
        $data->id_penginput = Auth::user()->id;
        $data->save();

        $id = $data->id;

        return redirect()->route('keuangan.pengeluaran.create_detail', $id);
    }

    public function createDetailPengeluaran($id)
    {
        $data = PengeluaranModel::find($id);
        return view('bendahara.pengeluaran.create_detail', compact('data'));
    }

    public function storeDetailPengeluaran(Request $request)
    {
        $request->validate([
            'pengeluaran_id' => 'required|exists:pengeluaran,id',
            'item.*' => 'required',
            'jumlah.*' => 'required|numeric|min:0',
            'satuan.*' => 'required',
            'harga_satuan.*' => 'required|numeric|min:0',
            'total_harga.*' => 'required|numeric|min:0',
        ]);

        $dataInput = $request->all();

        $model = new DetailPengeluaran();

        $item = $dataInput['item'];
        $jumlah = $dataInput['jumlah'];
        $satuan = $dataInput['satuan'];
        $harga_satuan = $dataInput['harga_satuan'];
        $total_harga = $dataInput['total_harga'];

        for ($i = 0; $i < count($item); $i++) {
            $model->create([
                'pengeluaran_id' => $dataInput['pengeluaran_id'],
                'item' => $item[$i],
                'jumlah' => $jumlah[$i],
                'satuan' => $satuan[$i],
                'harga_satuan' => $harga_satuan[$i],
                'total_harga' => $total_harga[$i],
            ]);
        }

        $modelImages = new PengeluaranImages();
        $id_detail_pengeluaran = $request->pengeluaran_id;

        if ($request->hasFile('struk')) {
            foreach ($request->file('struk') as $key => $value) {
                $name = time() . $value->getClientOriginalName();
                $value->move(public_path('pengeluaran/struk'), $name);
                $dataInput['struk'][$key] = $name;
                $modelImages->create([
                    'detail_pengeluaran_id' => $id_detail_pengeluaran,
                    'image_path' => $name,
                ]);
            }
        }

        return redirect()->route('keuangan.pengeluaran')->with('success', 'Data berhasil ditambahkan');
    }

    public function uploadStruk(Request $request)
    {
        $request->validate([
            'pengeluaran_id' => 'required|exists:pengeluaran,id',
            'struk_nota' => 'required|file', // Pastikan ini array
        ]);

        $model = new PengeluaranImages();

        $file = $request->file('struk_nota');

        // dd($file, $id_pengeluaran);

        if ($request->hasFile('struk_nota')) {
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path('pengeluaran/struk'), $name);
            $model->create([
                'pengeluaran_id' => $request->pengeluaran_id,
                'image_path' => $name,
            ]);
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return redirect()->route('keuangan.pengeluaran')->with('success', 'Struk berhasil diupload');

    }
}
