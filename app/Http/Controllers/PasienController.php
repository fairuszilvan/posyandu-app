<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $query = Pasien::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $query->whereRaw('LOWER(nama) LIKE ?', ["%{$search}%"]);
        }
        $pasien = $query->get();
        return view('pasien.index', compact('pasien'));
    }
    public function Store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'notelpon' => 'required|string|max:20',
            'jenis_kelamin' => 'required',
            'usia' => 'required|string|max:4',
            'alamat' => 'required|string|max:255',
        ]);

        // Dapatkan ID pengguna yang sedang login (jika diperlukan)

        // Mendapatkan bulan dan tahun saat ini
        $currentMonthYear = Carbon::now()->format('m-Y');

        // Mengambil kode pasien terakhir yang dibuat pada bulan dan tahun saat ini
        $lastPatient = Pasien::where('kode_pasien', 'like', 'PAS/' . $currentMonthYear . '/%')
            ->orderBy('kode_pasien', 'desc')
            ->first();

        // Menentukan nomor urut berikutnya
        if ($lastPatient) {
            // Memisahkan bagian angka dari kode_pasien terakhir
            $lastIncrement = (int)substr($lastPatient->kode_pasien, -3);
            $newIncrement = str_pad($lastIncrement + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newIncrement = '001';
        }

        // Membuat kode pasien baru
        $kode_pasien = 'PAS/' . $currentMonthYear . '/' . $newIncrement;

        // Buat tamu baru
        $pasien = new Pasien();
        $pasien->kode_pasien = $kode_pasien;
        $pasien->nama = $validatedData['nama'];
        $pasien->notelpon = $validatedData['notelpon'];
        $pasien->jenis_kelamin = $validatedData['jenis_kelamin'];
        $pasien->usia = $validatedData['usia'];
        $pasien->alamat = $validatedData['alamat'];

        $pasien->save();

        // Redirect pengguna kembali ke halaman yang sesuai
        return redirect()->route('pasien.index')->with('success', 'Data Sudah Disimpan');
    }
    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);

        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'pasien has been deleted successfully.');
    }
    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);

        return view('pasien.edit', compact('pasien'))->with('success', 'pasien has been Edited successfully.');
    }
    public function show($id)
    {
        $pasien = Pasien::findOrFail($id);

        $medicalRecord = Periksa::where('id_pasien', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pasien.show', compact('pasien', 'medicalRecord'));
    }
}
