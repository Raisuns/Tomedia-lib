# 📚 TomediaLib

### Sistem Peminjaman Buku Berbasis Web

TomediaLib adalah aplikasi web berbasis Laravel yang dirancang untuk mempermudah pengelolaan peminjaman buku secara digital. Sistem ini menyediakan fitur lengkap untuk pengguna dan admin dalam mengelola data buku serta transaksi peminjaman dengan efisien.

---

## ✨ Overview

Aplikasi ini dibuat sebagai solusi sederhana namun efektif untuk sistem perpustakaan digital, dengan fokus pada kemudahan penggunaan, efisiensi pengelolaan data, dan pengalaman pengguna yang baik.

---

## 🚀 Fitur Utama

### 👤 User

* Registrasi & Login
* Melihat daftar buku
* Melakukan peminjaman buku
* Melihat status peminjaman:

  * ✅ Disetujui
  * ⏳ Belum Disetujui
  * ❌ Ditolak
  * 🔄 Dikembalikan

---

### 🛠️ Admin

* Login sebagai admin
* CRUD data buku (Create, Read, Update, Delete)
* Manajemen peminjaman:

  * Menyetujui permintaan
  * Menolak permintaan
  * Mengelola pengembalian buku
* Monitoring aktivitas peminjaman

---

## 🧠 Sistem Status Peminjaman

| Kode | Status          |
| ---- | --------------- |
| 1    | Disetujui       |
| 2    | Belum Disetujui |
| 3    | Ditolak         |
| 4    | Dikembalikan    |

---

## 🧩 Teknologi yang Digunakan

* ⚡ Laravel 8 (Stable Release)
* 🐘 PHP
* 🗄️ MySQL
* 🎨 Blade Template Engine
* 🎯 Bootstrap / Tailwind CSS
* 🔐 Laravel Authentication System

---

## ⚙️ Instalasi & Setup

1. Clone repository:

```bash
git clone https://github.com/username/tomedialib.git
```

2. Masuk ke folder project:

```bash
cd tomedialib
```

3. Install dependency:

```bash
composer install
npm install && npm run dev
```

4. Copy file environment:

```bash
cp .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Konfigurasi database pada file `.env`:

```env
DB_DATABASE=buku
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migrasi database:

```bash
php artisan migrate
```

8. Jalankan server:

```bash
php artisan serve
```

---

## 🗄️ Struktur Database (Ringkas)

Tabel utama dalam sistem:

* `users`
* `books`
* `peminjaman` / `book_user`

---

## 📸 Preview Aplikasi

> <img width="1919" height="971" alt="Screenshot 2026-04-06 203946" src="https://github.com/user-attachments/assets/458c530e-0b7d-4fe3-a6c1-1a7bc451c746" />
> page login
> <img width="1903" height="969" alt="Screenshot 2026-04-06 204743" src="https://github.com/user-attachments/assets/baf91f4f-b3b7-4994-b427-97cf51c9badf" />
> peminjaman Buku
> <img width="1917" height="969" alt="Screenshot 2026-04-06 204228" src="https://github.com/user-attachments/assets/ef1de61f-4351-475d-9f21-67cefd9816d8" />
> Crud Buku




---

## 📌 Catatan

* Pastikan MySQL dan PHP sudah berjalan dengan baik
* Direkomendasikan menggunakan PHP versi 8+
* Project ini masih dapat dikembangkan lebih lanjut (fitur denda, notifikasi, dll)

---

## 👨‍💻 Developer

Dikembangkan oleh **Rais**
Sebagai bagian dari pembelajaran dan pengembangan sistem berbasis web.

---

## 🚧 Future Improvements

* Sistem denda keterlambatan
* Notifikasi peminjaman
* Dashboard statistik
* Role management yang lebih kompleks

---

## ⭐ Support

Jika kamu merasa project ini bermanfaat, jangan lupa beri ⭐ pada repository ini!

---
