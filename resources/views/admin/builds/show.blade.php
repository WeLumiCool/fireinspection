@extends('admin.layouts.dashboard')
@section('dashboard_content')
    <div class="container bg-form card-body-admin mt-3 pt-3">
        <div class="row justify-content-end">
            <div class="col-12 text-right">
                <a class="btn btn-info text-white" href="{{ route('admin.history.index', $build) }}">
                    Посмотреть историю
                </a>
            </div>
        </div>
        <div class="row  pb-4 mb-4" >
            <div class="col-12 col-lg-5 py-4 ">
                <div class="row">
                    <div class="col-6 mb-4">
                        <h4 class="font-weight-bold pr-2">Имя объекта:</h4>
                    </div>
                    <div class="col-6">
                        <span> {{ $build->name }}</span>
                    </div>

                    <div class="col-6 mb-4">
                        <h4 class="font-weight-bold pr-2">Адресс:</h4>
                    </div>
                    <div class="col-6">
                        <span> {{ $build->address }}</span>
                    </div>

                    <div class="col-6 mb-4">
                        <h4 class="font-weight-bold pr-2">Район:</h4>
                    </div>
                    <div class="col-6">
                        <span> {{ $build->district }}</span>
                    </div>

                    <div class="col-6 mb-4">
                        <h4 class="font-weight-bold pr-2">Тип объекта:</h4>
                    </div>
                    <div class="col-6">
                        <span> {{ $build->type->name }}</span>
                    </div>
                    <div class="col-6 mb-4">
                        <h4 class="font-weight-bold pr-2">Запланированная проверка:</h4>
                    </div>
                    <div class="col-6">
                        <span> {{ $build->planned_check }}</span>
                    </div>

                </div>
            </div>
            @if($build->latitude && $build->longitude)
                <div class="col-7 mx-auto py-4">
                    <div id="map" class="border-0" style="width: 100%; height: 400px;"></div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('admin.checks.create', $build->id) }}" class="btn btn-success my-1"
                   style="padding: 15px;">
                    Добавить проверку
                </a>
            </div>
        </div>
        <div class="row mt-4 mb-2 ">
            <div class="col-12">
                <div class="accordion md-accordion accordion-blocks border-0" id="accordionStages" role="tablist"
                     aria-multiselectable="true">
                    @foreach($build->checks as $check)
                        <div class="card" style="margin-bottom: 0.4rem;
    -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
    border-bottom: 1px solid #dee2e6!important;
    border-bottom: 0;
    border-bottom-right-radius: 5px;
    border-bottom-left-radius: 5px;">
                            <div class="card-header d-flex justify-content-between align-items-center border-0" style="background: white"
                                 role="tab" id="Stage-{{ $check->id }}">
                                <a class="text-left w-100 collapsed" data-toggle="collapse" data-parent="#accordionStages"
                                   href="#build-{{ $check->build_id }}Stage-{{ $check->id }}"
                                   aria-expanded="true"
                                   aria-controls="build-{{ $check->build_id }}Stage-{{ $check->id }}">
                                    <h6 class="mt-1 mb-0">
                                        <span>{{ $check->type->name }} проверка: <span>{{ $check->created_at }}</span></span>
                                        <i class="fas fa-angle-down mr-3 rotate-icon" style="margin-top: 2px;"></i>
                                    </h6>
                                </a>
                                <div class="d-flex">
                                    <form id="form-{{ $check->id }}" name="delete-form" method="POST"
                                          action="{{ route('admin.checks.destroy', $check) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deleteConfirm(this)" data-id="{{ $check->id }}"
                                                title="{{ __('Удалить') }}"
                                                class="btn n btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <a class="btn btn-primary ml-1" href="{{ route('admin.checks.edit', $check) }}">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>

                            <div id="build-{{ $check->build_id }}Stage-{{ $check->id }}" class="collapse"
                                 role="tabpanel" aria-labelledby="Stage-{{ $check->id }}"
                                 data-parent="#accordionStages">
                                <div class="card-body p-0">
                                    <div class="table-ui  mb-3">
                                        <div class="row pl-3">
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center">
                                                <p class="h6 font-weight-bold ">АУПС:</p>
                                                @if($check->has_aups)
                                                    <p><i class="fa fa-check-circle text-success fa-2x"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger fa-2x"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">АУПТ:</p>
                                                @if($check->has_aupt)
                                                    <p><i class="fa fa-check-circle text-success fa-2x"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger fa-2x"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">Пожарный кран:</p>
                                                @if($check->has_cranes)
                                                    <p><i class="fa fa-check-circle text-success fa-2x"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger fa-2x"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">План эвакуации:</p>
                                                @if($check->has_evacuation)
                                                    <p><i class="fa fa-check-circle text-success fa-2x"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger fa-2x"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">Запасы пенооброзование:</p>
                                                @if($check->has_foam)
                                                    <p><i class="fa fa-check-circle text-success fa-2x"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger fa-2x"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">Пожарный гидрант:</p>
                                                @if($check->has_hydrant)
                                                    <p><i class="fa fa-check-circle text-success fa-2x"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger fa-2x"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-lg-6 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">Водоем:</p>
                                                @if($check->has_reservoir)
                                                    <p><i class="fa fa-check-circle text-success fa-2x"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger fa-2x"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            @if(!is_null($check->psp_count))
                                                <div class="col-12 text-left mb-3">
                                                    <p class="h5 font-weight-bold"> Первичные средства
                                                        пожаротущения:</p>
                                                    @foreach(json_decode($check->psp_count) as $psp)
                                                        <p class="text-muted m-0">
                                                        <span class="text-dark font-weight-bold">{{ $psp->type }}:</span>
                                                            {{ $psp->count }}
                                                        </p>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if(!is_null($check->images))
                                                <div class="col-12 my-2">
                                                    <p class="h5 text-left font-weight-bold">
                                                        Изображение
                                                    </p>
                                                    <div class="row">
                                                        @foreach(json_decode($check->images) as $image)
                                                            <div class="col-2">
                                                                <a class="grouped_elements" rel="group1"
                                                                   href="{{ asset('storage/' .  $image) }}"
                                                                   data-fancybox="media-img-{{ $check->id }}">
                                                                    <img src="{{ asset('storage/' .  $image) }}"
                                                                         class="" alt="" height="200"/>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            @if($check->violations->count())
                                                <div class="col-11 text-left">
                                                    <p class="h5 font-weight-bold">Примечание:</p>
                                                    @foreach($check->violations as $violation)
                                                        <p class="alert alert-danger mx-2">
                                                            <span class="mx-2">{{ $violation->type->name }}:</span>
                                                            {{ $violation->note }}
                                                        </p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>


@endsection
@push('styles')
    <style>
        #show_articles div {
            padding-top: 2rem;
            padding-bottom: 2rem;
            border: 1px solid #dcdcdd;
        }
    </style>
@endpush
@push('scripts')
    <script>
        function deleteConfirm(me) {
            if (confirm('Вы дествительно хотите удалить ?')) {
                let model_id = me.dataset.id;
                $('form#form-' + model_id).submit();
            }
        }
    </script>
    <script type="text/javascript">
        // Функция ymaps.ready() будет вызвана, когда
        // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
        ymaps.ready(init);

        function init() {
            // Создание карты.
            var myMap = new ymaps.Map("map", {
                center: [{{ $build->latitude ?? 42.865388923088396 }}, {{ $build->longitude ?? 74.60104350048829 }}],
                zoom: 19
            });
            myMap.geoObjects.add(new ymaps.Placemark([{{ $build->latitude ?? 42.865388923088396 }}, {{ $build->longitude ?? 74.60104350048829 }}], {
                balloonContentHeader: '{{ $build->name }}',
                balloonContentBody: '{{ $build->address }}'
            }, {
                preset: 'islands#icon',
                iconColor: '#0095b6'
            }))
        }


    </script>
@endpush





