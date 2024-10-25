@empty($stokBarang)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data stok barang yang anda cari tidak ditemukan.
                </div>
                <a href="{{ url('/stokBarang/') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Stok Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Detail Informasi</h5>
                </div>
                <table class="table table-sm table-bordered table-striped">
                    {{-- <tr>
                        <th class="text-right col-3">ID Stok:</th>
                        <td class="col-9">{{ $stokBarang->stok_id }}</td>
                    </tr>
                    <tr> --}}
                        <th class="text-right col-3">Nama Supplier:</th>
                        <td class="col-9">{{ $stokBarang->supplier->supplier_nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nama Barang:</th>
                        <td class="col-9">{{ $stokBarang->barang->barang_nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nama User:</th>
                        <td class="col-9">{{ $stokBarang->user->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Tanggal Stok:</th>
                        <td class="col-9">{{ $stokBarang->stok_tanggal }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Jumlah Stok:</th>
                        <td class="col-9">{{ $stokBarang->stok_jumlah }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#form-delete").validate({
                rules: {},
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
                                dataStokBarang.ajax.reload(); // Update to the appropriate data table variable
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
