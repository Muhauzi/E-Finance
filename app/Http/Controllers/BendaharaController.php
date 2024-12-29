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
use App\Models\DetailPengajuanModel;
use App\Models\LaporanKeuangan;
use App\Models\SaldoModel;
use App\Models\LaporanPengajuanModel;
use App\Models\PengajuanModel;
use App\Models\PengajuanDanaModel;


class BendaharaController extends Controller
{
    public function index()
    {
        $modelSaldo = new SaldoModel();
        $modelPemasukan = new PemasukanModel();
        $modelPengeluaran = new PengeluaranModel();
        $modelDetailPengeluaran = new DetailPengeluaran();
        $saldo_awal = $modelSaldo->getSaldoAll()->first();
        $pemasukan = $modelPemasukan->getTotalPemasukanBulanan();
        $pengeluaran = $modelPengeluaran->getTotalPengeluaranBulanan();
        $pengeluaranBulanan = $modelDetailPengeluaran->totalPenegeluranBulanan(date('m'), date('Y'));
        $pemasukanBulanan = $modelPemasukan->getPemasukanBulanan(date('m'), date('Y'));

        $saldo_akhir = $modelSaldo->getSaldoAll()->sum('nominal') + $pemasukanBulanan - $pengeluaranBulanan;

        return view('dashboard', compact('saldo_awal', 'saldo_akhir', 'pemasukan', 'pengeluaran'));
    }

