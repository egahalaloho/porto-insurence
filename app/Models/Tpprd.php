<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tpprd extends Model
{
    protected $table = 'tpprd';

    protected $primaryKey = 'tpprd_pk';

    protected $fillable = [
        'tpprd_nomor_peserta',
        'tpprd_nama',
        'tpprd_tanggal_lahir',
        'tpprd_umur',
        'tpprd_bank',
        'tpprd_tanggal_awal',
        'tpprd_masa_bulan',
        'tpprd_tanggal_akhir',
        'tpprd_up',
        'tpprd_tarif',
        'tpprd_premi',
        'tpprd_user_input',
        'tpprd_date_input',
    ];

    protected $dates = [
        'tpprd_tanggal_lahir',
        'tpprd_tanggal_awal',
        'tpprd_tanggal_akhir',
        'tpprd_date_input',
    ];

}
