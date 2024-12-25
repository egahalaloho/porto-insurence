<?php
namespace App\Services;

use App\Models\Tpprd;
use Illuminate\Support\Carbon;

class tpprdService extends Tpprd{
    
    public static function generateNomorPeserta()
    {
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        $lastRecord = self::latest('tpprd_pk')->first();
        $lastNumber = $lastRecord ? (int)substr($lastRecord->tpprd_nomor_peserta, 6) : 0;
        $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        return "$year.$month.$newNumber";
    }

    public static function calculateUmur($tanggalLahir)
    {
        return Carbon::parse($tanggalLahir)->diffInYears(Carbon::now());
    }

    public static function calculateTanggalAkhir($tanggalAwal, $masaBulan)
    {
        return Carbon::parse($tanggalAwal)->addMonths($masaBulan);
    }

    public static function calculateTarif($masaBulan)
    {
        $tarifPerMil = 3.88;
        return ($masaBulan / 12) * $tarifPerMil;
    }

    public static function calculatePremi($up, $tarif)
    {
        return ($up * $tarif) / 1000;
    }

    public static function createEntry($data, $userInput)
    {
        $nomorPeserta = self::generateNomorPeserta();
        $tanggalAwal = Carbon::now();
        $tanggalAkhir = self::calculateTanggalAkhir($tanggalAwal, $data['tpprd_masa_bulan']);
        $umur = self::calculateUmur($data['tpprd_tanggal_lahir']);
        $tarif = self::calculateTarif($data['tpprd_masa_bulan']);
        $premi = self::calculatePremi($data['tpprd_up'], $tarif);

        return self::create([
            'tpprd_nomor_peserta' => $nomorPeserta,
            'tpprd_nama' => $data['tpprd_nama'],
            'tpprd_tanggal_lahir' => $data['tpprd_tanggal_lahir'],
            'tpprd_umur' => $umur,
            'tpprd_bank' => $data['tpprd_bank'],
            'tpprd_tanggal_awal' => $tanggalAwal,
            'tpprd_masa_bulan' => $data['tpprd_masa_bulan'],
            'tpprd_tanggal_akhir' => $tanggalAkhir,
            'tpprd_up' => $data['tpprd_up'],
            'tpprd_tarif' => $tarif,
            'tpprd_premi' => $premi,
            'tpprd_user_input' => $userInput,
            'tpprd_date_input' => Carbon::now(),
        ]);
    }

    public function updateEntry($data)
    {
        $tanggalAkhir = self::calculateTanggalAkhir($this->tpprd_tanggal_awal, $data['tpprd_masa_bulan']);
        $umur = self::calculateUmur($data['tpprd_tanggal_lahir']);
        $tarif = self::calculateTarif($data['tpprd_masa_bulan']);
        $premi = self::calculatePremi($data['tpprd_up'], $tarif);

        $this->update([
            'tpprd_nama' => $data['tpprd_nama'],
            'tpprd_tanggal_lahir' => $data['tpprd_tanggal_lahir'],
            'tpprd_umur' => $umur,
            'tpprd_bank' => $data['tpprd_bank'],
            'tpprd_masa_bulan' => $data['tpprd_masa_bulan'],
            'tpprd_tanggal_akhir' => $tanggalAkhir,
            'tpprd_up' => $data['tpprd_up'],
            'tpprd_tarif' => $tarif,
            'tpprd_premi' => $premi,
        ]);

        return $this;
    }
}