    public function saldo()
    {
        $model = new SaldoModel();
        $modelPemasukan = new PemasukanModel();
        $data = $model->getSaldoAll();
        $modelPengeluaran = new PengeluaranModel();
        foreach ($data as $key => $value) {
            $pemasukan = $modelPemasukan->getPemasukanByAccount($value->detail_account_id)->first();
            $pengeluaran = $modelPengeluaran->getPengeluaranByAccount($value->detail_account_id)->first();
            // dd($pengeluaran);
            if ($pemasukan && $value->detail_account_id == $pemasukan->id_detail_account || $pengeluaran && $value->detail_account_id == $pengeluaran->id_detail_account) {
                $pemasukan = $modelPemasukan->getPemasukanByAccount($value->detail_account_id)->sum('nominal');
                $pengeluaran = $modelPengeluaran->getPengeluaranByAccount($value->detail_account_id)->sum('total_harga');
                $value->nominal = $value->nominal + $pemasukan - $pengeluaran;
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

        $modelLaporan = new LaporanKeuangan();
        $modelLaporan->tanggal = $request->tanggal;
        $modelLaporan->keterangan = $request->keterangan;
        $modelLaporan->pengeluaran = 0; // Pengeluaran
        $modelLaporan->pemasukan = $request->nominal; // Pemasukan
        $saldo_akhir = $modelLaporan->getSaldoAkhir();
        $modelLaporan->saldo_akhir = $saldo_akhir->saldo_akhir + $request->nominal; // Saldo
        $modelLaporan->save();

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

        $modelLaporan = new LaporanKeuangan();
        $modelLaporan->tanggal = $request->tanggal;
        $modelLaporan->keterangan = $request->sumber_pemasukan;
        $modelLaporan->pengeluaran = 0; // Pengeluaran
        $modelLaporan->pemasukan = $request->nominal; // Pemasukan
        $saldo_akhir = $modelLaporan->getSaldoAkhir();
        $modelLaporan->saldo_akhir = $saldo_akhir->saldo_akhir + $request->nominal; // Saldo
        $modelLaporan->save();

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

        $modelLaporan = new LaporanKeuangan();
        $modelLaporan->tanggal = $request->tanggal;
        $modelLaporan->keterangan = $request->sumber_pemasukan;
        $modelLaporan->pengeluaran = 0; // Pengeluaran
        $modelLaporan->pemasukan = $request->nominal; // Pemasukan
        $saldo_akhir = $modelLaporan->getSaldoAkhir();
        $modelLaporan->saldo_akhir = $saldo_akhir->saldo_akhir + $request->nominal; // Saldo
        $modelLaporan->save();

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
        $modelDetail = new DetailAccountModel();
        $detailAccount = $modelDetail->all();
        return view('bendahara.pengeluaran.create', compact('detailAccount'));
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
        $data->id_detail_account = $request->id_detail_account;
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

        $grand_total = array_sum($dataInput['total_harga']);
        $tanggal = PengeluaranModel::find($dataInput['pengeluaran_id'])->tanggal;
        $keterangan = PengeluaranModel::find($dataInput['pengeluaran_id'])->jenis_pengeluaran;

        $modelLaporan = new LaporanKeuangan();
        $modelLaporan->tanggal = $tanggal;
        $modelLaporan->keterangan = $keterangan;
        $modelLaporan->pengeluaran = $grand_total; // Pengeluaran
        $modelLaporan->pemasukan = 0; // Pemasukan
        $saldo_akhir = $modelLaporan->getSaldoAkhir();
        $modelLaporan->saldo_akhir = $saldo_akhir->saldo_akhir - $grand_total; // Saldo
        $modelLaporan->save();

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

    public function detailPengeluaran($id)
    {
        $model = new PengeluaranModel();
        $modelDetail = new DetailPengeluaran();
        $modelImages = new PengeluaranImages();
        $data = $model->where('id', $id)->first();
        $detail = $modelDetail->where('pengeluaran_id', $id)->get();
        $total_harga = $modelDetail->where('pengeluaran_id', $id)->sum('total_harga');
        $struk = $modelImages->where('pengeluaran_id', $id)->pluck('image_path');
        $image_path = $struk->first();
        // dd($image_path);

        // check if struk is empty
        if ($struk->isEmpty()) {
            $struk = null;
        }
        // dd($data);
        return view('bendahara.pengeluaran.detail', compact('data', 'detail', 'total_harga', 'struk', 'image_path'));
    }

    public function laporanKeuangan()
    {
        $model = new LaporanKeuangan();
        $data = $model->getLaporanKeuangan();
        // dd($data);
        return view('bendahara.laporan.index', compact('data'));
    }

    public function cetakLaporan()
    {
        $model = new LaporanKeuangan();
        $data = $model->getLaporanKeuangan();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'Tanggal');
        $sheet->setCellValue('B1', 'Keterangan');
        $sheet->setCellValue('C1', 'Pemasukan');
        $sheet->setCellValue('D1', 'Pengeluaran');
        $sheet->setCellValue('E1', 'Saldo Akhir');

        // Apply styling to header
        $headerStyleArray = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF0000FF'],
            ],
        ];
        $sheet->getStyle('A1:E1')->applyFromArray($headerStyleArray);

        // Populate data
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->tanggal);
            $sheet->setCellValue('B' . $row, $item->keterangan);
            $sheet->setCellValue('C' . $row, $item->pemasukan);
            $sheet->setCellValue('D' . $row, $item->pengeluaran);
            $sheet->setCellValue('E' . $row, $item->saldo_akhir);
            $row++;
        }

        // Apply styling to data rows
        $dataStyleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $sheet->getStyle('A2:E' . ($row - 1))->applyFromArray($dataStyleArray);

        // Auto size columns
        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Write to file
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $fileName = 'Laporan_Keuangan_' . date('Ymd_His') . '.xlsx';
        $filePath = public_path('exports/' . $fileName);
        if (!file_exists(public_path('exports'))) {
            mkdir(public_path('exports'), 0777, true);
        }

        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function pengajuanDana()
    {
        $model = new PengajuanDanaModel();
        $data = $model->getDataPengajuan();
        return view('bendahara.pengajuan.index', compact('data'));
    }

    public function showPengajuanDana($id)
    {
        $model = new PengajuanDanaModel();
        $data = $model->getDataPengajuanById($id);
        $modelAccount = new DetailAccountModel();
        $account = $modelAccount->getSaldo();
        // dd( $data);
        $detail = $model->getDetailPengajuanById($id);
        $total_harga = $detail->sum('total_harga');
        return view('bendahara.pengajuan.show', compact('data', 'detail', 'total_harga', 'account'));
    }

    public function verifikasiPengajuanDana(Request $request, $id)
    {
        $model = new PengajuanDanaModel();
        $modelDetailPengajuan = new DetailPengajuanModel();
        $modelDetailPengeluaran = new DetailPengeluaran();
        $request->verifikasi_pimpinan;
        // dd($request->all());
        $data = $model->find($id);
        if ($data->verifikasi_pimpinan == 'disetujui') {
            $data->verifikasi_bendahara = $request->verifikasi_bendahara;
            $data->keterangan_verifikasi_bendahara = $request->keterangan_verifikasi;

            $pengeluaran = new PengeluaranModel();
            $pengeluaran->tanggal = date('Y-m-d');
            $pengeluaran->id_detail_account = $request->account;
            $pengeluaran->jenis_pengeluaran = $data->tujuan_pengajuan;
            $pengeluaran->keterangan = $data->keterangan_pengajuan;
            $pengeluaran->id_penginput = $data->id_user;
            $pengeluaran->save();

            $id_pengeluaran = $pengeluaran->id;

            $detail = $modelDetailPengajuan->where('pengajuan_dana_id', $id)->get();
            foreach ($detail as $key => $value) {
                $modelDetailPengeluaran->create([
                    'pengeluaran_id' => $id_pengeluaran,
                    'item' => $value->item,
                    'jumlah' => $value->jumlah,
                    'satuan' => $value->satuan,
                    'harga_satuan' => $value->harga_satuan,
                    'total_harga' => $value->total_harga,
                ]);
            }

            $modelLaporan = new LaporanKeuangan();
            $modelLaporan->tanggal = date('Y-m-d');
            $modelLaporan->keterangan = $data->tujuan_pengajuan;
            $modelLaporan->pengeluaran = $detail->sum('total_harga'); // Pengeluaran
            $modelLaporan->pemasukan = 0; // Pemasukan
            $saldo_akhir = $modelLaporan->getSaldoAkhir();
            $modelLaporan->saldo_akhir = $saldo_akhir->saldo_akhir - $detail->sum('total_harga'); // Saldo
            $modelLaporan->save();

            
        } else {
            $data->verifikasi_pimpinan = $request->verifikasi_pimpinan;
            $data->keterangan_verifikasi_pimpinan = $request->keterangan_verifikasi;
        }
        $data->save();

        return redirect()->route('keuangan.pengajuan_dana.show', $id)->with('success', 'Pengajuan dana berhasil diverifikasi');
    }
}
