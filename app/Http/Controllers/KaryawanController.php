<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuanModel;
use Illuminate\Http\Request;
use App\Models\PengajuanDanaModel;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function pengajuan()
    {
        $model = new PengajuanDanaModel();

        $data = $model->getDataPengajuan();

        return view('pengajuan.index', compact('data'));
    }

    public function createPengajuan()
    {
        return view('pengajuan.create');
    }

    public function storePengajuan(Request $request)
    {
        $model = new PengajuanDanaModel();

        $model->tujuan_pengajuan = $request->tujuan_pengajuan;
        $model->keterangan_pengajuan = $request->keterangan_pengajuan;
        $model->tanggal_pengajuan = $request->tanggal;
        $model->id_user = Auth::user()->id;

        $model->save();

        return redirect()->route('karyawan.pengajuan.create_detail', $model->id);
    }

    public function createDetailPengajuan($id)
    {
        $id = $id;
        return view('pengajuan.create_detail', compact('id'));
    }

    public function storeDetailPengajuan(Request $request)
    {
        $request->validate([
            'pengajuan_dana_id' => 'required',
            'item.*' => 'required',
            'jumlah.*' => 'required',
            'satuan.*' => 'required',
            'harga_satuan.*' => 'required',
            'total_harga.*' => 'required',
        ]);

        $model = new DetailPengajuanModel();

        $id_pengajuan = $request->pengajuan_dana_id;

        $grand_total = array_sum($request->total_harga);

        foreach ($request->item as $key => $value) {
            $data_input = [
            'pengajuan_dana_id' => $id_pengajuan,
            'item' => $request->item[$key],
            'jumlah' => $request->jumlah[$key],
            'satuan' => $request->satuan[$key],
            'harga_satuan' => $request->harga_satuan[$key],
            'total_harga' => $request->total_harga[$key],
            ];

            $model->create($data_input);
        }

        $pengajuan = PengajuanDanaModel::find($id_pengajuan);
        $pengajuan->nominal_pengajuan = $grand_total;
        $pengajuan->save();
        return redirect()->route('karyawan.pengajuan')->with('success', 'Pengajuan Berhasil Dibuat');
    }


}
