<?php

namespace App\Imports;

use App\ItemLoan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ItemLoansImport implements ToModel, WithHeadingRow, WithUpserts
{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ItemLoan([
            'borrower_name' => $row['nama_peminjam'],
            'phone_number' => $row['nomor_hp'],
            'item_name' => $row['nama_barang'],
            'item_code' => $row['kode_barang'],
            'loan_date' => $this->parseDate($row['tanggal_peminjaman']),
            'return_date' => $this->status === 'keluar' ? $this->parseDate($row['tanggal_pengembalian']) : null,
            'status' => $this->status,
            'notes' => $row['catatan'] ?? null,
        ]);
    }

    /**
     * Parse date from various formats.
     */
    protected function parseDate($date)
    {
        if (is_numeric($date)) {
            // Handle Excel date format
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)->format('Y-m-d');
        }
        
        return \Carbon\Carbon::parse($date)->format('Y-m-d');
    }

    /**
     * Specify the unique column used for upsert operations.
     */
    public function uniqueBy()
    {
        return ['item_code', 'borrower_name', 'loan_date'];
    }
}
