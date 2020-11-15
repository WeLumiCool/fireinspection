@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <?php
    use Jenssegers\Agent\Agent;

    $agent = new Agent();
    ?>
    <div class="p-3 bg-form card-body-admin">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-12 col-md-10">
                <form action="{{ route('admin.checks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center">
                        <p class="font-weight-bold h2">Добавление проверки</p>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bold h6" for="type_check-select">Тип проверки:</label>
                                <select class="form-control" name="type_id" id="type_check-select">
                                    @foreach($typeChecks as $typeCheck)
                                        <option value="{{ $typeCheck->id }}">{{ $typeCheck->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bold h6" for="role-select">Назначить дату следующей
                                    проверки:</label>
                                <select name="planned_check" id="role-select" class="form-control">
                                    @foreach(['1-квартал', '2-квартал', '3-квартал', '4-квартал', '1-год'] as $date)
                                        <option value="{{ $date }}">{{ $date }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        @foreach($build->type->points as $point)
                            <div class="col-lg-4 col-12 ">
                                <div class="form-group d-flex">
                                    @if($point->name == 'Пожарный щит')
                                        <div class="button r mr-3" id="button-1">
                                            <input id="point_{{ $point->id }}" type="checkbox" class="checkbox"
                                                   name="points[{{ $point->id }}]" style="display: none">
                                            <div class="knobs" disabled="true"></div>
                                            <div class="layer" disabled="true"></div>
                                        </div>
                                        <div class=" pt-2">
                                            <label class="font-weight-bold h5 ">Пожарный
                                                щит</label>
                                        </div>
                                        <div class="pl-lg-2 ">
                                            <input type="number" name="has_shield" id="counter"
                                                   class="counter form-control"
                                                   placeholder="Кол-во щитов" min="0" value="0"
                                                   style="width: 67%!important;">
                                        </div>
                                    @else
                                        <div class="button r mr-3" id="button-1">
                                            <input id="point_{{ $point->id }}" type="checkbox" class="checkbox"
                                                   name="points[{{ $point->id }}]">
                                            <div class="knobs"></div>
                                            <div class="layer"></div>
                                        </div>
                                        <label class="font-weight-bold h5 pr-3"
                                               for="point_{{ $point->id }}">{{ $point->name }}</label>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group ">
                            <div>
                                <label class="font-weight-bold h6" for="image_input">Изображении:</label>
                            </div>
                            <input class="py-2" id="image_input" name="images[]" type="file" accept="image/*"
                                   multiple>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bold h6" for="type_psp_select">Первичные средства
                                    пожаротушения:</label>
                                <div id="psps_div">
                                    {{--place for psps--}}
                                </div>
                                <button id="add_psp" class="btn btn-success mt-2" type="button">
                                    <i class="fas fa-plus "><span class="px-4">Добавить ПСП</span></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($violations as $violation)
                            <div class="col-12">
                                <div class="d-flex justify-content-lg-start justify-content-center align-items-center">
                                    <div class="form-group d-flex py-2">
                                        <div class="button r mr-3" id="button-1">
                                            <input id="{{$violation->id}}_check" type="checkbox"
                                                   class="checkbox"
                                                   name="violation[{{$violation->id}}]">
                                            <div class="knobs "></div>
                                            <div class="layer "></div>
                                        </div>

                                    </div>
                                    <label class="font-weight-bold h5 pr-3 py-2" for="{{$violation->id}}_check">
                                        {{ $violation->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="build_id" value="{{ $id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="row pt-3">
                        <div class="col-12 text-center">
                            <button type="submit" title="{{ __('Добавить проверку') }}"
                                    class="btn n btn-success px-3 py-2">{{ __('Добавить проверку') }}</button>
                        </div>
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
    </script>
    <script>
        document.getElementById("point_16").disabled;
        $('#counter').on('input', function () {
            let count = $(this).val();
            if (count > 0) {
                $("#point_16").prop('checked', true);
            } else {
                $("#point_16").prop('checked', false)
            }
        })

    </script>

@endpush
