@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <div class="p-3 bg-form card-body-admin">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-12 col-md-10">
                <form action="{{ route('admin.typeBuilds.update', $typeBuild) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row justify-content-center">
                        <p class="font-weight-bold h2">Редактирование типа</p>
                    </div>
                    <div class="form-group">
                        <label for="name_field">Наименование</label>
                        <input id="name_field" type="text" class="form-control" value="{{ $typeBuild->name }}" name="name"
                               accept="image/*" required>
                    </div>
                    <button type="submit" title="{{ __('Изменить') }}"
                            class="btn n btn-success">{{ __('Изменить') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
