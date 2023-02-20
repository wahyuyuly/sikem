<?php

return [
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

    'accepted'             => 'Isian ini harus diterima.',
    'active_url'           => 'Isian ini bukan URL yang valid.',
    'after'                => 'Isian ini harus tanggal setelah :date.',
    'after_or_equal'       => 'Isian ini harus berupa tanggal setelah atau sama dengan tanggal :date.',
    'alpha'                => 'Isian ini hanya boleh berisi huruf.',
    'alpha_dash'           => 'Isian ini hanya boleh berisi huruf, angka, dan strip.',
    'alpha_num'            => 'Isian ini hanya boleh berisi huruf dan angka.',
    'array'                => 'Isian ini harus berupa sebuah array.',
    'before'               => 'Isian ini harus tanggal sebelum :date.',
    'before_or_equal'      => 'Isian ini harus berupa tanggal sebelum atau sama dengan tanggal :date.',
    'between'              => [
        'numeric' => 'Isian ini harus antara :min dan :max.',
        'file'    => 'Bidang ini harus antara :min dan :max kilobita.',
        'string'  => 'Isian ini harus antara :min dan :max karakter.',
        'array'   => 'Isian ini harus antara :min dan :max item.',
    ],
    'boolean'              => 'Isian ini harus berupa true atau false',
    'confirmed'            => 'Konfirmasi ini tidak cocok.',
    'date'                 => 'Isian ini bukan tanggal yang valid.',
    'date_equals'          => 'The ini must be a date equal to :date.',
    'date_format'          => 'Isian ini tidak cocok dengan format :format.',
    'different'            => 'Isian ini dan :other harus berbeda.',
    'digits'               => 'Isian ini harus berupa angka :digits.',
    'digits_between'       => 'Isian ini harus minimal :min digit dan maksimal :max digit.',
    'dimensions'           => 'Bidang ini tidak memiliki dimensi gambar yang valid.',
    'distinct'             => 'Bidang isian ini memiliki nilai yang duplikat.',
    'email'                => 'Isian ini harus berupa alamat surel yang valid.',
    'exists'               => 'Isian ini yang dipilih tidak valid.',
    'file'                 => 'Bidang ini harus berupa sebuah berkas.',
    'filled'               => 'Isian ini harus memiliki nilai.',
    'gt'                   => [
        'numeric' => 'Isian ini harus lebih besar dari :value.',
        'file'    => 'Bidang ini harus lebih besar dari :value kilobita.',
        'string'  => 'Isian ini harus lebih besar dari :value karakter.',
        'array'   => 'Isian ini harus lebih dari :value item.',
    ],
    'gte'                  => [
        'numeric' => 'Isian ini harus lebih besar dari atau sama dengan :value.',
        'file'    => 'Bidang ini harus lebih besar dari atau sama dengan :value kilobita.',
        'string'  => 'Isian ini harus lebih besar dari atau sama dengan :value karakter.',
        'array'   => 'Isian ini harus mempunyai :value item atau lebih.',
    ],
    'image'                => 'Isian ini harus berupa gambar.',
    'in'                   => 'Isian ini yang dipilih tidak valid.',
    'in_array'             => 'Bidang isian ini tidak terdapat dalam :other.',
    'integer'              => 'Isian ini harus merupakan bilangan bulat.',
    'ip'                   => 'Isian ini harus berupa alamat IP yang valid.',
    'ipv4'                 => 'Isian ini harus berupa alamat IPv4 yang valid.',
    'ipv6'                 => 'Isian ini harus berupa alamat IPv6 yang valid.',
    'json'                 => 'Isian ini harus berupa JSON string yang valid.',
    'lt'                   => [
        'numeric' => 'Isian ini harus kurang dari :value.',
        'file'    => 'Bidang ini harus kurang dari :value kilobita.',
        'string'  => 'Isian ini harus kurang dari :value karakter.',
        'array'   => 'Isian ini harus kurang dari :value item.',
    ],
    'lte'                  => [
        'numeric' => 'Isian ini harus kurang dari atau sama dengan :value.',
        'file'    => 'Bidang ini harus kurang dari atau sama dengan :value kilobita.',
        'string'  => 'Isian ini harus kurang dari atau sama dengan :value karakter.',
        'array'   => 'Isian ini harus tidak lebih dari :value item.',
    ],
    'max'                  => [
        'numeric' => 'Isian ini seharusnya tidak lebih dari :max.',
        'file'    => 'Bidang ini seharusnya tidak lebih dari :max kilobita.',
        'string'  => 'Isian ini seharusnya tidak lebih dari :max karakter.',
        'array'   => 'Isian ini seharusnya tidak lebih dari :max item.',
    ],
    'mimes'                => 'Isian ini harus dokumen berjenis : :values.',
    'mimetypes'            => 'Isian ini harus dokumen berjenis : :values.',
    'min'                  => [
        'numeric' => 'Isian ini harus minimal :min.',
        'file'    => 'Bidang ini harus minimal :min kilobita.',
        'string'  => 'Isian ini harus minimal :min karakter.',
        'array'   => 'Isian ini harus minimal :min item.',
    ],
    'not_in'               => 'Isian ini yang dipilih tidak valid.',
    'not_regex'            => 'Format isian ini tidak valid.',
    'numeric'              => 'Isian ini harus berupa angka.',
    'present'              => 'Bidang isian ini wajib ada.',
    'regex'                => 'Format isian ini tidak valid.',
    'required'             => 'Bidang isian ini wajib diisi.',
    'required_if'          => 'Bidang isian ini wajib diisi bila :other adalah :value.',
    'required_unless'      => 'Bidang isian ini wajib diisi kecuali :other memiliki nilai :values.',
    'required_with'        => 'Bidang isian ini wajib diisi bila terdapat isian lainnya.',
    'required_with_all'    => 'Bidang isian ini wajib diisi bila terdapat :values.',
    'required_without'     => 'Bidang isian ini wajib diisi bila tidak terdapat :values.',
    'required_without_all' => 'Bidang isian ini wajib diisi bila tidak terdapat ada :values.',
    'same'                 => 'Isian ini dan :other harus sama.',
    'size'                 => [
        'numeric' => 'Isian ini harus berukuran :size.',
        'file'    => 'Bidang ini harus berukuran :size kilobyte.',
        'string'  => 'Isian ini harus berukuran :size karakter.',
        'array'   => 'Isian ini harus mengandung :size item.',
    ],
    'starts_with'          => 'The ini must start with one of the following: :values',
    'string'               => 'Isian ini harus berupa string.',
    'timezone'             => 'Isian ini harus berupa zona waktu yang valid.',
    'unique'               => 'Isian ini sudah ada sebelumnya.',
    'uploaded'             => 'Isian ini gagal diunggah.',
    'url'                  => 'Format isian ini tidak valid.',
    'uuid'                 => 'The ini must be a valid UUID.',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
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

    'attributes' => [
    ],
];
