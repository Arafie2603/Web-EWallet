# finpro-kelompok9

Anggota kelompok :
1. Rizky Faisal Rafi
2. Rama Apryan
3. Yoga Yosepino
4. Rosidin Fahmi
5. Fajri Yanti
6. Reynaldi Ananda
7. Hajrian Hidayat
8. Danang Widianto
9. M. Arafie Setiawan
10. Fakhri Setiawan


Tahapan run program :
1. buat file .env, kemudian copas config dari $ .env.example
2. buat database baru
3. pada file .env yang sudah di copas, ganti DB_DATABASE = laravel menjadi -> DB_DATABASE = (nama database yang dibuat)
4. lakukan perintah berikut pada terminal dan jangan lupa masuk ke path project yang benar (69wallet) :
   a.   php artisan key:generate
   b.   php artisan migrate:fresh
   c.   php artisan db:seed
   d.   php artisan serve
