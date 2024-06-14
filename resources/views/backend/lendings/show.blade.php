<!-- Modal Detail Peminjaman -->
<div class="modal-dialog modal-dialog-centered mw-650px">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Peminjaman {{ $type == 'book' ? 'Buku' : 'CD/DVD' }}</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body p-0">
            <div class="row">
                <div class="col-12">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted w-25">ID Anggota:</td>
                            <td>{{ $lending->user->id_member }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Nama Anggota:</td>
                            <td>{{ $lending->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jurusan:</td>
                            <td>{{ $lending->user->major }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">ID {{ $type == 'book' ? 'Buku' : 'CD/DVD' }}:</td>
                            <td>{{ $type == 'book' ? $lending->book->code : $lending->cd_dvd->code }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">{{ $type == 'book' ? 'Judul Buku' : 'Judul CD/DVD' }}:</td>
                            <td>{{ $type == 'book' ? $lending->book->title : $lending->cd_dvd->title }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal Pinjam:</td>
                            <td>{{ $lending->lending_date }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal Pengembalian:</td>
                            <td>{{ $lending->return_date }}</td>
                        </tr>
                        @if ($lending->extend_date)
                            <tr>
                                <td class="text-muted">Tanggal Akhir Perpanjangan:</td>
                                <td>{{ $lending->extend_date }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="text-muted">Denda:</td>
                            <td id="fine"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if ($type == 'book')
                <a href="javascript:void(0)"
                    onclick="openModal('{{ route('backend.lendings.extend', ['type' => $type, 'lending' => encodeId($lending->id)]) }}', '#modalListResult')"class="btn btn-primary">Perpanjang</a>
                <a href="javascript:void(0)"
                    onclick="showConfirmationDialog('Kembalikan Buku', 'Apakah Anda yakin ingin mengembalikan Buku ini?', 'warning', 'Ya, kembalikan', function(result) {
                    if (result.isConfirmed) {
                        handleAction('{{ route('backend.lendings.return', ['type' => $type, 'lending' => encodeId($lending->id)]) }}', 'PUT', 'Peminjaman berhasil dikembalikan', 'Gagal mengembalikan peminjaman', null, null, () => {
                            $('#modalListResult').modal('hide');
                            lendingTable.ajax.reload();
                            table.ajax.reload();
                        });
                    }
                })"
                    class="btn btn-success">Kembalikan</a>
            @endif
            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var returnDate = '{{ $lending->extend_date ? $lending->extend_date : $lending->return_date }}';
        var now = new Date();
        var returnDateObj = new Date(returnDate);
        var fine = 0;
        if (now > returnDateObj) {
            var diff = now - returnDateObj;
            var days = Math.floor(diff / (1000 * 60 * 60 * 24));
            fine = days * 2000;
        }
        var fineText = fine > 0 ? 'Rp. ' + fine.toLocaleString('id-ID') : 'Tidak ada denda';
        $('#fine').text(fineText);
    });
</script>
