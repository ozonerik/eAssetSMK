<p align="center">
<img src="public/img/logo.png" width="100">
</p>

## About eAssetSMK

eAssetSMK adalah aplikasi sistem pencatatan Asset / Barang Inventaris Sekolah yang pelabelannya menggunakan sistem QrCode dengan pengecakan status asset secara online

Fitur yang belum selesai:
<pre>
1. Import, Export (.xlsx), Edit/Del Selection inventaris
2. Chekbox Inventaris
3. Print Label Per Barang  x Jumlah Label Copy (Menu Inventaris)
4. Print Label Barang  by Nomor Urut Barang (Menu Print)
</pre>

Fitur yang sudah selesai:
<pre>
1. Konfigurasi Pengguna
2. Edit Profile
3. QrCode Generate
4. QrCode Link Status
5. Editing Landing Page
6. Dashboard Information
7. Changelogs Informations
8. Add,Edit,Del Sumber Anggaran
9. Add,Edit,Del Tahun Anggaran
10. Add,Edit,Del Jenis Barang
11. Add,Edit,Del Penyimpanan
12. Add,Edit,Del Sumber Anggaran
13. Edit,Del Asset Barang
14. Add,Edit,Del Organisasi
15. Detail Informasi Qrcode
16. Print Label QrCode
17. Print Laporan Daftar Inventaris
18. Update status Asset via Link QrCode (user must login)
</pre>

Prsayarat:
1. extensi Imagick di PHP harus enable ( https://laksmisetiawati.github.io/articles/php-windows-imagick.html )

Instalasi:
1. Download dan Install Laragon https://laragon.org/download/index.html
2. PHP harus versi 7.4 ( https://windows.php.net/downloads/releases/archives/ )
3. Requirement Check Laravel Framework 8.83.27

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
kabengmm@test.id / 12345678
kabengtkj@test.id / 12345678
toolmanmm@test.id / 12345678
toolmantkj@test.id / 12345678
