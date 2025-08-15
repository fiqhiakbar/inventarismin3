<?php

namespace App\Http\Controllers;

use App\Commodity;
use App\ItemLoan;
use App\Exports\ItemLoansExport;
use App\Http\Requests\StoreItemLoanRequest;
use App\Http\Requests\UpdateItemLoanRequest;
use App\Imports\ItemLoansImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemLoanController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ItemLoan::class, 'item_loan');
    }

    /**
     * Display a listing of barang masuk.
     */
    public function barangMasuk()
    {
        $query = ItemLoan::barangMasuk();
        
        $query->when(request()->filled('search'), function ($q) {
            $search = request('search');
            return $q->where(function($subQuery) use ($search) {
                $subQuery->where('borrower_name', 'like', "%{$search}%")
                         ->orWhere('phone_number', 'like', "%{$search}%")
                         ->orWhere('item_name', 'like', "%{$search}%")
                         ->orWhere('item_code', 'like', "%{$search}%");
            });
        });

        $item_loans = $query->latest()->get();
        $commodities = Commodity::orderBy('name', 'ASC')->get();

        return view(
            'item-loans.barang-masuk',
            compact('item_loans', 'commodities')
        );
    }

    /**
     * Display a listing of barang keluar.
     */
    public function barangKeluar()
    {
        $query = ItemLoan::barangKeluar();
        
        $query->when(request()->filled('search'), function ($q) {
            $search = request('search');
            return $q->where(function($subQuery) use ($search) {
                $subQuery->where('borrower_name', 'like', "%{$search}%")
                         ->orWhere('phone_number', 'like', "%{$search}%")
                         ->orWhere('item_name', 'like', "%{$search}%")
                         ->orWhere('item_code', 'like', "%{$search}%");
            });
        });

        $item_loans = $query->latest()->get();
        $commodities = Commodity::orderBy('name', 'ASC')->get();

        return view(
            'item-loans.barang-keluar',
            compact('item_loans', 'commodities')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemLoanRequest $request)
    {
        ItemLoan::create($request->validated());

        $status = $request->status;
        $route = $status === 'masuk' ? 'peminjaman.barang-masuk' : 'peminjaman.barang-keluar';
        
        return to_route($route)->with('success', 'Data peminjaman berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemLoan $item_loan)
    {
        return response()->json($item_loan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemLoanRequest $request, ItemLoan $item_loan)
    {
        $item_loan->update($request->validated());

        $status = $item_loan->status;
        $route = $status === 'masuk' ? 'peminjaman.barang-masuk' : 'peminjaman.barang-keluar';
        
        return to_route($route)->with('success', 'Data peminjaman berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemLoan $item_loan)
    {
        $item_loan->delete();

        $status = $item_loan->status;
        $route = $status === 'masuk' ? 'peminjaman.barang-masuk' : 'peminjaman.barang-keluar';
        
        return to_route($route)->with('success', 'Data peminjaman berhasil dihapus!');
    }

    /**
     * Export item loans data to Excel.
     */
    public function export($status)
    {
        $this->authorize('export peminjaman');

        $filename = $status === 'masuk' ? 'daftar-barang-masuk' : 'daftar-barang-keluar';
        
        return Excel::download(
            new ItemLoansExport($status), 
            $filename . '-' . date('d-m-Y') . '.xlsx'
        );
    }

    /**
     * Import item loans data from Excel.
     */
    public function import(Request $request, $status)
    {
        $this->authorize('import peminjaman');

        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new ItemLoansImport($status), $request->file('file'));

        $route = $status === 'masuk' ? 'peminjaman.barang-masuk' : 'peminjaman.barang-keluar';
        
        return to_route($route)->with('success', 'Data peminjaman berhasil diimpor!');
    }
}
