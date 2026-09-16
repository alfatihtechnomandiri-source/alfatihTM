# Logo instansi pemberi kerja

Dipakai oleh tabel "Pengalaman kerjasama" di `portofolio.php`. Nama berkas dipasang
pada kunci `'logo'` di dalam fungsi `work_experience()` (`inc/content.php`).

## Berkas yang dipakai

| Berkas | Instansi |
| --- | --- |
| `suma-dwi-techno.png` | PT. Suma Dwi Techno |
| `garindo-techno-mandiri.png` | PT. Garindo Techno Mandiri |
| `telkom-indonesia.png` | PT. Telkom Indonesia (Persero) Tbk |
| `ucloudlink.png` | Ucloudlink |
| `polda-sumut.png` | Logistik Polisi Daerah Sumatera Utara (baris 5–10) |

## Cara berkas ini diolah

Sumbernya dokumen "DATA LOGO KERJASAMA PT.ATM.docx" dari Google Drive user
(berkas aslinya disimpan di `sumber/`). Setiap logo:

1. dipotong tepi kosongnya (latar putih atau area transparan),
2. diletakkan di **kanvas persegi 256×256 transparan** dengan konten maksimum
   225 px (88% sisi) dan posisi tepat di tengah.

Karena itu semua logo tampil pada ukuran optis yang sama di kolom tabel (kotak
40×40 px), meski bentuk aslinya berbeda (ada yang 2:1, ada yang hampir persegi).

Kalau logo diganti: simpan berkas baru di folder ini dengan nama yang sama, lalu
ulangi langkah 1–2 di atas (bisa memakai Pillow/Python). Jangan mengambil atau
membuat ulang logo instansi sendiri — hanya pakai berkas resmi dari perusahaan.
