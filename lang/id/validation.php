<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut berisi pesan-pesan kesalahan default yang digunakan oleh
    | kelas validator. Beberapa aturan ini memiliki beberapa versi seperti
    | aturan ukuran. Anda bebas mengubah setiap pesan ini di sini.
    |
    */

    'accepted' => 'Bidang :attribute harus diterima.',
    'accepted_if' => 'Bidang :attribute harus diterima ketika :other adalah :value.',
    'active_url' => 'Bidang :attribute harus merupakan URL yang valid.',
    'after' => 'Bidang :attribute harus merupakan tanggal setelah :date.',
    'after_or_equal' => 'Bidang :attribute harus merupakan tanggal setelah atau sama dengan :date.',
    'alpha' => 'Bidang :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Bidang :attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
    'alpha_num' => 'Bidang :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Bidang :attribute harus merupakan larik.',
    'ascii' => 'Bidang :attribute hanya boleh berisi karakter alfanumerik satu byte dan simbol.',
    'before' => 'Bidang :attribute harus merupakan tanggal sebelum :date.',
    'before_or_equal' => 'Bidang :attribute harus merupakan tanggal sebelum atau sama dengan :date.',
    'between' => [
        'array' => 'Bidang :attribute harus memiliki antara :min dan :max item.',
        'file' => 'Bidang :attribute harus antara :min dan :max kilobita.',
        'numeric' => 'Bidang :attribute harus antara :min dan :max.',
        'string' => 'Bidang :attribute harus antara :min dan :max karakter.',
    ],
    'boolean' => 'Bidang :attribute harus bernilai true atau false.',
    'can' => 'Bidang :attribute berisi nilai yang tidak diizinkan.',
    'confirmed' => 'Konfirmasi bidang :attribute tidak cocok.',
    'current_password' => 'Kata sandi salah.',
    'date' => 'Bidang :attribute harus merupakan tanggal yang valid.',
    'date_equals' => 'Bidang :attribute harus merupakan tanggal yang sama dengan :date.',
    'date_format' => 'Bidang :attribute harus cocok dengan format :format.',
    'decimal' => 'Bidang :attribute harus memiliki :decimal tempat desimal.',
    'declined' => 'Bidang :attribute harus ditolak.',
    'declined_if' => 'Bidang :attribute harus ditolak ketika :other adalah :value.',
    'different' => 'Bidang :attribute dan :other harus berbeda.',
    'digits' => 'Bidang :attribute harus :digits digit.',
    'digits_between' => 'Bidang :attribute harus antara :min dan :max digit.',
    'dimensions' => 'Bidang :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Bidang :attribute memiliki nilai duplikat.',
    'doesnt_end_with' => 'Bidang :attribute tidak boleh diakhiri dengan salah satu dari berikut: :values.',
    'doesnt_start_with' => 'Bidang :attribute tidak boleh diawali dengan salah satu dari berikut: :values.',
    'email' => 'Bidang :attribute harus merupakan alamat email yang valid.',
    'ends_with' => 'Bidang :attribute harus diakhiri dengan salah satu dari berikut: :values.',
    'enum' => 'Pilihan :attribute yang dipilih tidak valid.',
    'exists' => 'Pilihan :attribute yang dipilih tidak valid.',
    'extensions' => 'Bidang :attribute harus memiliki salah satu ekstensi berikut: :values.',
    'file' => 'Bidang :attribute harus berupa file.',
    'filled' => 'Bidang :attribute harus memiliki nilai.',
    'gt' => [
        'array' => 'Bidang :attribute harus memiliki lebih dari :value item.',
        'file' => 'Bidang :attribute harus lebih besar dari :value kilobita.',
        'numeric' => 'Bidang :attribute harus lebih besar dari :value.',
        'string' => 'Bidang :attribute harus lebih besar dari :value karakter.',
    ],
    'gte' => [
        'array' => 'Bidang :attribute harus memiliki :value item atau lebih.',
        'file' => 'Bidang :attribute harus lebih besar dari atau sama dengan :value kilobita.',
        'numeric' => 'Bidang :attribute harus lebih besar dari atau sama dengan :value.',
        'string' => 'Bidang :attribute harus lebih besar dari atau sama dengan :value karakter.',
    ],
    'hex_color' => 'Bidang :attribute harus merupakan warna heksadesimal yang valid.',
    'image' => 'Bidang :attribute harus merupakan gambar.',
    'in' => 'Pilihan :attribute yang dipilih tidak valid.',
    'in_array' => 'Bidang :attribute harus ada dalam :other.',
    'integer' => 'Bidang :attribute harus merupakan bilangan bulat.',
    'ip' => 'Bidang :attribute harus merupakan alamat IP yang valid.',
    'ipv4' => 'Bidang :attribute harus merupakan alamat IPv4 yang valid.',
    'ipv6' => 'Bidang :attribute harus merupakan alamat IPv6 yang valid.',
    'json' => 'Bidang :attribute harus merupakan string JSON yang valid.',
    'list' => 'Bidang :attribute harus merupakan daftar.',
    'lowercase' => 'Bidang :attribute harus huruf kecil.',
    'lt' => [
        'array' => 'Bidang :attribute harus memiliki kurang dari :value item.',
        'file' => 'Bidang :attribute harus kurang dari :value kilobita.',
        'numeric' => 'Bidang :attribute harus kurang dari :value.',
        'string' => 'Bidang :attribute harus kurang dari :value karakter.',
    ],
    'lte' => [
        'array' => 'Bidang :attribute tidak boleh memiliki lebih dari :value item.',
        'file' => 'Bidang :attribute harus kurang dari atau sama dengan :value kilobita.',
        'numeric' => 'Bidang :attribute harus kurang dari atau sama dengan :value.',
        'string' => 'Bidang :attribute harus kurang dari atau sama dengan :value karakter.',
    ],
    'mac_address' => 'Bidang :attribute harus merupakan alamat MAC yang valid.',
    'max' => [
        'array' => 'Bidang :attribute tidak boleh memiliki lebih dari :max item.',
        'file' => 'Bidang :attribute tidak boleh lebih besar dari :max kilobita.',
        'numeric' => 'Bidang :attribute tidak boleh lebih besar dari :max.',
        'string' => 'Bidang :attribute tidak boleh lebih besar dari :max karakter.',
    ],
    'max_digits' => 'Bidang :attribute tidak boleh memiliki lebih dari :max digit.',
    'mimes' => 'Bidang :attribute harus merupakan file dengan tipe: :values.',
    'mimetypes' => 'Bidang :attribute harus merupakan file dengan tipe: :values.',
    'min' => [
        'array' => 'Bidang :attribute harus memiliki setidaknya :min item.',
        'file' => 'Bidang :attribute harus setidaknya :min kilobita.',
        'numeric' => 'Bidang :attribute harus setidaknya :min.',
        'string' => 'Bidang :attribute harus setidaknya :min karakter.',
    ],
    'min_digits' => 'Bidang :attribute harus memiliki setidaknya :min digit.',
    'missing' => 'Bidang :attribute harus hilang.',
    'missing_if' => 'Bidang :attribute harus hilang ketika :other adalah :value.',
    'missing_unless' => 'Bidang :attribute harus hilang kecuali :other adalah :value.',
    'missing_with' => 'Bidang :attribute harus hilang ketika :values hadir.',
    'missing_with_all' => 'Bidang :attribute harus hilang ketika :values hadir.',
    'multiple_of' => 'Bidang :attribute harus merupakan kelipatan dari :value.',
    'not_in' => 'Pilihan :attribute yang dipilih tidak valid.',
    'not_regex' => 'Format bidang :attribute tidak valid.',
    'numeric' => 'Bidang :attribute harus berupa angka.',
    'password' => [
        'letters' => 'Bidang :attribute harus mengandung setidaknya satu huruf.',
        'mixed' => 'Bidang :attribute harus mengandung setidaknya satu huruf kapital dan satu huruf kecil.',
        'numbers' => 'Bidang :attribute harus mengandung setidaknya satu angka.',
        'symbols' => 'Bidang :attribute harus mengandung setidaknya satu simbol.',
        'uncompromised' => ':attribute yang diberikan telah muncul dalam kebocoran data. Harap pilih :attribute yang berbeda.',
    ],
    'present' => 'Bidang :attribute harus hadir.',
    'present_if' => 'Bidang :attribute harus hadir ketika :other adalah :value.',
    'present_unless' => 'Bidang :attribute harus hadir kecuali :other adalah :value.',
    'present_with' => 'Bidang :attribute harus hadir ketika :values hadir.',
    'present_with_all' => 'Bidang :attribute harus hadir ketika :values hadir.',
    'prohibited' => 'Bidang :attribute dilarang.',
    'prohibited_if' => 'Bidang :attribute dilarang ketika :other adalah :value.',
    'prohibited_unless' => 'Bidang :attribute dilarang kecuali :other ada dalam :values.',
    'prohibits' => 'Bidang :attribute melarang :other dari hadir.',
    'regex' => 'Format bidang :attribute tidak valid.',
    'required' => 'Bidang :attribute harus diisi.',
    'required_array_keys' => 'Bidang :attribute harus berisi entri untuk: :values.',
    'required_if' => 'Bidang :attribute diperlukan ketika :other adalah :value.',
    'required_if_accepted' => 'Bidang :attribute diperlukan ketika :other diterima.',
    'required_if_declined' => 'Bidang :attribute diperlukan ketika :other ditolak.',
    'required_unless' => 'Bidang :attribute diperlukan kecuali :other ada dalam :values.',
    'required_with' => 'Bidang :attribute diperlukan ketika :values hadir.',
    'required_with_all' => 'Bidang :attribute diperlukan ketika :values hadir.',
    'required_without' => 'Bidang :attribute diperlukan ketika :values tidak hadir.',
    'required_without_all' => 'Bidang :attribute diperlukan ketika tidak ada :values yang hadir.',
    'same' => 'Bidang :attribute dan :other harus cocok.',
    'size' => [
        'array' => 'Bidang :attribute harus berisi :size item.',
        'file' => 'Bidang :attribute harus :size kilobita.',
        'numeric' => 'Bidang :attribute harus :size.',
        'string' => 'Bidang :attribute harus :size karakter.',
    ],
    'starts_with' => 'Bidang :attribute harus diawali dengan salah satu dari berikut: :values.',
    'string' => 'Bidang :attribute harus berupa string.',
    'timezone' => 'Bidang :attribute harus merupakan zona waktu yang valid.',
    'unique' => 'Bidang :attribute sudah ada sebelumnya.',
    'uploaded' => 'Bidang :attribute gagal diunggah.',
    'uppercase' => 'Bidang :attribute harus huruf kapital.',
    'url' => 'Bidang :attribute harus merupakan URL yang valid.',
    'ulid' => 'Bidang :attribute harus merupakan ULID yang valid.',
    'uuid' => 'Bidang :attribute harus merupakan UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi khusus untuk atribut menggunakan
    | konvensi "attribute.rule" untuk menamai baris. Ini membuatnya cepat untuk
    | menentukan pesan bahasa khusus tertentu untuk aturan atribut tertentu.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar placeholder atribut kami
    | dengan sesuatu yang lebih mudah dibaca seperti "Alamat E-Mail" daripada
    | "email". Ini hanya membantu kita membuat pesan kita lebih ekspresif.
    |
    */

    'attributes' => [],

];
