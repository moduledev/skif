@extends('admin.layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('page-title')
    <title>Skif - </title>
@endsection
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Добавить администратора</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                {{ Breadcrumbs::render('admin-create') }}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Основная информация:</h3>
                    </div>
                    <form action="{{route('admin.store')}}" method="POST" class="admin-form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Имя администратора"
                                       required autofocus>
                                @error('name')
                                <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="surname" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Фамилия администратора"
                                       required autofocus>
                                @error('surname')
                                <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">

                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                       id="exampleInputPassword1"
                                       placeholder="Пароль" required>
                                @error('password')
                                <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" placeholder="Email" required>
                                @error('email')
                                <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phoneAdmin"
                                       value="{{ old('phone') }}" placeholder="Телефон" required>
                                @error('phone')
                                <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Фото администратора</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid  @enderror" name="image"
                                               id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Выберите
                                            файл</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Загрузить</span>
                                    </div>
                                    @error('image')
                                    <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="activate" value="on" class="custom-control-input" checked
                                       id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1">Активация аккаунта</label>
                            </div>
                            <div class="form-group w-50 mt-3">
                                <label>Доступные роли:</label>
                                <select multiple="multiple"  name="roles[]" class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Создать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection
@section('scripts')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="https://unpkg.com/imask"></script>

    <script>
        $(document).ready(function () {
            let phoneInput = IMask(
                document.getElementById('phoneAdmin'),
                {
                    mask: '+{38}(000)000-00-00',
                    lazy: false,
                    placeholderChar: '_'
                }
            );

            $('#adminsList').DataTable({
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
                },
            });
        });
    </script>
@endsection
