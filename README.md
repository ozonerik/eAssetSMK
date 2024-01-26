<p align="center">
<img src="public/img/logo.png" width="100">
</p>

## About eAssetSMK

eAssetSMK adalah aplikasi sistem pencatatan Asset / Barang Inventaris Sekolah yang pelabelannya menggunakan sistem QrCode dengan pengecakan status asset secara online

Fitur yang belum selesai:
<code>
1. Editing Landing Page
2. Dashboard Information
3. Changelogs Informations
4. Add,Edit,Del Sumber Anggaran
5. Add,Edit,Del Tahun Anggaran
6. Add,Edit,Del Jenis Barang
7. Add,Edit,Del Penyimpanan
8. Add,Edit,Del Sumber Anggaran
9. Edit,Del Asset Barang
10. Add,Edit,Del Organisasi
11. Detail Informasi Qrcode
12. Print Label QrCode
13. Print Laporan Daftar Inventaris
</code>

Fitur yang sudah selesai:
<code>
1. Konfigurasi Pengguna
2. Edit Profile
3. QrCode Generate
4. QrCode Link Status
</code>

Prsayarat:
1. extensi Imagick di PHP harus enable ( https://laksmisetiawati.github.io/articles/php-windows-imagick.html )

Instalasi:
1. Download dan Install Laragon https://laragon.org/download/index.html
2. PHP harus versi 7.4
<pre>
<code>
-> git clone https://github.com/ozonerik/eAssetSMK
-> cd ejadwal
-> composer install
-> cp .env.example .env
-> php artisan key:generate
// buka file .env setting database:
DB_DATABASE=eassetsmk
DB_USERNAME=root
DB_PASSWORD=
-> php artisan migrate
-> php artisan db:seed
// optional
untuk reset database gunakan perintah: php artisan migrate:fresh --seed
-> php artisan route:cache
-> php artisan config:cache
-> php artisan view:cache
-> php artisan storage:link
-> php artisan serve
//akses aplikasi via http://localhost:8000

//untuk update aplikasi gunakan perintah
-> git pull origin master
</code>
</pre>
Login default:
admin@test.id / 12345678
