@extends('admin.layouts.dashboard')
@section('dashboard_content')
    <div class="container bg-form card-body-admin mt-3 pt-3">
        <div class="row pt-4 px-4" id="show_articles">
            <div class="col-2 py-3"><span class="font-weight-bold">id</span></div>
            <div class="col-10 py-3">{{ $build->id }}</div>
            <div class="col-2 py-3"><span class="font-weight-bold">Заголовок:</span></div>
            <div class="col-10 py-3">{{ $build->name }}</div>
            <div class="col-2  py-3"><span class="font-weight-bold">Адрес:</span></div>
            <div class="col-10 py-3">{{ $build->address }}</div>
            <div class="col-2 py-3 "><span class="font-weight-bold">Тип:</span></div>
            <div class="col-10 py-3">{{ $build->type->name }}</div>
            @if($build->latitude && $build->longitude)
                <div class="col-12 mt-4 border-0 p-0">
                    <div id="map" class="border-0" style="width: 100%; height: 400px;"></div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('admin.checks.create', $build->id) }}" class="btn btn-success mt-3 mb-5" style="padding: 15px;">
                    Добавить проверку
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
                                        <div class="row  pl-3">
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center">
                                                <p class="h6 font-weight-bold ">АУПС:</p>
                                                <p class="text-muted">{{ $check->has_aups }}</p>
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">АУПТ:</p>
                                                <p class="text-muted">{{ $check->has_aupt }}</p>
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">Кран:</p>
                                                <p class="text-muted">{{ $check->has_cranes }}</p>
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">План эвакуации:</p>
                                                <p class="text-muted">{{ $check->has_evacuation }}</p>
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">Запасы пенооброзование:</p>
                                                <p class="text-muted">{{ $check->has_foam }}</p>
                                            </div>
                                            <div class="col-lg-3 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">Гидрант:</p>
                                                <p class="text-muted">{{ $check->has_hydrant }}</p>
                                            </div>
                                            <div class="col-lg-6 col-12 text-lg-left py-2 text-center ">
                                                <p class="h6 font-weight-bold ">Водоем:</p>
                                                <p class="text-muted">{{ $check->has_reservoir }}</p>
                                            </div>
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





