<p align="center">
<img src="public/img/logo.png" width="100">
</p>

## About eAssetSMK

eAssetSMK adalah aplikasi sistem pencatatan Asset / Barang Inventaris Sekolah yang pelabelannya menggunakan sistem QrCode dengan pengecakan status asset secara online

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
