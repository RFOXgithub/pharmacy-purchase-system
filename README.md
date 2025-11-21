
Update Error 21/11/2025!

- Gambar tidak tampil pada bagian pencarian

---------------------

# Sistem Pembelian Alat Kesehatan

Sistem ini adalah aplikasi **pembelian alat kesehatan** berbasis web, menggunakan:

- **PHP 7.4**
- **CodeIgniter 2**
- **MySQL / MariaDB** sebagai database
- **HTML / CSS untuk tampilan dasar**

---

## Fitur Utama

1. Manajemen produk alat kesehatan
2. Keranjang belanja (cart)
3. Checkout dan riwayat pembelian
4. Manajemen akun dan login
5. Laporan pembelian (Admin)
6. Laporan Invoice

---

## Persiapan Lingkungan

Sebelum menjalankan aplikasi, pastikan:

1. **XAMPP / WAMP / LAMP** terinstall (PHP 7.4 direkomendasikan)
2. MySQL / MariaDB berjalan
3. CodeIgniter 2 sudah berada di folder project

---

## Instalasi

1. Clone repository
2. Import Database
3. Nyalakan MySQL dan Apache jika menggunakan XAMPP
4. Lakukan konfigurasi jiak terdapat error
  - Konfigurasi pada config.php disesuaikan dengan nama folder
  - Konfigurasi file produk.php di function addKatalog(), ubah uoload_path sesuai dengan path kalian ($config['upload_path'] = '...\htdocs\pharmacy-purchase-system\img\produk';)
6. Buka file pada browser
7. Selesai
