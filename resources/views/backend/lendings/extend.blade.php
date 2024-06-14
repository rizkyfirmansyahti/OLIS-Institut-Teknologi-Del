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
                        <tr>
                            <td class="text-muted">Tanggal Akhir Perpanjangan:</td>
                            <td><input type="text" class="form-control" name="extended_return_date"
                                    id="extended_return_date" value="{{ $lending->extended_return_date }}"></td>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)"
                onclick="showConfirmationDialog('Perpanjang Buku', 'Apakah Anda yakin ingin memperpanjangan peminjaman Buku ini?', 'warning', 'Ya, perpanjang', function(result) {
                    if (result.isConfirmed) {
                        handleAction('{{ route('backend.lendings.extend', ['type' => $type, 'lending' => encodeId($lending->id)]) }}', 'POST', 'Peminjaman berhasil diperpanjang', 'Gagal memperpanjang peminjaman', {
                            extended_return_date: $('#extended_return_date').val()
                        }, null, () => {
                            window.location.reload();
                        });
                    }
                })"
                class="btn btn-primary">Perpanjang</a>
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let maxDate = new Date();
        let role = @json($lending->user->getRoleNames()->first());
        if (role == 'student') {
            maxDate = new Date(maxDate.setDate(maxDate.getDate() + 7));
        } else {
            maxDate = new Date(maxDate.setDate(maxDate.getDate() + 14));
        }
        $('#extended_return_date').flatpickr({
            enableTime: false,
            minDate: new Date(),
            maxDate: maxDate,
        });
    });
</script>
