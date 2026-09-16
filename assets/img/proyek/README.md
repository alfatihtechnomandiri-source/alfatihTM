# Foto lingkup pekerjaan (halaman Portofolio & Home)

Berkas di folder ini dipakai sebagai gambar 9 item "Lingkup pekerjaan" (`projects()` di
`inc/content.php`) — muncul di Home (3 kartu pertama), Portofolio (9 kartu), halaman detail
`proyek.php` (foto utama + galeri), dan lightbox galeri.

## Berkas yang dipakai

| Berkas | Lingkup pekerjaan |
| --- | --- |
| `1-instalasi-jaringan-ftth.jpg` | Instalasi Jaringan Fiber Optik (FTTH) |
| `2-jaringan-backbone-feeder.jpg` | Penarikan Kabel Feeder & Backbone |
| `3-jaringan-distribusi-udara.jpg` | Jaringan Distribusi Udara |
| `4-konstruksi-gedung-operasional.jpg` | Konstruksi Gedung Operasional |
| `5-konstruksi-gudang-industri.jpg` | Konstruksi Gudang & Bangunan Industri |
| `6-pekerjaan-lahan-pondasi-sipil.jpg` | Pekerjaan Lahan, Pondasi & Sipil |
| `7-renovasi-bangunan.jpg` | Renovasi & Penataan Bangunan |
| `8-desain-drafter-perencanaan.jpg` | Desain & Drafter Perencanaan |
| `9-manajemen-data-konstruksi.jpg` | Manajemen Data Konstruksi |

Semuanya **1600 × 840 px (rasio 16:8,4)**, JPEG kualitas 86.

## Cara berkas diolah

Asalnya dokumen "DATA LOGO..." versi foto dari Google Drive user (9 gambar, urutannya sama
dengan urutan lingkup pekerjaan di situs). Berkas aslinya disimpan di `sumber/`.

Bingkai foto di situs selalu dipotong (`object-fit: cover`) ke bentuk mendatar: kartu 16/11,
foto utama detail 16/8,4, galeri 4/3. Karena pemotongan CSS selalu dari tengah, foto
disiapkan pada **rasio terlebar yang dipakai situs (16:8,4 = 1,905)** dengan pemotongan
**dari tengah** — hasil yang terlihat identik dengan sebelumnya, tapi berkas tidak menyimpan
piksel yang toh terbuang.

Catatan: 6 dari 9 foto asli berbentuk **tegak**, jadi bagian atas/bawahnya memang terpotong
oleh bingkai mendatar (tersisa 39–82% tinggi). Kalau ada foto yang terlihat terpotong janggal,
geser titik potongnya lalu simpan ulang dengan nama yang sama.

## Hal penting

- **Jangan menimpa `assets/img/proj-*.jpg` atau `prod-*.jpg`.** Tiga di antaranya
  (`proj-8.jpg`, `proj-6.jpg`, `prod-10.jpg`) juga dipakai sebagai gambar katalog produk,
  jadi foto lingkup pekerjaan sengaja ditaruh di folder ini agar katalog tidak ikut berubah.
  `proj-1/5/7/9.jpg` sekarang sudah tidak dirujuk lagi (cadangan lama, boleh dihapus).
- Foto produk katalog (`prod-*.jpg`), banner Home (`hero.jpg`), dan foto CTA (`cta.jpg`)
  **masih placeholder** dari Wikimedia Commons — ganti dengan dokumentasi asli bila tersedia.
