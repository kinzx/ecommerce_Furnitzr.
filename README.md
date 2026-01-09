# Furnitzr - Modern Furniture E-Commerce

Aplikasi E-Commerce furnitur modern yang dibangun dengan **Laravel 11**, **Filament PHP**, dan **Tailwind CSS**. Proyek ini mencakup fungsionalitas e-commerce lengkap mulai dari manajemen produk, keranjang belanja dinamis, hingga integrasi pembayaran real-time.

## 🚀 Fitur Utama

### 🛒 Pengalaman Belanja (User Client)
-   **Desain Modern & Responsif**: Antarmuka utama dibangun dengan **Tailwind CSS** yang bersih dan responsif.
-   **Dynamic Shopping Cart**: Tambah, update jumlah, dan hapus barang dengan mulus.
-   **Direct Checkout Flow**:
    -   **Add to Cart**: Masukkan barang ke keranjang untuk dibayar nanti.
    -   **Buy Now**: Fitur beli langsung (skip keranjang) menuju halaman pembayaran.
-   **Visual Checkout Steps**: Indikator langkah visual (Cart > Checkout > Order History) untuk memandu pengguna.
-   **Riwayat Pesanan (My Orders)**: Halaman khusus bagi user untuk melihat status pesanan mereka (Pending, Success, Failed) dengan indikator warna.

### 💳 Pembayaran & Transaksi
-   **Midtrans Gateway**: Integrasi penuh dengan **Midtrans Snap (Popup)**.
-   **Dukungan Metode Pembayaran**: Mendukung Transfer Bank, E-Wallet (GoPay/QRIS), dan Kartu Kredit (via Sandbox/Production).
-   **Status Mapping**: Sinkronisasi status pesanan otomatis (Settlement, Pending, Expire) pada tampilan user.

### 🔐 Otentikasi & Keamanan
-   **Google Single Sign-On (SSO)**: Login cepat menggunakan akun Google (Laravel Socialite).
-   **Custom Split-Screen UI**: Halaman Login dan Register yang dikustomisasi menggunakan **Bootstrap 5** dengan desain Split-Screen (Gambar & Form) yang estetis.
-   **Role Based Access**: Pemisahan hak akses antara User biasa dan Admin.

### ⚙️ Panel Admin (Back-End)
-   **Filament PHP Dashboard**: Panel admin yang powerful untuk mengelola data.
-   **Manajemen Produk**: Upload gambar, set harga, stok, dan deskripsi.
-   **Manajemen Kategori**: Pengelompokan produk.

---

## 🛠️ Teknologi yang Digunakan

-   **Backend**: [Laravel 11](https://laravel.com/)
-   **Admin Panel**: [Filament PHP v3](https://filamentphp.com/)
-   **Frontend Styling**:
    -   [Tailwind CSS](https://tailwindcss.com/) (Halaman Utama)
    -   [Bootstrap 5](https://getbootstrap.com/) (Halaman Auth Login/Register)
-   **Interaktivitas**: [Alpine.js](https://alpinejs.dev/)
-   **Payment Gateway**: [Midtrans](https://midtrans.com/)
-   **Database**: MySQL

---

## 📸 Screenshots (Preview)

| Halaman Depan | Detail Produk |
|:---:|:---:|
| *(Masukkan screenshot Home)* | *(Masukkan screenshot Produk)* |

| Checkout & Payment | Order History |
|:---:|:---:|
| *(Masukkan screenshot Checkout)* | *(Masukkan screenshot My Orders)* |

| Custom Login UI | Admin Dashboard |
|:---:|:---:|
| *(Masukkan screenshot Login)* | *(Masukkan screenshot Filament)* |

---

## 📦 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal Anda.

### Prasyarat
-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL

### Langkah Instalasi

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/username/furnitzr.git](https://github.com/username/furnitzr.git)
    cd furnitzr
    ```

2.  **Instal Dependensi**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    Salin file `.env.example` menjadi `.env`.
    ```bash
    cp .env.example .env
    ```

4.  **Generate Key**
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database & API Keys**
    Buka file `.env` dan isi konfigurasi berikut:

    ```env
    # Database
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ecommerce_x
    DB_USERNAME=root
    DB_PASSWORD=

    # Google Socialite (Login Google)
    GOOGLE_CLIENT_ID=masukkan_client_id_google_anda
    GOOGLE_CLIENT_SECRET=masukkan_client_secret_google_anda
    GOOGLE_REDIRECT_URI=[http://127.0.0.1:8000/auth/google/callback](http://127.0.0.1:8000/auth/google/callback)

    # Midtrans (Payment Gateway)
    # Pastikan menggunakan kunci SANDBOX jika masih testing (awalan SB-)
    MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxx
    MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxx
    MIDTRANS_IS_PRODUCTION=false
    ```

6.  **Migrasi Database**
    ```bash
    php artisan migrate
    ```

7.  **Buat Akun Admin Filament**
    ```bash
    php artisan make:filament-user
    ```

8.  **Jalankan Aplikasi**
    Buka dua terminal berbeda:
    
    *Terminal 1 (Backend):*
    ```bash
    php artisan serve
    ```
    
    *Terminal 2 (Frontend Build):*
    ```bash
    npm run dev
    ```

### Akses Aplikasi
-   **Toko Online**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
-   **Admin Panel**: [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin)

---

## 🧪 Testing Pembayaran (Sandbox)

Karena mode **Sandbox** aktif, Anda tidak perlu menggunakan uang asli.
1.  Pilih produk -> Checkout.
2.  Klik **Pay Now via Midtrans**.
3.  Pilih **BCA KlikPay** (untuk sukses instan) atau **Bank Transfer > BNI** (gunakan simulator).
4.  Cek status di halaman **Order History**.

---

## 📄 Lisensi

Proyek ini bersifat open-source di bawah lisensi [MIT license](https://opensource.org/licenses/MIT).
