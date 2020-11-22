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
                <h1 class="m-0 text-dark">Все роли</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">

                {{ Breadcrumbs::render('roles') }}

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
                        <h3 class="card-title">Доступные роли:</h3>
                    </div>
                    <div class="card-body">
                        <table id="adminsList" class="table table-bordered table-hover dataTable admins-table"
                               role="grid"
                               aria-describedby="example2_info">
                            <thead>
                            <tr role="row" class="text-center">
                                <th>Название роли</th>
                                <th>Операция</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->name}}</td>

                                    <td class="text-center">
                                        <a href="{{route('role.show', $role->id)}}">
                                            <button class="btn btn-success"><i class="fas fa-eye"></i></button>
                                        </a>
                                        <a href="{{route('role.edit', $role->id)}}">
                                            <button class="btn btn-primary "><i class="fas fa-user-edit"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="text-center">
                                <th rowspan="1" colspan="1">Название роли</th>
                                <th rowspan="1" colspan="1">Операция</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection
@section('scripts')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#adminsList').DataTable({
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
                },
            });
        });
    </script>
@endsection
