@extends('admin.layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    @livewireStyles
@endsection
@section('page-title')
    <title>Skif - </title>
@endsection
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Изменить данные администратора</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">

                {{ Breadcrumbs::render('admin-edit', $admin->name) }}

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <livewire:edit-admin :admin="$admin"/>
@endsection

@section('scripts')
    @livewireScripts
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="https://unpkg.com/imask"></script>

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            let phoneInput = IMask(--}}
{{--                document.getElementById('phoneAdmin'),--}}
{{--                {--}}
{{--                    mask: '+{38}(000)000-00-00',--}}
{{--                    lazy: false,--}}
{{--                    placeholderChar: '_'--}}
{{--                }--}}
{{--            );--}}
{{--            $('#adminsList').DataTable({--}}
{{--                "language": {--}}
{{--                    "url": "http://cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"--}}
{{--                },--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
