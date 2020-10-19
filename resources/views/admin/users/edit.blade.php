@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-12 col-md-12 card-body-admin py-4 px-5">
            <form action="{{ route('admin.users.update', $user) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h3 class="text-center font-weight-bold">Редактирование пользователя</h3>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <div class="form-group">
                    <label for="name-input">ФИО:</label>
                    <input type="text" id="name-input" class="form-control" name="name" value="{{ old('name', $user->name) }}"
                           required>
                </div>
                <div class="form-group">
                    <label for="mail-input">Почта:</label>
                    <input type="text" id="mail-input" class="form-control" name="email" value="{{ old('email', $user->email) }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="role-select">Роль:</label>
                    <select name="role_id" id="role-select" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id == old('role_id', $user->role_id) ?'selected':'' }}>{{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" title="{{ __('Изменить') }}"
                        class="btn n btn-success">{{ __('Изменить') }}</button>
            </form>
        </div>
    </div>
@endsection
