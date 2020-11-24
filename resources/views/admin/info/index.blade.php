@extends('admin.layouts.app')
@section('styles')
    @livewireStyles
@endsection
@section('page-title')
    <title>Skif - </title>
@endsection
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Контактные данные:</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">

                {{ Breadcrumbs::render('info') }}

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection

@section('content')
    <div class="container-fluid">

        @livewire('info', ['data'=>$data])


    </div><!-- /.container-fluid -->

@endsection
@section('scripts')
    @livewireScripts
@endsection
