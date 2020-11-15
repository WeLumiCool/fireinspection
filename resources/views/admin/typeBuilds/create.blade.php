@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <div class="p-3 bg-form card-body-admin">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-12 col-md-10">
                <form action="{{ route('admin.typeBuilds.store') }}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <p class="font-weight-bold h2">Добавления типа</p>
                    </div>
                    <div class="form-group">
                        <label for="name_field">Наименование<span class="text-danger">*</span></label>
                        <input id="name_field" type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="add_developers">Список пунктов проверок:</label>
                        <select id="add_developers" class="js-example-basic-multiple" name="points[]" multiple>
                            @foreach($points as $point)
                                <option value="{{ $point->id }}">{{ $point->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" title="{{ __('Добавить') }}"
                            class="btn n btn-success">{{ __('Добавить') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2({width: '100%'});
        });
    </script>
@endpush
