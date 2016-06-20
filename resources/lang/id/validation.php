<?php

return array(

    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut ini berisi standar pesan kesalahan yang digunakan oleh
    | kelas validasi. Beberapa aturan mempunyai multi versi seperti aturan 'size'.
    | Jangan ragu untuk mengoptimalkan setiap pesan yang ada di sini.
    |
    */

    "accepted"             => "Isian harus diterima",
    "active_url"           => "Isian bukan URL yang valid",
    "after"                => "Isian harus tanggal setelah :date",
    "alpha"                => "Isian hanya boleh berisi huruf",
    "alpha_dash"           => "Isian hanya boleh berisi huruf, angka, dan strip",
    "alpha_num"            => "Isian hanya boleh berisi huruf dan angka",
    "array"                => "Isian harus berupa sebuah array",
    "before"               => "Isian harus tanggal sebelum :date",
    "between"              => array(
        "numeric" => "Isian harus antara :min dan :max",
        "file"    => "Isian harus antara :min dan :max kilobytes",
        "string"  => "Isian harus antara :min dan :max karakter",
        "array"   => "Isian harus antara :min dan :max item",
    ),
    "boolean"              => "Isian harus berupa true atau false",
    "confirmed"            => "Konfirmasi tidak cocok",
    "date"                 => "Isian bukan tanggal yang valid",
    "date_format"          => "Isian tidak cocok dengan format :format",
    "different"            => "Isian dan :other harus berbeda",
    "digits"               => "Isian harus berupa :digits angka",
    "digits_between"       => "Isian harus antara angka :min dan :max",
    "email"                => "Isian harus berupa alamat surel yang valid",
    "exists"               => "Isian yang dipilih tidak valid",
    "image"                => "Isian harus berupa gambar",
    "in"                   => "Isian yang dipilih tidak valid",
    "integer"              => "Isian harus merupakan bilangan bulat",
    "ip"                   => "Isian harus berupa alamat IP yang valid",
    "max"                  => array(
        "numeric" => "Isian seharusnya tidak lebih dari :max",
        "file"    => "Isian seharusnya tidak lebih dari :max kilobytes",
        "string"  => "Isian seharusnya tidak lebih dari :max karakter",
        "array"   => "Isian seharusnya tidak lebih dari :max item",
    ),
    "mimes"                => "Isian harus dokumen berjenis : :values",
    "min"                  => array(
        "numeric" => "Isian harus minimal :min",
        "file"    => "Isian harus minimal :min kilobytes",
        "string"  => "Isian harus minimal :min karakter",
        "array"   => "Isian harus minimal :min item",
    ),
    "not_in"               => "Isian yang dipilih tidak valid",
    "numeric"              => "Isian harus berupa angka",
    "regex"                => "Format isian tidak valid",
    "required"             => "Bidang isian wajib diisi",
    "required_if"          => "Bidang isian wajib diisi bila :other adalah :value",
    "required_with"        => "Bidang isian wajib diisi bila terdapat :values",
    "required_with_all"    => "Bidang isian wajib diisi bila terdapat :values",
    "required_without"     => "Bidang isian wajib diisi bila tidak terdapat :values",
    "required_without_all" => "Bidang isian wajib diisi bila tidak terdapat ada :values",
    "same"                 => "Isian dan :other harus sama",
    "size"                 => array(
        "numeric" => "Isian harus berukuran :size",
        "file"    => "Isian harus berukuran :size kilobyte",
        "string"  => "Isian harus berukuran :size karakter",
        "array"   => "Isian harus mengandung :size item",
    ),
    "timezone"             => "Isian harus berupa zona waktu yang valid",
    "unique"               => "Isian sudah ada sebelumnya",
    "url"                  => "Format isian tidak valid",

    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi Kustom
    |---------------------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut dengan menggunakan
    | konvensi "attribute.rule" dalam penamaan baris. Hal ini membuat cepat dalam
    | menentukan spesifik baris bahasa kustom untuk aturan atribut yang diberikan.
    |
    */
    
    'custom' => [
        'jenis_kelamin.required' => [
            'required' => 'Semua bidang isian harus terisi',
        ],
    ],
    
    /*
    |---------------------------------------------------------------------------------------
    | Kustom Validasi Atribut
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar atribut 'place-holders'
    | dengan sesuatu yang lebih bersahabat dengan pembaca seperti Alamat Surel daripada
    | "surel" saja. Ini benar-benar membantu kita membuat pesan sedikit bersih.
    |
    */

    'attributes' => array(),

);
