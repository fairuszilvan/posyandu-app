<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use Barryvdh\DomPDF\Facade\Pdf as PDF;
// use App\Exports\PasienMRTerakhir;
// use Maatwebsite\Excel\Facades\Excel;

class PeriksaController extends Controller
{
    public function index(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $pasien = Pasien::whereDoesntHave('periksa', function ($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear);
        })->get();

        return view('periksa.index', compact('pasien'));
    }
    public function show($id)
    {
        // Ambil data pasien berdasarkan ID
        $pasien = Pasien::findOrFail($id);

        // Ambil hasil pemeriksaan terbaru untuk pasien ini
        $medicalRecord = Periksa::where('id_pasien', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        // Kirim data pasien dan hasil pemeriksaan ke view
        return view('periksa.show', compact('pasien', 'medicalRecord'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_pasien' => 'required|exists:pasien,id',
            'tensi' => 'required|string|min:3|max:999',
            'bb' => 'required|integer|min:1|max:999',
            'suhu_badan' => 'required|integer|min:1|max:50',
            'nadi' => 'required|integer|min:1|max:200',
            'keluhan' => 'required|string|max:999',
        ]);

        // Mendapatkan bulan dan tahun saat ini
        $currentMonthYear = Carbon::now()->format('m-Y');

        // Mengambil kode pemeriksaan terakhir yang dibuat pada bulan dan tahun saat ini
        $lastPeriksa = Periksa::where('kode_periksa', 'like', 'MR/' . $currentMonthYear . '/%')
            ->orderBy('kode_periksa', 'desc')
            ->first();

        // Menentukan nomor urut berikutnya
        if ($lastPeriksa) {
            $lastIncrement = (int)substr($lastPeriksa->kode_periksa, -3);
            $newIncrement = str_pad($lastIncrement + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newIncrement = '001';
        }

        // Membuat kode pemeriksaan baru
        $kode_mr = 'MR/' . $currentMonthYear . '/' . $newIncrement;

        // Buat data periksa baru
        $periksa = new Periksa();
        $periksa->kode_periksa = $kode_mr;
        $periksa->id_pasien = $validatedData['id_pasien'];
        $periksa->tensi = $validatedData['tensi'];
        $periksa->bb = $validatedData['bb'];
        $periksa->suhu_badan = $validatedData['suhu_badan'];
        $periksa->nadi = $validatedData['nadi'];
        $periksa->keluhan = $validatedData['keluhan'];

        // Simpan data ke dalam database
        $periksa->save();

        // Redirect pengguna kembali ke halaman yang sesuai
        return redirect()->route('periksa.index')->with('success', 'Data Sudah Disimpan');
    }
    // public function exportPDF()
    // {
    //     // Ambil semua data pasien dengan rekam medis terbaru
    //     $patients = Pasien::with('latestMedicalRecord')->get();

    //     // Debugging: Pastikan data pasien dan rekam medis terbaru ada

    //     // Memuat view dan data ke PDF
    //     $pdf = Pdf::loadView('utils.cetak', compact('patients'));

    //     // Tentukan nama file dan unduh
    //     $fileName = 'data_posyandu_teluk_' . date('m') . '_' . date('Y') . '.pdf';
    //     return $pdf->download($fileName);
    // }
    // public function exportExcel()
    // {
    //     return Excel::download(new PasienMRTerakhir, 'patients.xlsx');
    // }
}
