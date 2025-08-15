<x-layout>
	<x-slot name="title">Halaman Peminjaman</x-slot>
	<x-slot name="page_heading">Peminjaman</x-slot>

	<div class="card">
		<div class="card-body">
			@include('utilities.alert')
			<div class="d-flex justify-content-end mb-3">
				<div class="btn-group">
					@can('import peminjaman')
					<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#excel_menu">
						<i class="fas fa-fw fa-upload"></i>
						Import Excel
					</button>
					@endcan

					@can('export peminjaman')
					<form action="{{ route('peminjaman.export', 'masuk') }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-success mr-2">
							<i class="fas fa-fw fa-download"></i>
							Export Excel
						</button>
					</form>
					@endcan

					@can('tambah peminjaman')
					<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#item_loan_create_modal">
						<i class="fas fa-fw fa-plus"></i>
						Tambah Data
					</button>
					@endcan
				</div>
			</div>

			<!-- Search Bar -->
			<div class="row mb-3">
				<div class="col-md-6">
					<form method="GET" action="{{ route('peminjaman.barang-masuk') }}">
						<div class="input-group">
							<input type="text" class="form-control" name="search" placeholder="Cari nama peminjam, nomor HP, nama barang, atau kode barang..." value="{{ request('search') }}">
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit">
									<i class="fas fa-search"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="table-responsive">
				<table class="table table-striped" id="table-1">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Barang</th>
							<th>Nama Barang</th>
							<th>Nama Peminjam</th>
							<th>Nomor HP</th>
							<th>Tanggal Pinjam</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@forelse($item_loans as $index => $item_loan)
						<tr>
							<td>{{ $index + 1 }}</td>
							<td>{{ $item_loan->item_code }}</td>
							<td>{{ $item_loan->item_name }}</td>
							<td>{{ $item_loan->borrower_name }}</td>
							<td>{{ $item_loan->phone_number }}</td>
							<td>{{ $item_loan->indonesian_format_date($item_loan->loan_date) }}</td>
							<td>
								@can('ubah peminjaman')
								<button data-id="{{ $item_loan->id }}" class="btn btn-warning btn-sm edit-modal" data-toggle="modal" data-target="#item_loan_edit_modal">
									<i class="fas fa-edit"></i>
								</button>
								@endcan
								@can('hapus peminjaman')
								<form action="{{ route('peminjaman.destroy', $item_loan->id) }}" method="POST" class="d-inline delete-form">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger btn-sm delete-button">
										<i class="fas fa-trash"></i>
									</button>
								</form>
								@endcan
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="7" class="text-center">Tidak ada data</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Create Modal -->
	@include('item-loans.modal.create', ['status' => 'masuk'])

	<!-- Edit Modal -->
	@include('item-loans.modal.edit', ['status' => 'masuk'])

	<!-- Excel Import Modal -->
	@include('item-loans.modal.excel-import', ['status' => 'masuk'])

	@include('item-loans._script')
</x-layout>
