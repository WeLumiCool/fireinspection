@extends('admin.layouts.dashboard')
@section('dashboard_content')
    <div class="container bg-form card-body-admin mt-3 pt-3">
        <div class="row justify-content-end">
            <div class="col-3">
                <a class="btn btn-info text-white" href="#">
                    Посмотреть историю
                </a>
            </div>
        </div>
        <div class="row px-5 pb-4 mb-4" style="border-radius: 10px">
            <div class="col-5 py-4">
                <p>
                    <span class="h4 pr-2">Имя объекта:</span>{{ $build->name }}
                </p>

                <p>
                    <span class="h4 pr-2">Адресс:</span>{{ $build->address }}
                </p>

                <p>
                    <span class="h4 pr-2">Район:</span>{{ $build->district }}
                </p>
                <p>
                    <span class="h4 pr-2">Тип:</span>{{ $build->type->name }}
                </p>
            </div>
            @if($build->latitude && $build->longitude)
                <div class="col-7 mx-auto py-4">
                    <div id="map" class="border-0" style="width: 100%; height: 400px;"></div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('admin.checks.create', $build->id) }}" class="btn-green-stage " style="padding: 11px 19px;margin-top: 15px;">
                    Добавить этап
                </a>
            </div>
        </div>
        <div class="row mt-4 ">
            <div class="col-12 text-center ">
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
                            <div class="card-header d-flex justify-content-between border-0" style="background: white"
                                 role="tab" id="Stage-{{ $check->id }}">
                                <a class="text-left" data-toggle="collapse" data-parent="#accordionStages"
                                   href="#build-{{ $check->build_id }}Stage-{{ $check->id }}"
                                   aria-expanded="true"
                                   aria-controls="build-{{ $check->build_id }}Stage-{{ $check->id }}">
                                    <h6 class="mt-1 mb-0">
                                        <span>Дата проверка: <span>{{ $check->created_at }}</span></span>
                                        <i class="fas fa-angle-down rotate-icon" style="margin-top: 2px;"></i>
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
                                <div class="card-body p-0  ">
                                    <div class="table-ui  mb-3  mb-4">
                                        <div class="row pl-3">
                                            <div class="col-12 col-lg-2">
                                                <h6 class=font-weight-bolder>
                                                    АУПС
                                                </h6>
                                                @if($check->has_aups)
                                                    <p><i class="fa fa-check-circle text-success"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-12 col-lg-2">
                                                <h6 class=font-weight-bolder>
                                                    АУПТ
                                                </h6>
                                                @if($check->has_aupt)
                                                    <p><i class="fa fa-check-circle text-success"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <h6 class=font-weight-bolder>
                                                    Внутренние противопожарные краны (наличие)
                                                </h6>
                                                @if($check->has_cranes)
                                                    <p><i class="fa fa-check-circle text-success"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <h6 class=font-weight-bolder>
                                                    Планы эвакуации (наличие)
                                                </h6>
                                                @if($check->has_evacuation)
                                                    <p><i class="fa fa-check-circle text-success"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <h6 class=font-weight-bolder>
                                                    Запасы пенообразования
                                                </h6>
                                                @if($check->has_foam)
                                                    <p><i class="fa fa-check-circle text-success"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-12 col-lg-2">
                                                <h6 class=font-weight-bolder>
                                                    Гидрант
                                                </h6>
                                                @if($check->has_hydrant)
                                                    <p><i class="fa fa-check-circle text-success"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-12 col-lg-2">
                                                <h6 class=font-weight-bolder>
                                                    Водоем
                                                </h6>
                                                @if($check->has_reservoir)
                                                    <p><i class="fa fa-check-circle text-success"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            @if(count(json_decode($check->psp_count)))
                                                <div class="col-12 col-lg-4">
                                                    <p class="h5 font-weight-bold"> Первичные средства
                                                        пожаротущения:</p>
                                                    @foreach(json_decode($check->psp_count) as $psp)
                                                        <p class="text-muted m-0">
                                                        <span class="text-dark font-weight-bold">{{ $psp->type }}
                                                            :</span>
                                                            {{ $psp->count }}
                                                        </p>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="col-12 my-4">
                                                <p class="h4 h3-lg">
                                                    Изображения
                                                </p>
                                                <div class="row">
                                                    @foreach(json_decode($check->images) as $image)
                                                        <div class="col-3">
                                                            <a class="grouped_elements" rel="group1"
                                                               href="{{ asset('storage/' .  $image) }}"
                                                               data-fancybox="media-img-{{ $check->id }}">
                                                                <img src="{{ asset('storage/' .  $image) }}"
                                                                     class="img-fluid" alt=""/>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @if($check->violations->count())
                                                <div class="col-12 col-lg-10 text-left">
                                                    <h6 class=font-weight-bolder>
                                                        Примичание
                                                    </h6>
                                                    @foreach($check->violations as $violation)
                                                        <p class="alert alert-danger">
                                                            <span>{{ $violation->type->name }}
                                                                :</span>
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





