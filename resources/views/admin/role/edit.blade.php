@extends('admin.layouts.app')
@section('styles')
@endsection
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Изменить роль</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">

                {{ Breadcrumbs::render('role-edit', $role->name) }}

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Основная информация:</h3>
                    </div>
                    <form action="{{route('role.update', $role->id)}}" method="POST" class="admin-form"
                          enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="slug" value="{{$role->slug}}"
                                       class="form-control @error('slug') is-invalid @enderror"
                                       placeholder="Название роли"
                                       required autofocus>
                                @error('slug')
                                <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="d-flex flex-row">
                                @foreach($permissions->chunk(7) as $chunk)
                                    <ul class="">
                                        @foreach($chunk as $permission)
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input " type="checkbox"
                                                   id="{{$permission->id}}" name="permissions[]" value="{{$permission->name}}"
                                                   @if($rolePermissions->contains('name',$permission->name))checked
                                                @endif>
                                            <label for="{{$permission->id}}"
                                                   class="custom-control-label">{{$permission->name}}</label>
                                        </div>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Изменить</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-12 col-md-12">
                <form action="{{route('role.delete', $role->id)}}"  method="POST">
                    @csrf
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger">Удалить роль <i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection
@section('scripts')

@endsection
