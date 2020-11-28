@if (session()->has('message'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ session('message') }}</strong>
    </div>
@endif
<div class="row">

    <div class="col-12 ">
        <form action="">
            <div class="card card-info">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Телефоны компании:</h3>
                </div>
                <div class="card-body clearfix">
{{--                    <div class="input-group mb-3 mt-3">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text"><i class="fas fa-phone"></i></span>--}}
{{--                        </div>--}}
{{--                        <input type="text" name="name" class="form-control " placeholder="Телефон" required="">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text"><i class="fas fa-keyboard"></i></span>--}}
{{--                        </div>--}}
{{--                        <input type="text" name="name" class="form-control " placeholder="Доп. информация" required="">--}}

{{--                        <buttom class="btn btn-info" style="border-radius: 0">Добавить<i class="fas fa-plus ml-2"></i>--}}
{{--                        </buttom>--}}
{{--                    </div>--}}
                    <button class="btn btn-info mb-3 float-right"><i class="fas fa-plus"></i><span>Добавить телефон</span></button>
                    @if(count($phones) > 0)
                    <table id="adminsList" class="table table-bordered table-hover dataTable admins-table m-b-3"
                           role="grid"
                           aria-describedby="example2_info">
                        <thead>
                        <tr role="row" class="text-center">
                            <th>Телефон</th>
                            <th>Описание</th>
                            <th>Операция</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($phones as $phone)
                            <tr>
                                <td>{{$phone}}</td>
                                <td></td>
                                <td class="text-center">

                                        <button class="btn btn-danger"><i class="fas fa-trash"></i></button>


                                        <button class="btn btn-primary "><i class="fas fa-user-edit"></i></button>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    @endif

                </div>
            </div>
        </form>
    </div>

</div>
<!-- /.row -->
