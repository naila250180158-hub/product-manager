# Product Manager

Aplikasi web sederhana untuk mengelola data produk (CRUD) dengan PHP, MySQL (PDO), dan CSS.

Dibuat oleh: Naila Amelia (250180158)
Mata kuliah: Pemrograman Web, Praktikum 3

## Fitur
- Tambah produk (nama, kategori, harga, stok)
- Lihat daftar produk dalam bentuk card
- Edit produk
- Hapus produk
- Validasi input: nama minimal 3 karakter, harga lebih dari 0, stok tidak boleh negatif

## Struktur Folder
- `config/db.php` : koneksi database
- `public/` : halaman aplikasi (index, create, edit, delete) dan `assets/style.css`
- `database/store_db.sql` : struktur dan data database

## Cara Menjalankan
1. Install XAMPP, lalu jalankan **Apache** dan **MySQL** dari XAMPP Control Panel.
2. Salin folder `product-manager` ke folder `htdocs` milik XAMPP.
3. Buka `localhost/phpmyadmin`, lalu buat database baru bernama `store_db`.
4. Klik