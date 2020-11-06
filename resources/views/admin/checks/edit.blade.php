@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <?php
    use Jenssegers\Agent\Agent;

    $agent = new Agent();
    ?>
    <div class="p-3 bg-form card-body-admin">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-12 col-md-10">
                <form action="{{ route('admin.checks.update', $check) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row justify-content-center">
                        <p class="font-weight-bold h2">Изменение проверки</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label class="font-weight-bold h5" for="type_check-select">Тип проверки:</label>
                                <select class="form-control" name="type_id" id="type_check-select">
                                    @foreach($typeChecks as $typeCheck)
                                        <option value="{{ $typeCheck->id }}" {{ $typeCheck->id==$check->type_id?'selected':''}}>
                                            {{ $typeCheck->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bold h6"  for="role-select">Назначить дату следующей проверки:</label>
                                <select name="planned_check" id="role-select" class="form-control">
                                    @foreach(['1-квартал', '2-квартал', '3-квартал', '4-квартал', '1-год'] as $date)
                                        <option value="{{ $date }}" {{ $date == $check->build->planned_check ? "selected" : "" }}>{{ $date }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-12 ">
                            <div class="form-group d-flex">
                                <div class="button r mr-3" id="button-1">
                                    <input id="aups_check" type="checkbox" class="checkbox"
                                           name="has_aups" {{ $check->has_aups?'checked':'' }}>
                                    <div class="knobs"></div>
                                    <div class="layer"></div>
                                </div>
                                <label class="font-weight-bold h5 pr-3" for="aups_check">АУПС</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12 ">
                            <div class="form-group d-flex">
                                <div class="button r mr-3" id="button-1">
                                    <input id="aupt_check" type="checkbox" class="checkbox"
                                           name="has_aupt" {{ $check->has_aupt?'checked':'' }}>
                                    <div class="knobs"></div>
                                    <div class="layer"></div>
                                </div>
                                <label class="font-weight-bold h5 pr-3" for="aupt_check">АУПТ</label>
                            </div>
                        </div>
                        <div class="col-lg-5 col-12">
                            <div class="form-group d-flex ml-5">
                                <div class="button r mr-3" id="button-1">
                                    <input id="has_cranes_check" type="checkbox" class="checkbox"
                                           name="has_cranes" {{ $check->has_cranes?'checked':'' }}>
                                    <div class="knobs"></div>
                                    <div class="layer"></div>
                                </div>
                                <label class="font-weight-bold h5 pr-3" for="has_cranes_check">Пожарный кран</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="form-group d-flex">
                                <div class="button r mr-3" id="button-1">
                                    <input id="has_evacuation_check" type="checkbox" class="checkbox"
                                           name="has_evacuation" {{ $check->has_evacuation?'checked':'' }}>
                                    <div class="knobs"></div>
                                    <div class="layer"></div>
                                </div>
                                <label class="font-weight-bold h5 pr-3" for="has_evacuation_check">План
                                    эвакуации</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="form-group d-flex">
                                <div class="button r mr-3" id="button-1">
                                    <input id="has_hydrant_check" type="checkbox" class="checkbox"
                                           name="has_hydrant" {{ $check->has_hydrant?'checked':'' }}>
                                    <div class="knobs"></div>
                                    <div class="layer"></div>
                                </div>
                                <label class="font-weight-bold h5 pr-3" for="has_hydrant_check">Пожарный гидрант</label>
                            </div>
                        </div>
                        <div class="col-lg-5 col-12 ">
                            <div class="form-group d-lg-flex ml-5">
                                @if($agent->isMobile())
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="button r mr-3" id="button-1" disabled="">
                                            <input id="has_shield_check" type="checkbox" class="checkbox"
                                                   name="shield"
                                                   style="display: none" {{ $check->has_shild?'checked':'' }}>
                                            <div class="knobs" disabled="true"></div>
                                            <div class="layer" disabled="true"></div>
                                        </div>
                                        <div class="">
                                            <label class="font-weight-bold h5 " disabled="">Пожарный
                                                щит</label>
                                            <input type="number" name="has_shield" id="counter" class="counter form-control"
                                                   placeholder="Кол-во щитов" min="0" value="{{ $check->has_shild }}" >
                                        </div>
                                    </div>
                                @elseif($agent->isDesktop())
                                    <div class="button r mr-3" id="button-1" disabled="">
                                        <input id="has_shield_check" type="checkbox" class="checkbox"
                                               name="shield"
                                               style="display: none" {{ $check->has_shild?'checked':'' }}>
                                        <div class="knobs" disabled="true"></div>
                                        <div class="layer" disabled="true"></div>
                                    </div>
                                    <div class="">
                                        <label class="font-weight-bold h5 "  disabled>Пожарный
                                            щит</label>
                                    </div>
                                    <div class="pl-lg-2 ">
                                        <input type="number" name="has_shild" id="counter" class="counter form-control"
                                               placeholder="Кол-во щитов"  min="0" value="{{ $check->has_shild }}" style="width: 67%!important;">
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($check->build->type_id == 5)
                        <div class="col-lg-4 col-12">
                            <div class="form-group d-flex">
                                <div class="button r mr-3" id="button-1">
                                    <input id="has_reservoir_check" type="checkbox" class="checkbox"
                                           name="has_reservoir" {{ $check->has_reservoir?'checked':'' }}>
                                    <div class="knobs"></div>
                                    <div class="layer"></div>
                                </div>
                                <label class="font-weight-bold h5 pr-3" for="has_reservoir_check">Водоем</label>
                            </div>
                        </div>
                        @endif
                        @if($check->build->type_id == 1 || $check->build->type_id == 5)
                        <div class="col-lg-4 col-12 ">
                            <div class="form-group d-flex pb-0">
                                <div class="button r mr-3" id="button-1">
                                    <input id="has_foam_check" type="checkbox" class="checkbox"
                                           name="has_foam" {{ $check->has_foam?'checked':'' }}>
                                    <div class="knobs"></div>
                                    <div class="layer"></div>
                                </div>
                                <label class="font-weight-bold h5" for="has_foam_check">Запасы
                                    пенооброзование</label>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bold h5" for="type_psp_select">Первичные средства
                                    пожаротушения:</label>
                                <div id="psps_div">
                                    @if(!is_null($check->psp_count))
                                        @foreach(json_decode($check->psp_count) as $psp)
                                            <div class="row card-body-admin my-2 mx-1 bg-form">
                                                <div class="col-lg-4 d-flex align-items-center">
                                                    <select class="form-control-sm" name="type_psps[]"
                                                            id="type_psp_select">
                                                        @foreach($typePsps as $typePsp)
                                                            <option
                                                                value="{{ $typePsp->name }}" {{ $typePsp->name==$psp->type?'selected':'' }}>
                                                                {{ $typePsp->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="py-2">
                                                        <input class="" name="counts[]" type="number" min="1" required
                                                               style="padding: 1.25px 0;" value="{{ $psp->count }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 justify-content-center d-flex">
                                                    <button class="btn delete-psp" type="button"
                                                            style="font-size:18px;color: red">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    {{--place for psps--}}

                                </div>
                                <button id="add_psp" class="btn btn-success mt-2" type="button">
                                    <i class="fas fa-plus "><span class="px-4">Добавить ПСП</span></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bold h5" for="image_input">Изображении</label>
                                <input id="image_input" name="images[]" type="file" accept="image/*"
                                       onchange="readURL(this);"
                                       multiple>
                                <div id="images">
                                    @if(!is_null($check->images))
                                        @foreach(json_decode($check->images) as $image)
                                            <img src="{{ asset('storage/'. $image) }}" alt="{{ $image }}" class="px-3 py-3" height="200">
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bold h5" for="type_psp_select">Нарушения:</label>
                                <div class="col-12">
                                    @foreach($violations as $violation)
                                        <div
                                            class="d-flex justify-content-lg-start justify-content-center align-items-center">
                                            <div class="form-group d-flex">
                                                <div class="button r mr-3" id="button-1">
                                                    <input id="{{$violation->id}}_check" type="checkbox"
                                                           class="checkbox"
                                                           name="violation[{{$violation->id}}]" {{ $check->violations->contains('id', $violation->id) ? "checked" : "" }}>
                                                    <div class="knobs "></div>
                                                    <div class="layer "></div>
                                                </div>
                                            </div>
                                            <label class="font-weight-bold h5 pr-3 "
                                                   for="{{$violation->id}}_check">
                                                {{ $violation->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="build_id" value="{{ $check->build_id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="col-12 text-center pt-4 ">
                        <button type="submit" title="{{ __('Изменить') }}"
                                class="btn n btn-success px-3">{{ __('Изменить') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>

        .knobs, .layer {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .button {
            position: relative;
            top: 50%;
            width: 74px;
            height: 36px;
            overflow: hidden;
        }

        .button.r, .button.r .layer {
            border-radius: 100px;
        }

        .checkbox {
            position: relative;
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 3;
        }

        .knobs {
            z-index: 2;
        }

        .layer {
            width: 100%;
            background-color: #fcebeb;
            transition: 0.3s ease all;
            z-index: 1;
        }

        /* Button 1 */
        #button-1 .knobs:before {
            content: 'НЕТ';
            position: absolute;
            top: 4px;
            left: 4px;
            width: 30px;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            line-height: 1;
            padding: 9px 4px;
            background-color: #f44336;
            border-radius: 50%;
            transition: 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15) all;
        }

        #button-1 .checkbox:checked + .knobs:before {
            content: 'ДА';
            left: 41px;
            background-color: #03A9F4;
        }

        #button-1 .checkbox:checked ~ .layer {
            background-color: #ebf7fc;
        }

        #button-1 .knobs, #button-1 .knobs:before, #button-1 .layer {
            transition: 0.3s ease all;
        }


    </style>
@endpush
@push('scripts')
    <script>
        $('#add_psp').click(function () {
            let html =
                `<div class="row card-body-admin my-2 mx-1 bg-form">
        <div class="col-lg-4 d-flex align-items-center">
            <select class="form-control-sm" name="type_psps[]" id="type_psp_select">`
                @foreach($typePsps as $typePsp)
                + `
                <option value="{{ $typePsp->name }}">{{ $typePsp->name }}</option>`
                @endforeach
                + `</select>
        </div>
        <div class="col-lg-7">
            <div class="py-2">
                <input class="" name="counts[]" type="number" min="1" value="1" required style="padding: 1.25px 0;">
            </div>
        </div>
        <div class="col-lg-1 justify-content-center d-flex">
            <button class="btn delete-psp" type="button" style="font-size:18px;color: red">
                <i class="far fa-trash-alt"></i>
            </button>
        </div>
    </div>`;
            $('#psps_div').append(html);
        });
        $(document).on('click', '.delete-psp', function () {
            $(this).parent().parent().remove();
        });

        {{--$('#add_violation').click(function () {--}}
        {{--    let html =--}}
        {{--        `<div class="border">--}}
        {{--                 <select name="type_violations[]" id="type_psp_select">`--}}
        {{--            @foreach($typeViolations as $typeViolation)--}}
        {{--        + `<option value="{{ $typeViolation->id }}">{{ $typeViolation->name }}</option>`--}}
        {{--            @endforeach--}}
        {{--        + `</select>--}}
        {{--        <textarea name="descs[]" cols="40" rows="1"></textarea>--}}
        {{--        <button class="btn delete-violation" type="button" style="color: red">--}}
        {{--            <i class="far fa-trash-alt"></i>--}}
        {{--        </button>--}}
        {{--    </div>`;--}}
        {{--    $('#violations_div').append(html);--}}
        {{--});--}}
        {{--$(document).on('click', '.delete-violation', function () {--}}
        {{--    $(this).parent().remove();--}}
        {{--})--}}
    </script>
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                $('#images').empty();
                for (let i = 0; i < input.files.length; i++) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $('#images').append(`<img class="mr-2 mb-2" name="images[]" src="` + e.target.result + `" height="200">`);
                    };
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>
    <script>
        document.getElementById("has_shield_check").disabled;
        $('#counter').on('input',function () {
            let count = $(this).val();
            if(count > 0){
                $("#has_shield_check").prop('checked', true);
            }
            else{ $("#has_shield_check").prop('checked', false)  }
        })

    </script>
@endpush
