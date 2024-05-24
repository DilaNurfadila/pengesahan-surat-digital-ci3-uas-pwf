# Pengesahan Surat Digital Berbasis web

---

## Pengenalan

Aplikasi Pengesahan Surat Digital dirancang untuk mempermudah proses pengesahan surat.

## Setup Awal

1. Unduh repo ini
2. Ekstrak zip nya
3. Simpan hasil ekstrak tadi ke lokasi PHP disimpan

### Windows

> C:\xampp\htdocs\

### Linux

#### Ubuntu

Menggunakan XAMPP :

> /opt/lampp/htdocs/

Menggunakan apache2 :

> /var/www/html/

Distro linux lain bisa menyesuaikan.

## Kesalahan

Biasanya kesalahan terjadi karena perbedaan versi PHP ataupun pengaturan di konfigurasi (config).

Kembali lagi konfigurasi menyesuaikan keadaan yang sebenarnya.

Error yang umum terjadi :

`Message: Creation of dynamic property CI_DB_mysqli_driver::$failover is deprecated`

Solusi :

1. Buka file application/config/database.php
2. Scroll ke bawah sampai menemukan tulisan `failover` (biasanya berada di baris 96)
3. Bisa menghapusnya atau dikomentari

---

`Message: Creation of dynamic property ...::$... is deprecated`

Solusi :

1. Buka file berikut :

   - system/core/Controller.php
   - system/core/Router.php
   - system/core/URI.php
   - system/core/Loader.php (jika bekerja dengan database)

2. Lalu masukan baris berikut sebelum class

`#[AllowDynamicProperties]`

---

`Message: mysqli::real_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: NO)`

Solusi :

1. Buka file application/config/database.php
2. Sesuaikan hostname, username, password, dan nama database dengan keadaan yang sebenarnya
