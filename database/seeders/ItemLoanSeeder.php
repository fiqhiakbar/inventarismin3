<?php

namespace Database\Seeders;

use App\ItemLoan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemLoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itemLoans = [
            [
                'borrower_name' => 'Ahmad Rizki',
                'phone_number' => '081234567890',
                'item_name' => 'Laptop Asus',
                'item_code' => 'LP001',
                'loan_date' => '2024-12-19',
                'return_date' => null,
                'status' => 'masuk',
                'notes' => 'Peminjaman untuk keperluan presentasi'
            ],
            [
                'borrower_name' => 'Siti Nurhaliza',
                'phone_number' => '081234567891',
                'item_name' => 'Proyektor Epson',
                'item_code' => 'PR001',
                'loan_date' => '2024-12-18',
                'return_date' => '2024-12-19',
                'status' => 'keluar',
                'notes' => 'Sudah dikembalikan dalam kondisi baik'
            ],
            [
                'borrower_name' => 'Budi Santoso',
                'phone_number' => '081234567892',
                'item_name' => 'Speaker JBL',
                'item_code' => 'SP001',
                'loan_date' => '2024-12-17',
                'return_date' => null,
                'status' => 'masuk',
                'notes' => 'Untuk acara sekolah'
            ]
        ];

        foreach ($itemLoans as $itemLoan) {
            ItemLoan::create($itemLoan);
        }
    }
}
