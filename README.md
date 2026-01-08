# E-Commerce X

Aplikasi E-Commerce modern yang dibangun dengan Laravel, Filament, dan Tailwind CSS. Proyek ini mencakup fungsionalitas e-commerce penting seperti manajemen produk, keranjang belanja, dan integrasi pembayaran.

## Fitur Utama

-   **Panel Admin Keren**: Manajemen produk, kategori, dan pesanan dengan mudah menggunakan [Filament](https://filamentphp.com/).
-   **Otentikasi Fleksibel**: Sistem registrasi dan login standar, serta opsi login menggunakan akun Google (Socialite).
-   **Gateway Pembayaran**: Integrasi dengan [Midtrans](https://midtrans.com/) untuk memproses pembayaran.
-   **Desain Responsif**: Antarmuka yang dibuat dengan [Tailwind CSS](https://tailwindcss.com/) agar terlihat bagus di semua perangkat.
-   **Keranjang Belanja**: Fungsionalitas keranjang belanja penuh untuk pengguna.

## Teknologi yang Digunakan

-   [Laravel](https://laravel.com/)
-   [Filament](https://filamentphp.com/)
-   [Tailwind CSS](https://tailwindcss.com/)
-   [Vite](https://vitejs.dev/)
-   [MySQL](https://www.mysql.com/)

---

## Panduan Instalasi dan Penggunaan

Berikut adalah langkah-langkah untuk menginstal dan menjalankan proyek ini di lingkungan pengembangan lokal.

### Prasyarat

Pastikan perangkat Anda sudah terinstal:
-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   Database (misalnya MySQL, MariaDB)

### Langkah-langkah Instalasi

1.  **Clone Repositori**
    ```bash
    git clone https://github.com/username/nama-repositori.git
    cd nama-repositori
    ```
    *(Ganti `username/nama-repositori` dengan URL repositori Anda)*

2.  **Instal Dependensi PHP**
    ```bash
    composer install
    ```

3.  **Instal Dependensi JavaScript**
    ```bash
    npm install
    ```

4.  **Buat File Environment**
    Salin file `.env.example` menjadi `.env`.
    ```bash
    cp .env.example .env
    ```

5.  **Generate Kunci Aplikasi**
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi File `.env`**
    Buka file `.env` dan sesuaikan konfigurasi berikut:

    -   **Koneksi Database**:
        ```
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=nama_database_anda
        DB_USERNAME=user_database_anda
        DB_PASSWORD=password_database_anda
        ```

    -   **URL Aplikasi**:
        ```
        APP_URL=http://localhost:8000
        ```

    -   **Kredensial Google (untuk Socialite)**:
        ```
        GOOGLE_CLIENT_ID=ID_CLIENT_GOOGLE_ANDA
        GOOGLE_CLIENT_SECRET=RAHASIA_CLIENT_GOOGLE_ANDA
        GOOGLE_REDIRECT_URI=${APP_URL}/auth/google/callback
        ```

    -   **Kredensial Midtrans**:
        ```
        MIDTRANS_MERCHANT_ID=ID_MERCHANT_MIDTRANS_ANDA
        MIDTRANS_CLIENT_KEY=KUNCI_CLIENT_MIDTRANS_ANDA
        MIDTRANS_SERVER_KEY=KUNCI_SERVER_MIDTRANS_ANDA
        ```

7.  **Jalankan Migrasi dan Seeder Database**
    Perintah ini akan membuat semua tabel database yang diperlukan dan mengisinya dengan data awal (jika ada seeder).
    ```bash
    php artisan migrate --seed
    ```

8.  **Buat Akun Admin**
    Untuk mengakses panel admin Filament, buat pengguna admin pertama Anda dengan menjalankan perintah berikut dan ikuti petunjuknya:
    ```bash
    php artisan make:filament-user
    ```

9.  **Build Aset Frontend**
    ```bash
    npm run build
    ```

10. **Jalankan Server Pengembangan**
    ```bash
    php artisan serve
    ```

### Mengakses Aplikasi

-   **Aplikasi Utama**: Buka [http://localhost:8000](http://localhost:8000) di browser Anda.
-   **Panel Admin**: Buka [http://localhost:8000/admin](http://localhost:8000/admin) dan login menggunakan akun admin yang Anda buat pada langkah 8.