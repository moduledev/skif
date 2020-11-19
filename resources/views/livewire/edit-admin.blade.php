<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-8 ">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Основная информация:</h3>
                </div>
                <form class="admin-form" wire:submit.prevent="save" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="name"
                                   wire:model="name"
                                   class="form-control @error('name') is-invalid @enderror"
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
                            <input type="text" name="name"
                                   wire:model="surname"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Фамилия администратора"
                                   required autofocus>
                            @error('surnamename')
                            <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <div class="form-group">

                            <input type="password" name="password"
                                   wire:model="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   value=""
                                   id="exampleInputPassword1"
                                   placeholder="Пароль">
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
                            <input type="email" name="email"
                                   wire:model="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Email">
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
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                   wire:model="phone"
                                   id="phoneAdmin"
                                   placeholder="Телефон">
                            @error('phone')
                            <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Изменить фото администратора</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                           wire:model="photo"
                                           class="custom-file-input @error('photo') is-invalid  @enderror"
                                           name="image"
                                           id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Выберите
                                        файл</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Загрузить</span>
                                </div>
                                @error('image')
                                <span class="admin-form_error-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{--                        <div class="form-group">--}}
                        {{--                            <label>Доступные роли:</label>--}}
                        {{--                            @foreach($roles->chunk(7) as $chunk)--}}
                        {{--                                <ul class="p-0">--}}
                        {{--                                    @foreach($chunk as $role)--}}
                        {{--                                        <div class="custom-control custom-checkbox">--}}
                        {{--                                            <input--}}
                        {{--                                                class="custom-control-input " type="checkbox"--}}
                        {{--                                                id="{{$role->id}}" name="roles[]" value="{{$role->name}}"--}}
                        {{--                                                @if($adminRoles->contains($role->name)) checked @endif--}}
                        {{--                                            >--}}
                        {{--                                            <label--}}
                        {{--                                                for="{{$role->id}}"--}}
                        {{--                                                class="custom-control-label">{{$role->name}}--}}
                        {{--                                            </label>--}}
                        {{--                                        </div>--}}
                        {{--                                    @endforeach--}}
                        {{--                                </ul>--}}
                        {{--                            @endforeach--}}
                        {{--                        </div>--}}
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="activate"
                                   class="custom-control-input"
                                   wire:model="activate"
                                   {{$activate === true ? 'checked=checked' : ''}}
                                   id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Активация аккаунта</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Изменить</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Фото администратора:</h3>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">

                    @if ($photo )
                        <img class="img-responsive img-rounded admin-form_avatar-img" alt=""
                             src="{{ $photo->temporaryUrl() }}">
                    @else
                        <img class="img-responsive img-rounded admin-form_avatar-img" alt=""
                             src="{{ asset('storage/'. $image_path) }}">
                    @endif


                </div>
                <div wire:loading wire:target="photo" class="text-center">Загрузка...</div>

            </div>
        </div>
        <div class="col-12">
            <form action="" method="POST">
                @csrf
                {{method_field('DELETE')}}
                <button class="btn btn-danger">Удалить учетную запись <i class="fas fa-trash"></i></button>
            </form>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
