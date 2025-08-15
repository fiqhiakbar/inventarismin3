



<div class="modal fade" id="item_loan_create_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
	role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Tambah Data {{ $status === 'masuk' ? 'Peminjaman' : 'Pengembalian' }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form action="{{ route('peminjaman.store') }}" method="POST">
					@csrf
					<input type="hidden" name="status" value="{{ $status }}">
					
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="borrower_name">Nama Peminjam</label>
								<input type="text" class="form-control @error('borrower_name', 'store') is-invalid @enderror"
									name="borrower_name" id="borrower_name" value="{{ old('borrower_name') }}" placeholder="Masukan nama peminjam..">
								@error('borrower_name', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="phone_number">Nomor HP</label>
								<input type="text" class="form-control @error('phone_number', 'store') is-invalid @enderror"
									name="phone_number" id="phone_number" value="{{ old('phone_number') }}" placeholder="Masukan nomor HP..">
								@error('phone_number', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="item_name">Nama Barang</label>
								<input type="text" class="form-control @error('item_name', 'store') is-invalid @enderror"
									name="item_name" id="item_name" value="{{ old('item_name') }}" placeholder="Masukan nama barang..">
								@error('item_name', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="item_code">Kode Barang</label>
								<input type="text" class="form-control @error('item_code', 'store') is-invalid @enderror"
									name="item_code" id="item_code" value="{{ old('item_code') }}" placeholder="Masukan kode barang..">
								@error('item_code', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="loan_date">{{ $status === 'masuk' ? 'Tanggal Peminjaman' : 'Tanggal Peminjaman' }}</label>
								<input type="date" class="form-control @error('loan_date', 'store') is-invalid @enderror"
									name="loan_date" id="loan_date" value="{{ old('loan_date') }}">
								@error('loan_date', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						@if($status === 'keluar')
						<div class="col-lg-6">
							<div class="form-group">
								<label for="return_date">Tanggal Pengembalian</label>
								<input type="date" class="form-control @error('return_date', 'store') is-invalid @enderror"
									name="return_date" id="return_date" value="{{ old('return_date') }}">
								@error('return_date', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						@endif
					</div>

					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="notes">Catatan</label>
								<textarea class="form-control @error('notes', 'store') is-invalid @enderror" name="notes" id="notes"
									style="height: 100px;" placeholder="Masukan catatan (opsional)..">{{ old('notes') }}</textarea>
								@error('notes', 'store')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-success">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
