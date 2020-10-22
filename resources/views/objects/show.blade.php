@extends('layouts.app')

@section('content')
    <?php
    use Jenssegers\Agent\Agent;

    $agent = new Agent();
    ?>
    <div class="container">

        <div class="row bg-white px-lg-5 pb-4 mb-4 shadow" style="border-radius: 10px">
            <div class="col-12 col-lg-5 py-4">
                <p>
                    <span class="h3 pr-2">Имя объекта:</span> ГУМ
                </p>

                <p>
                    <span class="h3 pr-2">Адресс:</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Accusantium adipisci aperiam ducimus eius, enim est explicabo ipsa laborum maxime nostrum optio
                    provident quam quas quidem temporibus ullam veritatis voluptatibus. Harum.
                </p>

                <p>
                    <span class="h3 pr-2">Район:</span> Lorem ipsum
                </p>
                <p>
                    <span class="h3 pr-2">Район:</span> Lorem ipsum
                </p>
            </div>
            <div class="col-10 col-lg-7 mx-auto py-4">
                <iframe
                    src="https://yandex.ru/map-widget/v1/?um=constructor%3A509077053c8294c7f409760ef365f9ab054949a326b8fb1d4b78dc03afb4f255&amp;source=constructor"
                    width="100%" height="300" frameborder="0"></iframe>
            </div>

        </div>
        <div class="row bg-white py-4 mt-4 shadow px-lg-5" style="border-radius: 10px">
            <div class="col-12">
                <div class="row justify-content-lg-between align-items-center mb-5">
                    <div class="col-6 col-lg-4">
                        <span class="h2-lg h4">Проверка</span>
                    </div>
                    <div class="col-6 col-lg-2 text-right text-lg-left">

                        @if($agent->isMobile())
                            <a href="{{ route('create') }}" class="btn">
                                <i class="fas fa-plus-circle text-success" style="font-size: 20px"></i>
                            </a>
                        @elseif($agent->isDesktop())
                            <a class="btn-green-stage " style="padding: 11px 19px;margin-top: 15px;">
                                Добавить этап
                            </a>
                        @endif
                    </div>
                </div>
                <div class="accordion md-accordion accordion-blocks" id="accordionExample" role="tablist"
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
                                            <span>Дата проверка: <span>{{ $check->created_at }}</span></span>
                                            <i class="fas fa-angle-down rotate-icon" style="margin-top: 2px;"></i>
                                        </h6>
                                    </a>

                                </h2>
                            </div>

                            <div id="build-{{ $check->build_id }}Stage-{{ $check->id }}" class="collapse"
                                 role="tabpanel" aria-labelledby="Stage-{{ $check->id }}"
                                 data-parent="#accordionStages">
                                <div class="card-body">
                                    <div class="row mb-4">
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
                                    </div>

                                    <div class="row mb-4">
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
                                    </div>

                                    <div class="row mb-4">
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
