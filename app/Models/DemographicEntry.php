<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemographicEntry extends Model
{
    protected $fillable = ['nama', 'kategori', 'data_spesifik'];
    public const KATEGORI = [
        'penduduk' => [
            'label' => 'Jumlah Penduduk',
            'unit' => 'Jiwa',
            'field_type' => 'number',
            'field_label' => 'Jumlah Anggota Keluarga (Jiwa)',
            'agregasi' => 'sum',
        ],
        'nelayan' => [
            'label' => 'Jumlah Nelayan',
            'unit' => 'Keluarga Nelayan',
            'field_type' => 'text',
            'field_label' => 'Keterangan (mis. Alamat/Kelompok)',
            'agregasi' => 'count',
        ],
        'pendapatan_nelayan' => [
            'label' => 'Pendapatan Nelayan',
            'unit' => '/bln',
            'field_type' => 'number',
            'field_label' => 'Pendapatan per Bulan (Rp)',
            'agregasi' => 'avg_rupiah',
        ],
        'anggota_smc' => [
            'label' => 'Anggota SMC',
            'unit' => 'Keluarga',
            'field_type' => 'select',
            'field_label' => 'Nama Kelompok SMC',
            'field_options' => ['Long-Econ Empowerment', 'Perna Nutri', 'Perna Cyclical', 'Perna Brand Connect'],
            'agregasi' => 'count',
        ],
        'pembudidaya_kerang_hijau' => [
            'label' => 'Pembudidaya Kerang Hijau',
            'unit' => 'Orang',
            'field_type' => 'text',
            'field_label' => 'Lokasi/Keterangan Budidaya',
            'agregasi' => 'count',
        ],
    ];

    public function getKategoriLabelAttribute(): string
    {
        return self::KATEGORI[$this->kategori]['label'] ?? $this->kategori;
    }

    public function getDataSpesifikDisplayAttribute(): string
    {
        $config = self::KATEGORI[$this->kategori] ?? null;
        if (!$config) return $this->data_spesifik;

        if ($this->kategori === 'pendapatan_nelayan') {
            return 'Rp' . number_format((float) $this->data_spesifik, 0, ',', '.') . '/bln';
        }
        if ($config['field_type'] === 'number') {
            return number_format((float) $this->data_spesifik, 0, ',', '.') . ' Jiwa';
        }
        return $this->data_spesifik;
    }

    public static function summary(): array
    {
        $result = [];
        foreach (self::KATEGORI as $key => $config) {
            $query = self::where('kategori', $key);

            $value = match ($config['agregasi']) {
                'sum'        => $query->sum('data_spesifik'),
                'count'      => $query->count(),
                'avg_rupiah' => $query->avg('data_spesifik'),
                default      => 0,
            };

            $result[$key] = [
                'label' => $config['label'],
                'unit'  => $config['unit'],
                'value' => $value > 0 ? $value : null,
            ];
        }
        return $result;
    }
}