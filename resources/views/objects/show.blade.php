@extends('layouts.app')

@section('content')
    <?php
    use Jenssegers\Agent\Agent;

    $agent = new Agent();
    ?>
    <div class="container">

        <div class="row bg-white px-lg-5 pb-4 mb-4 shadow" style="border-radius: 10px">
            <div class="col-12 col-lg-5 py-4 ">
                <div class="row">
                    <div class="col-6 mb-4">
                        <span class="h5 font-weight-bold pr-2">Имя объекта:</span>
                    </div>
                    <div class="col-6">
                        <span> {{ $build->name }}</span>
                    </div>

                    <div class="col-6 mb-4">
                        <span class="h5 font-weight-bold pr-2">Адресс:</span>
                    </div>
                    <div class="col-6">
                        <span> {{ $build->address }}</span>
                    </div>

                    <div class="col-6 mb-4">
                        <span class="h5 font-weight-bold pr-2">Район:</span>
                    </div>
                    <div class="col-6">
                        <span> {{ $build->district }}</span>
                    </div>

                    <div class="col-6 mb-4">
                        <span class="h5 font-weight-bold pr-2">Тип объекта:</span>
                    </div>
                    <div class="col-6">
                        <span> {{ $build->type->name }}</span>
                    </div>

                </div>
            </div>
                @if($build->latitude && $build->longitude)
                    <div class="col-7 mx-auto py-4">
                        <div id="map" class="border-0" style="width: 100%; height: 400px;"></div>
                    </div>
                @endif

        </div>
        <div class="row bg-white py-4 mt-4 shadow px-lg-5" style="border-radius: 10px">
            <div class="col-12">
                <div class="row justify-content-lg-between align-items-center mb-2">
                    <div class="col-6 col-lg-4">
                        <span class="h2-lg h4">Проверка</span>
                    </div>
                    <div class="col-6 col-lg-2 text-right text-lg-left">
                        @if($agent->isMobile())
                            <a href="{{ route('create') }}" class="btn">
                                <i class="fas fa-plus-circle text-success" style="font-size: 20px"></i>
                            </a>
                        @elseif($agent->isDesktop())
                            <a href="{{ route('inspector.create', $build->id) }}" class="btn-green-stage d-flex text-decoration-none" style="padding: 10px 6px;">
                                Добавить проверку
                            </a>
                        @endif
                    </div>
                </div>
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
                            <div class="card-header">
                                <h2 class="mb-0">
                                    <a class="text-left" data-toggle="collapse" data-parent="#accordionStages"
                                       href="#build-{{ $check->build_id }}Stage-{{ $check->id }}"
                                       aria-expanded="true"
                                       aria-controls="build-{{ $check->build_id }}Stage-{{ $check->id }}">
                                        <h6 class="mt-1 mb-0">
                                            <span>{{ $check->type->name }} проверка: <span>{{ $check->created_at }}</span></span>
                                            <i class="fas fa-angle-down rotate-icon" style="margin-top: 2px;"></i>
                                        </h6>
                                    </a>

                                </h2>
                            </div>

                            <div id="build-{{ $check->build_id }}Stage-{{ $check->id }}" class="collapse"
                                 role="tabpanel" aria-labelledby="Stage-{{ $check->id }}"
                                 data-parent="#accordionStages">
                                <div class="card-body p-0">
                                    <div class="table-ui  mb-3">
                                        <div class="row px-3">
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center">
                                                <p class="h6 font-weight-bold ">Автоматическая установка пожарной сигнализации:</p>
                                                @if($check->has_aups)
                                                    <p><i class="fa fa-check-circle text-success fa-2x"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger fa-2x"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">Автоматическая установка пожаротушения:</p>
                                                @if($check->has_aupt)
                                                    <p><i class="fa fa-check-circle text-success fa-2x"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger fa-2x"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">Противопожарные краны:</p>
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
                                                <p class="h6 font-weight-bold ">Запасы пенооброзователя(200л):</p>
                                                @if($check->has_foam)
                                                    <p><i class="fa fa-check-circle text-success fa-2x"></i></p>
                                                @else
                                                    <p>
                                                        <i class="fa fa-times-circle text-danger fa-2x"></i>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">Гидрант:</p>
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
                                                <div class="col-12 d-flex text-left mb-3">
                                                    <div class="col-6 col-lg-3">
                                                        <p class="h6 font-weight-bold"> Первичные средства
                                                            пожаротущения:</p>
                                                    </div>
                                                    <div class="col-6 col-lg-3">
                                                        <p class="h6 font-weight-bold">
                                                            Колличество
                                                        </p>
                                                    </div>

                                                </div>
                                                <div class="col-12 d-flex text-left mb-3">
                                                    <div class="col-6 col-lg-3">
                                                        @foreach(json_decode($check->psp_count) as $psp)
                                                            <p class="text-muted m-0 border-bottom py-1">
                                                                <span class="text-dark font-weight-bold">{{ $psp->type }}:</span>
                                                            </p>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-6 col-lg-3">
                                                        @foreach(json_decode($check->psp_count) as $psp)
                                                            <p class="text-muted m-0 border-bottom py-1">
                                                                {{ $psp->count }}
                                                            </p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!is_null($check->images))
                                                <div class="col-12 my-2">
                                                    <p class="h5 text-left font-weight-bold">
                                                        Изображение
                                                    </p>
                                                    <div class="row">
                                                        @foreach(json_decode($check->images) as $image)
                                                            <div class="col-12 col-md-4 col-lg-3 pb-3">
                                                                <a class="grouped_elements" rel="group1"
                                                                   href="{{ asset('storage/' .  $image) }}"
                                                                   data-fancybox="media-img-{{ $check->id }}">
                                                                    <img src="{{ asset('storage/' .  $image) }}"
                                                                         class="" alt="" width="200"/>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            @if($check->violations->count())
                                                <div class="col-12 col-lg-11 text-left">
                                                    <p class="h5 font-weight-bold">Примечание:</p>
                                                    @foreach($check->violations as $violation)
                                                        <p class="alert alert-danger">
                                                            <span>{{ $violation->type->name }}:</span>
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

@push('scripts')

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
