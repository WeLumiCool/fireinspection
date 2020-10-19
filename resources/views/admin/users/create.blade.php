@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <div class="row ">
        <div class="col-12 col-sm-10 col-lg-12 col-md-10 bg-form card-body-admin py-4 px-5">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <div class="form-group">
                    <label for="name-input">ФИО:</label>
                    <input type="text" id="name-input" class="form-control" name="name" value="{{ old('name') }}"
                           required>
                </div>
                <div class="form-group">
                    <label for="mail-input">Почта:</label>
                    <input type="text" id="mail-input" class="form-control" name="email" value="{{ old('email') }}"
                           required>
                </div>
                <div class="form-group">
                    <label for="mail-input">Пароль:</label>
                    <input type="password"
                           class="form-control"
                           name="password"
                           required autocomplete="new-password" id="password">
                </div>
                <div class="form-group">
                    <label for="mail-input">Повторите пароль:</label>
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required
                           autocomplete="new-password">
                </div>

                <div class="form-group">
                    <label for="role-select">Роль:</label>
                    <select name="role_id" id="role-select" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id == old('role_id') ?'selected':'' }}>{{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" title="{{ __('Добавить') }}"
                        class="btn n btn-success ">{{ __('Добавить') }}</button>
            </form>
        </div>
    </div>
@endsection
