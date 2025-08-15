<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ItemLoan extends Model
{
    protected $guarded = [];

    protected $casts = [
        'loan_date' => 'date',
        'return_date' => 'date'
    ];

    /**
     * Get the commodity associated with the loan.
     */
    public function commodity()
    {
        return $this->belongsTo(Commodity::class, 'item_code', 'item_code');
    }

    /**
     * Format a date value to Indonesian date format (dd-mm-yyyy).
     */
    public function indonesian_format_date($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    /**
     * Get the status name in Indonesian.
     */
    public function getStatusName()
    {
        return match ($this->status) {
            'masuk' => 'Barang Masuk',
            'keluar' => 'Barang Keluar',
            default => null
        };
    }

    /**
     * Scope for barang masuk (status = masuk)
     */
    public function scopeBarangMasuk($query)
    {
        return $query->where('status', 'masuk');
    }

    /**
     * Scope for barang keluar (status = keluar)
     */
    public function scopeBarangKeluar($query)
    {
        return $query->where('status', 'keluar');
    }
}
