<div class="modal fade" id="item_loan_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
	role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Edit Data Peminjaman</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form id="edit_form" method="POST">
					@csrf
					@method('PUT')
					
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="edit_borrower_name">Nama Peminjam</label>
								<input type="text" class="form-control @error('borrower_name', 'update') is-invalid @enderror"
									name="borrower_name" id="edit_borrower_name" value="{{ old('borrower_name') }}" placeholder="Masukan nama peminjam..">
								@error('borrower_name', 'update')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="edit_phone_number">Nomor HP</label>
								<input type="text" class="form-control @error('phone_number', 'update') is-invalid @enderror"
									name="phone_number" id="edit_phone_number" value="{{ old('phone_number') }}" placeholder="Masukan nomor HP..">
								@error('phone_number', 'update')
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
								<label for="edit_item_name">Nama Barang</label>
								<input type="text" class="form-control @error('item_name', 'update') is-invalid @enderror"
									name="item_name" id="edit_item_name" value="{{ old('item_name') }}" placeholder="Masukan nama barang..">
								@error('item_name', 'update')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="edit_item_code">Kode Barang</label>
								<input type="text" class="form-control @error('item_code', 'update') is-invalid @enderror"
									name="item_code" id="edit_item_code" value="{{ old('item_code') }}" placeholder="Masukan kode barang..">
								@error('item_code', 'update')
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
								<label for="edit_loan_date">Tanggal Peminjaman</label>
								<input type="date" class="form-control @error('loan_date', 'update') is-invalid @enderror"
									name="loan_date" id="edit_loan_date" value="{{ old('loan_date') }}">
								@error('loan_date', 'update')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="edit_return_date">Tanggal Pengembalian</label>
								<input type="date" class="form-control @error('return_date', 'update') is-invalid @enderror"
									name="return_date" id="edit_return_date" value="{{ old('return_date') }}">
								@error('return_date', 'update')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="edit_notes">Catatan</label>
								<textarea class="form-control @error('notes', 'update') is-invalid @enderror" name="notes" id="edit_notes"
									style="height: 100px;" placeholder="Masukan catatan (opsional)..">{{ old('notes') }}</textarea>
								@error('notes', 'update')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-warning">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
