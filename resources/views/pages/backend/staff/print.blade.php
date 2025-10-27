<!DOCTYPE html>
<html style="margin: 0; padding: 0;">
<head>
    <meta charset="utf-8">
    <title>DAFTAR STAF</title>
    <style>
        @page {
            size: A4;
        }
    </style>
</head>
<body style="margin: 15mm; padding: ; font-family: 'Times New Roman', Times, serif; font-size: 12px; line-height: 1.2; color: #111;">
    <div class="layout-wrapper" style="padding: 8px 12px 12px;">
        <header class="kop-surat" style="padding-bottom: 6px; border-bottom: 3px double #000; position: relative;">
            <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                <tr>
                    <td style="width: 90px; text-align: center; vertical-align: middle; border: 1px solid transparent;">
                        <img src="{{ asset('logos/logo.svg') }}" alt="Logo Aceh Jaya" style="width: 75px; height: auto; display: block; margin: 0 auto;">
                    </td>
                    <td style="text-align: center; line-height: 1; text-transform: uppercase; border: 1px solid transparent; padding: 0 12px;">
                        <h2 style="margin: 0; font-size: 14px; font-weight: 700; letter-spacing: 0.4px;">PEMERINTAH DAERAH ...</h2>
                        <h3 style="margin: 2px 0 3px; font-size: 18px; font-weight: 700; letter-spacing: 0.3px;">NAMA INSTANSI ...</h3>
                        <p style="margin: 3px 0; font-size: 10px; text-transform: none;">Alamat Instansi ...</p>
                        <p style="margin: 3px 0; font-size: 10px; text-transform: none;">Telp/Fax. (000) 000000 &nbsp; E-mail: instansi@example.com</p>
                        <p style="margin: 3px 0; font-size: 14px; text-transform: none;"><strong>KOTA ...</strong></p>
                        <span style="display: block; margin: 3px 0; font-size: 10px; text-transform: none;">Kode Pos : 00000</span>
                    </td>
                    <td style="width: 90px; font-size: 11px; text-align: right; vertical-align: middle; border: 1px solid transparent;">
                    </td>
                </tr>
            </table>
        </header>
        <h1 class="section-title" style="font-size: 18px; font-weight: 700; margin: 18px 0 4px; text-align: center; text-transform: uppercase; letter-spacing: 0.6px;">Data Staf</h1>
        <div class="meta-container" style="margin: 10px 0 12px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 4px 18px;">
        </div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 8px;">
            <thead>
                <tr>
                    <th style="border: 0.6px solid #555; padding: 6px 8px; background-color: #f3f3f3; font-weight: 700; text-align: center; font-size: 12px; text-transform: uppercase;">No</th>
                    <th style="border: 0.6px solid #555; padding: 6px 8px; background-color: #f3f3f3; font-weight: 700; text-align: center; font-size: 12px; text-transform: uppercase;">Nama Lengkap</th>
                    <th style="border: 0.6px solid #555; padding: 6px 8px; background-color: #f3f3f3; font-weight: 700; text-align: center; font-size: 12px; text-transform: uppercase;">No Staf</th>
                    <th style="border: 0.6px solid #555; padding: 6px 8px; background-color: #f3f3f3; font-weight: 700; text-align: center; font-size: 12px; text-transform: uppercase;">NIP</th>
                    <th style="border: 0.6px solid #555; padding: 6px 8px; background-color: #f3f3f3; font-weight: 700; text-align: center; font-size: 12px; text-transform: uppercase;">NUPTK</th>
                    <th style="border: 0.6px solid #555; padding: 6px 8px; background-color: #f3f3f3; font-weight: 700; text-align: center; font-size: 12px; text-transform: uppercase;">Email</th>
                    <th style="border: 0.6px solid #555; padding: 6px 8px; background-color: #f3f3f3; font-weight: 700; text-align: center; font-size: 12px; text-transform: uppercase;">Telepon</th>
                    <th style="border: 0.6px solid #555; padding: 6px 8px; background-color: #f3f3f3; font-weight: 700; text-align: center; font-size: 12px; text-transform: uppercase;">Tanggal Masuk</th>
                    <th style="border: 0.6px solid #555; padding: 6px 8px; background-color: #f3f3f3; font-weight: 700; text-align: center; font-size: 12px; text-transform: uppercase;">Kepegawaian</th>
                    <th style="border: 0.6px solid #555; padding: 6px 8px; background-color: #f3f3f3; font-weight: 700; text-align: center; font-size: 12px; text-transform: uppercase;">Pendidikan Terakhir</th>
                    <th style="border: 0.6px solid #555; padding: 6px 8px; background-color: #f3f3f3; font-weight: 700; text-align: center; font-size: 12px; text-transform: uppercase;">Jabatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stafs as $staf)
                <tr @if($loop->iteration % 2 === 0) style="background-color: #fafafa;" @endif>
                    <td style="border: 0.6px solid #555; padding: 6px 8px; font-size: 11px; vertical-align: top; text-align: center; width: 30px;">{{ $loop->iteration }}</td>
                    <td style="border: 0.6px solid #555; padding: 6px 8px; font-size: 11px; vertical-align: top;">{{ $staf->user->nama_lengkap ?? '' }}</td>
                    <td style="border: 0.6px solid #555; padding: 6px 8px; font-size: 11px; vertical-align: top;">{{ $staf->no_staf }}</td>
                    <td style="border: 0.6px solid #555; padding: 6px 8px; font-size: 11px; vertical-align: top;">{{ $staf->nip }}</td>
                    <td style="border: 0.6px solid #555; padding: 6px 8px; font-size: 11px; vertical-align: top;">{{ $staf->nuptk }}</td>
                    <td style="border: 0.6px solid #555; padding: 6px 8px; font-size: 11px; vertical-align: top;">{{ $staf->user->email ?? '' }}</td>
                    <td style="border: 0.6px solid #555; padding: 6px 8px; font-size: 11px; vertical-align: top;">{{ $staf->user->telepon ?? '' }}</td>
                    <td style="border: 0.6px solid #555; padding: 6px 8px; font-size: 11px; vertical-align: top;">{{ $staf->tanggal_masuk ? $staf->tanggal_masuk->format('d-m-Y') : '' }}</td>
                    <td style="border: 0.6px solid #555; padding: 6px 8px; font-size: 11px; vertical-align: top;">{{ $staf->status_kepegawaian }}</td>
                    <td style="border: 0.6px solid #555; padding: 6px 8px; font-size: 11px; vertical-align: top;">{{ $staf->pendidikan_terakhir }}</td>
                    <td style="border: 0.6px solid #555; padding: 6px 8px; font-size: 11px; vertical-align: top;">{{ $staf->jabatan->pluck('nama_jabatan')->implode(', ') ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="signature-wrapper" style="margin-top: 36px; display: flex; justify-content: flex-end;">
            <div style="text-align: right; font-size: 12px;">
                <p style="margin: 0;">NAMA KOTA, {{ now()->translatedFormat('d F Y') }}</p>
                <p style="margin: 0; text-transform: uppercase;">{{ auth()->user()->roles->pluck('name')->implode(', ') ?: 'Tidak ada role' }},</p>
                <div style="height: 60px;"></div>
                <p style="margin: 0; font-weight: 700; text-decoration: underline;">{{ auth()->user()->nama_lengkap }}</p>
                <p style="margin: 0;">NIP.{{ auth()->user()->staf->nip ?? '' }}</p>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function () {
            setTimeout(function () {
                window.print();
            }, 250);
        });
    </script>
</body>
</html>
