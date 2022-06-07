@extends('backend.layouts.admin')
@section('title', 'Kategori Listesi')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.category.create') }}" class="btn btn-icon"><i
                            class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Kategori Listesi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.category.list') }}">Kategori Listesi</a></div>

                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{route('admin.category.create')}}" class="btn btn-primary">Kategori Ekle</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Alt Kategori</th>
                                                <th>Kategori Adı</th>
                                                <th>Resim</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($catList as $rs)
                                                <tr>
                                                    <td>{{ $rs->id }}</td>
                                                    <td>{{\App\Http\Controllers\Backend\CategoryController::getParentsTree($rs,$rs->title)}}
                                                    </td>
                                                    <td>
                                                        {{ $rs->title }}

                                                    </td>
                                                    <td><img width="50" src="{{ $rs->image }}" alt=""></td>
                                                    <td>
                                                        @if ($rs->status == 1)
                                                            <div class="badge badge-success">Aktif</div>
                                                        @else
                                                            <div class="badge badge-danger">Pasif</div>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.category.edit', $rs->id) }}" class="btn btn-icon btn-sm btn-primary"><i
                                                                class="far fa-edit"></i></a>
                                                        <a href="#" onclick="deleteConfirmation({{ $rs->id }})"
                                                            data-id="{{ $rs->id }}"
                                                            data-action="{{ route('admin.category.delete', $rs->id) }}"
                                                            class="btn btn-icon btn-sm btn-secondary delete-confirm"><i
                                                                class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>



                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": true
            }]
        });

        function deleteConfirmation(id) {
            Swal.fire({
                title: 'Eminmisin?',
                text: "Bunu İşlemi Geri Alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Evet, Sil!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/admin/category/delete') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Başarılı!", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else {
                                swal.fire("Hata!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
    </script>
@endsection
