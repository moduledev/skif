@extends('admin.layouts.app')
@section('page-title')
    <title>Skif -</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('libs/admin/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('libs/admin/adminlte/plugins/ekko-lightbox/ekko-lightbox.css')}}">
@endsection
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Администратор {{$admin->name}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                {{ Breadcrumbs::render('admin-show', $admin->name) }}

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Основная информация:</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"> <i class="fas fa-user"></i> <span class="font-weight-bold">Имя администратора:</span> {{$admin->fullName}} </li>
                            <li class="list-group-item"> <i class="fas fa-envelope"></i> <span class="font-weight-bold">E-mail:</span> {{$admin->email}} </li>
                            <li class="list-group-item"> <i class="fas fa-unlock"></i> <span class="font-weight-bold">Статус учетной записи:</span> {{$admin->activate === 'on' ? 'активирована' : 'не активирована'}} </li>
                            <li class="list-group-item"> <i class="fas fa-phone"></i> <span class="font-weight-bold">Телефон:</span> {{$admin->phone}} </li>
                            <li class="list-group-item"><i class="fas fa-plus-square"></i> <span class="font-weight-bold">Роли администратора:</span>
                                <ul class="">
                                    @foreach($admin->roles as $role)
                                        <li class="">{{$role->slug}}</li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Фото администратора:</h3>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        @if($admin->image_path)
                            <a href="{{asset('storage/'. $admin->image_path)}}" class="text-center" data-toggle="lightbox" data-title="Фото администратора" data-footer="{{$admin->fullName}}">
                                <img src="{{asset('storage/'. $admin->image_path)}}"
                                     class="img-responsive img-rounded admin-form_avatar-img" alt=""></a>
                        @else
                            <img src="{{asset('img/NoFoto.png')}}"
                                 class="img-responsive img-rounded admin-form_avatar-img" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('scripts')
    <script src="{{ asset('libs/admin/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/admin/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{asset('libs/admin/adminlte/plugins/ekko-lightbox/ekko-lightbox.js')}}"></script>
    <script src="https://unpkg.com/imask"></script>

    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
        // $(document).ready(function () {
        //     let phoneInput = IMask(
        //         document.getElementById('phoneAdmin'),
        //         {
        //             mask: '+{38}(000)000-00-00',
        //             lazy: false,
        //             placeholderChar: '_'
        //         }
        //     );
        //     $('#adminsList').DataTable({
        //         "language": {
        //             "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
        //         },
        //     });
        // });
    </script>
@endsection
