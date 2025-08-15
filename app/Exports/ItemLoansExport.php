<?php

namespace App\Exports;

use App\ItemLoan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemLoansExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ItemLoan::where('status', $this->status)->get();
    }

    /**
     * Specify the headings for the exported file.
     */
    public function headings(): array
    {
        $statusText = $this->status === 'masuk' ? 'Masuk' : 'Keluar';
        
        return [
            'No',
            'Kode Barang',
            'Nama Barang',
            'Nama Peminjam',
            'Nomor HP',
            'Tanggal ' . $statusText,
            'Catatan',
        ];
    }

    /**
     * Map each row of the collection to an array for export.
     */
    public function map($row): array
    {
        static $i = 0;

        $i++;
        
        $dateColumn = $this->status === 'masuk' ? 'loan_date' : 'return_date';
        $dateValue = $row->$dateColumn ? $row->indonesian_format_date($row->$dateColumn) : '-';
        
        return [
            $i,
            $row->item_code,
            $row->item_name,
            $row->borrower_name,
            $row->phone_number,
            $dateValue,
            $row->notes ?? '-',
        ];
    }
}
