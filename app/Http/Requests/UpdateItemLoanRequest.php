<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemLoanRequest extends FormRequest
{
    protected $errorBag = 'update';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'borrower_name' => 'required|string|min:3|max:255',
            'phone_number' => 'required|string|min:10|max:15',
            'item_name' => 'required|string|min:3|max:255',
            'item_code' => 'required|string|min:3|max:255',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:loan_date',
            'status' => 'required|in:masuk,keluar',
            'notes' => 'nullable|string|min:3|max:1000',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'borrower_name.required' => 'Kolom nama peminjam wajib diisi!',
            'borrower_name.string' => 'Kolom nama peminjam harus berupa karakter!',
            'borrower_name.min' => 'Kolom nama peminjam minimal :min karakter!',
            'borrower_name.max' => 'Kolom nama peminjam maksimal :max karakter!',

            'phone_number.required' => 'Kolom nomor HP wajib diisi!',
            'phone_number.string' => 'Kolom nomor HP harus berupa karakter!',
            'phone_number.min' => 'Kolom nomor HP minimal :min karakter!',
            'phone_number.max' => 'Kolom nomor HP maksimal :max karakter!',

            'item_name.required' => 'Kolom nama barang wajib diisi!',
            'item_name.string' => 'Kolom nama barang harus berupa karakter!',
            'item_name.min' => 'Kolom nama barang minimal :min karakter!',
            'item_name.max' => 'Kolom nama barang maksimal :max karakter!',

            'item_code.required' => 'Kolom kode barang wajib diisi!',
            'item_code.string' => 'Kolom kode barang harus berupa karakter!',
            'item_code.min' => 'Kolom kode barang minimal :min karakter!',
            'item_code.max' => 'Kolom kode barang maksimal :max karakter!',

            'loan_date.required' => 'Kolom tanggal peminjaman wajib diisi!',
            'loan_date.date' => 'Kolom tanggal peminjaman harus berupa tanggal yang valid!',

            'return_date.date' => 'Kolom tanggal pengembalian harus berupa tanggal yang valid!',
            'return_date.after_or_equal' => 'Tanggal pengembalian harus sama dengan atau setelah tanggal peminjaman!',

            'status.required' => 'Kolom status wajib diisi!',
            'status.in' => 'Kolom status yang dipilih tidak valid!',

            'notes.string' => 'Kolom catatan harus berupa teks!',
            'notes.min' => 'Kolom catatan minimal :min karakter!',
            'notes.max' => 'Kolom catatan maksimal :max karakter!',
        ];
    }
}
