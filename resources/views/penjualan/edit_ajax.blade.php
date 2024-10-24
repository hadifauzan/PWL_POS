@empty($penjualan)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/penjualan') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/penjualan/' . $penjualan->penjualan_id . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Penjual</label>
                        <select name="penjual_id" id="penjual_id" class="form-control" required>
                            <option value="">- Pilih Pengguna -</option>
                            @foreach ($penjualan as $pj)
                                <option {{ $pj->user_id == $p->user_id ? 'selected' : '' }} value="{{ $pj->penjual_id }}">
                                    {{ $pj->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-supplier_id" class="error-text form-text textdanger"></small>
                    </div>
                    <div class="form-group">
                        <label>Pembeli</label>
                        <select name="pembeli" id="pembeli" class="form-control" required>
                        </select>
                        <small id="error-pembeli" class="error-text form-text textdanger"></small>
                    </div>
                    <div class="form-group">
                        <label>Penjualan Kode/label>
                        <select name="penjualan_kode" id="penjualan_kode" class="form-control" required>
                            <option value="">- Pilih User -</option>
                        </select>
                        <small id="error-penjualan_kode" class="error-text form-text textdanger"></small>
                    </div>
                    <div class="form-group">
                        <label>Penjualan Tanggal</label>
                        <input value="{{ $pj->penjualan_tanggal }}" type="datetime-local" name="penjualan_tanggal" id="stok_tanggal"
                            class="form-control" required>
                        <small id="error-penjualan_tanggal" class="error-text form-text textdanger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btnwarning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#form-edit").validate({
                rules: {
                    user_id: {
                        required: true,
                        number: true
                    },
                    pembeli: {
                        required: true,
                        minlength: 3;
                        maxlength: 50;
                    },
                    penjualan_kode: {
                        required: true,
                        minlength: 3;
                        maxlength: 20;
                    },
                    penjualan_tanggal: {
                        required: true,
                        number: true;
                    },
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataStok.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    @endempty
