@extends('layout.welcome')

@push('before-style')
    <link href="{{ asset('v1/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Email Subscription</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Index</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Email</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('email.store') }}" id="emailForm">
                        @csrf
                        <div class="form-group row align-items-center">
                            <label for="email" class="col-md-1 col-form-label">Email</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="mail" id="email" placeholder="email ..." required>
                                <!-- Error message will be displayed here -->
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Subscribe</button>
                            </div>
                        </div>
                    </form>

                    @if (session('success-email'))
                        <div class="alert alert-success">
                            <i class="fa fa-check"></i> <strong>{{ session('success-email') }}</strong>
                        </div>
                    @endif

                    @if (session('error-email'))
                        <div class="alert alert-danger">
                            <i class="fa fa-times"></i> <strong>{{ session('error-email') }}</strong>
                        </div>
                    @endif
                    <br>

                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive-sm" id="dataEmail">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <form action="" method="POST" id="deleteForm">
                @csrf
                @method("DELETE")
                <input type="submit" value="Hapus" style="display: none">
            </form>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="text" class="form-control" name="email" id="editEmail" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection

@push('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="{{ asset('v1/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>

    <script>
        $(function() {
            var table = $('#dataEmail').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                paging: true,
                ajax: '{{ route('email.data') }}',
                language: {
                    paginate: {
                        next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                    }
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $("#emailForm").validate({
                rules: {
                    mail: {
                        required: true,
                        email: true,
                        minlength: 10
                    }
                },
                messages: {
                    mail: {
                        required: "Email harus diisi!",
                        email: "Format email tidak valid!",
                        minlength: "Email harus memiliki minimal 10 karakter!"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('text-danger');
                    element.closest('.form-group').append(error);
                },
                success: function (label) {
                    label.addClass('text-success').text('Valid!');
                }
            });

            $("#updateForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        minlength: 10
                    }
                },
                messages: {
                    email: {
                        required: "Email harus diisi!",
                        email: "Format email tidak valid!",
                        minlength: "Email harus memiliki minimal 10 karakter!"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('text-danger');
                    element.closest('.form-group').append(error);
                },
                success: function (label) {
                    label.addClass('text-success').text('Valid!');
                }
            });

            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                $('#deleteForm').attr('action', '/email/' + id); // Set the delete URL
                if (confirm('Apakah Anda yakin ingin menghapus email ini?')) {
                    $('#deleteForm').submit();
                }
            });

            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var email = $(this).data('email');

                $('#editEmail').val(email);
                $('#updateForm').attr('action', '/email/' + id);
                $('#editModal').modal('show');
            });

            $("#updateForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        minlength: 10
                    }
                },
                messages: {
                    email: {
                        required: "Email harus diisi!",
                        email: "Format email tidak valid!",
                        minlength: "Email harus memiliki minimal 10 karakter!"
                    }
                },
                errorElement: 'span',
                errorPlacement: function ( error, element) {
                    error.addClass('text-danger');
                    element.closest('.form-group').append(error); // Menempatkan error di dalam form-group di modal
                },
                success: function (label) {
                    label.addClass('text-success').text('Valid!');
                }
            });

            $('#editModal').on('hidden.bs.modal', function () {
                $('#updateForm')[0].reset(); // Reset form ketika modal ditutup
                $('#updateForm').validate().resetForm(); // Reset validasi error
            });

        });
    </script>
@endpush


