@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <div class="p-3 bg-form card-body-admin">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-12 col-md-10">
                <form action="{{ route('admin.checks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center">
                        <p class="font-weight-bold h2">Добавление проверки</p>
                    </div>
                    <div class="form-group">
                        <label for="type_check-select">Тип проверки:</label>
                        <select class="form-control" name="type_id" id="type_check-select">
                            @foreach($typeChecks as $typeCheck)
                                <option value="{{ $typeCheck->id }}">{{ $typeCheck->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input id="aups_check" type="checkbox" name="has_aups">
                        <label for="aups_check"> АУПС</label>
                    </div>
                    <div class="form-group">
                        <input id="aupt_check" type="checkbox" name="has_aupt">
                        <label for="aupt_check">АУПТ</label>
                    </div>
                    <div class="form-group">
                        <input id="aupt_check" type="checkbox" name="has_cranes">
                        <label for="aupt_check">Кран</label>
                    </div>
                    <div class="form-group">
                        <input id="aupt_check" type="checkbox" name="has_evacuation">
                        <label for="aupt_check">План эвакуации</label>
                    </div>
                    <div class="form-group">
                        <input id="aupt_check" type="checkbox" name="has_foam">
                        <label for="aupt_check">Запасы пенооброзование</label>
                    </div>
                    <div class="form-group">
                        <input id="aupt_check" type="checkbox" name="has_hydrant">
                        <label for="aupt_check">Гидрант</label>
                    </div>
                    <div class="form-group">
                        <input id="aupt_check" type="checkbox" name="has_reservoir">
                        <label for="aupt_check">Водоем</label>
                    </div>
                    <div class="form-group">
                        <label for="image_input">Изображении</label>
                        <input id="image_input" name="images[]" type="file" accept="image/*" multiple>
                    </div>
                    <div class="form-group">
                        <label for="type_psp_select">Тип первичной пажаротушение:</label>
                        <div id="psps_div">
                            {{--place for psps--}}
                        </div>
                        <button id="add_psp" class="btn btn-success" type="button">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="form-group">
                        <label for="type_psp_select">Нарушения:</label>
                        <div id="violations_div">
                            {{--place for violations--}}
                        </div>
                        <button id="add_violation" class="btn btn-success" type="button">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <input type="hidden" name="build_id" value="{{ $id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <button type="submit" title="{{ __('Добавить') }}"
                            class="btn n btn-success">{{ __('Добавить') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#add_psp').click(function () {
            let html =
                `<div>
            <select class="form-control-sm" name="type_psps[]" id="type_psp_select">`
                    @foreach($typePsps as $typePsp)
                + `<option value="{{ $typePsp->name }}">{{ $typePsp->name }}</option>`
                    @endforeach
                + `</select>
                <input name="counts[]" type="number" min="1" value="1" required>
                <button class="btn delete-psp" type="button" style="color: red">
                    <i class="far fa-trash-alt"></i>
                </button>
                </div>`;
            $('#psps_div').append(html);
        });
        $(document).on('click', '.delete-psp', function () {
            $(this).parent().remove();
        });

        $('#add_violation').click(function () {
            let html =
                `<div class="border">
                         <select class="" name="type_violations[]" id="type_psp_select">`
                    @foreach($typeViolations as $typeViolation)
                + `<option value="{{ $typeViolation->id }}">{{ $typeViolation->name }}</option>`
                    @endforeach
                + `</select>
                <textarea name="descs[]" cols="40" rows="1"></textarea>
                <button class="btn delete-violation" type="button" style="color: red">
                    <i class="far fa-trash-alt"></i>
                </button>
            </div>`;
            $('#violations_div').append(html);
        });
        $(document).on('click', '.delete-violation', function () {
            $(this).parent().remove();
        })
    </script>
@endpush
