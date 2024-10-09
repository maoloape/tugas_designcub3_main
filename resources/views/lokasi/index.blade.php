@extends('layout.welcome')

@push('before-style')
    <link href="{{ asset('v1/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Find Location</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Index</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Keseluruhan Lokasi</h4>
                    <form id="filter-form" method="post" action="/report-damage/export_excel">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <select id="provinsiFilter" class="select-dropdown form-control" name="provinsi">
                                    <option value="all" selected>Select Province</option>
                                    @foreach ($data as $provinsi)
                                        <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select id="kotaFilter" class="select-dropdown form-control" name="kota">
                                    <option value="all" selected>Select City</option>
                                    @foreach ($data_city as $kota)
                                        <option value="{{ $kota->id }}">{{ $kota->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select id="kabupatenFilter" class="select-dropdown form-control" name="kabupaten">
                                    <option value="all" selected>Select District</option>
                                    @foreach ($data_district as $kabupaten)
                                        <option value="{{ $kabupaten->id }}">{{ $kabupaten->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select id="subdistrictFilter" class="select-dropdown form-control" name="subdistrict">
                                    <option value="all" selected>Select Subdistrict</option>
                                    @foreach ($data_subdistrict as $desa)
                                        <option value="{{ $desa->id }}">{{ $desa->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive-sm" id="dataSpot">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Province</th>
                                    <th>City</th>
                                    <th>District</th>
                                    <th>Subdistrict</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="{{ asset('v1/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>

    <script>
        $(function() {
            var table = $('#dataSpot').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                paging: true,
                ajax: {
                    url: '{{ route('data-lokasi') }}',
                    data: function(d) {
                        d.provinsi = $('#provinsiFilter').val();
                        d.kota = $('#kotaFilter').val();
                        d.kabupaten = $('#kabupatenFilter').val();
                        d.subdistrict = $('#subdistrictFilter').val();
                    }
                },
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
                        data: 'province_name'
                    },
                    {
                        data: 'city_name'
                    },
                    {
                        data: 'district_name'
                    },
                    {
                        data: 'subdistrict_name'
                    }
                ]
            });

            $('#provinsiFilter').change(function() {
                var province_id = $(this).val();
                $('#kotaFilter').empty().append('<option value="all">Select City</option>');
                $('#kabupatenFilter').empty().append('<option value="all">Select District</option>');
                $('#subdistrictFilter').empty().append('<option value="all">Select Subdistrict</option>');

                if (province_id) {
                    $.ajax({
                        url: '/get-cities',
                        type: 'GET',
                        data: { province_id: province_id },
                        success: function(data) {
                            $.each(data, function(key, city) {
                                $('#kotaFilter').append('<option value="' + city.id + '">' + city.name + '</option>');
                            });
                        }
                    });
                }
                table.draw();
            });

            $('#kotaFilter').change(function() {
                var city_id = $(this).val();
                $('#kabupatenFilter').empty().append('<option value="all">Select District</option>');
                $('#subdistrictFilter').empty().append('<option value="all">Select Subdistrict</option>');

                if (city_id) {
                    $.ajax({
                        url: '/get-districts',
                        type: 'GET',
                        data: { city_id: city_id },
                        success: function(data) {
                            $.each(data, function(key, district) {
                                $('#kabupatenFilter').append('<option value="' + district.id + '">' + district.name + '</option>');
                            });
                        }
                    });
                }
                table.draw();
            });

            $('#kabupatenFilter').change(function() {
                var district_id = $(this).val();
                $('#subdistrictFilter').empty().append('<option value="all">Select Subdistrict</option>');

                if (district_id) {
                    $.ajax({
                        url: '/get-villages',
                        type: 'GET',
                        data: { district_id: district_id },
                        success: function(data) {
                            $.each(data, function(key, village) {
                                $('#subdistrictFilter').append('<option value="' + village.id + '">' + village.name + '</option>');
                            });
                        }
                    });
                }
                table.draw();
            });

            $('#subdistrictFilter').change(function() {
                table.draw();
            });

            function updateFilter() {
                table.draw();
            }

            $('#provinsiFilter, #kotaFilter, #kabupatenFilter, #subdistrictFilter').change(updateFilter);
        });
        </script>



@endpush
