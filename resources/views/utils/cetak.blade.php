<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pasien dengan Rekam Medis Terbaru</title>
</head>
<body>
    <h1>Daftar Pasien dengan Rekam Medis Terbaru</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Pasien</th>
                <th>Rekam Medis Terbaru</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
                <tr>
                    <td>{{ $patient->nama }}</td>
                    <td>
                        @if($patient->latestMedicalRecord)
                            {{ $patient->latestMedicalRecord->keluhan }} {{-- Atur sesuai kolom yang ada --}}
                        @else
                            Tidak ada rekam medis
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
