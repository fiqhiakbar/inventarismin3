<div class="modal fade" id="excel_menu" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
	aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Import Excel {{ $status === 'masuk' ? 'Peminjaman' : 'Pengembalian' }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form action="{{ route('peminjaman.import', $status) }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="file">Pilih File Excel</label>
						<input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="file"
							accept=".xlsx,.xls">
						@error('file')
						<div class="d-block invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>

					<div class="alert alert-info">
						<h6>Format Excel yang dibutuhkan:</h6>
						<ul class="mb-0">
							<li><strong>nama_peminjam</strong> - Nama peminjam barang</li>
							<li><strong>nomor_hp</strong> - Nomor HP peminjam</li>
							<li><strong>nama_barang</strong> - Nama barang yang dipinjam</li>
							<li><strong>kode_barang</strong> - Kode barang</li>
							<li><strong>tanggal_peminjaman</strong> - Tanggal peminjaman</li>
							@if($status === 'keluar')
							<li><strong>tanggal_pengembalian</strong> - Tanggal pengembalian</li>
							@endif
							<li><strong>catatan</strong> - Catatan (opsional)</li>
						</ul>
						
						<hr>
						<p class="mb-0">
							<strong>Download Template:</strong>
							@if($status === 'masuk')
								<a href="{{ asset('template-peminjaman-barang-masuk.xlsx') }}" class="btn btn-sm btn-outline-primary">
									<i class="fas fa-download"></i> Template Peminjaman
								</a>
							@else
								<a href="{{ asset('template-peminjaman-barang-keluar.xlsx') }}" class="btn btn-sm btn-outline-primary">
									<i class="fas fa-download"></i> Template Pengembalian
								</a>
							@endif
						</p>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary">Import</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
