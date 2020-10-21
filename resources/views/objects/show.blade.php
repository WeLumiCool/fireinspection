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
        <div class="row justify-content-lg-between align-items-center">
            <div class="col-6 col-lg-4">
                <span class="h2-lg h4">Инспекция</span>
            </div>
            <div class="col-6 col-lg-2 text-right text-lg-left">

                @if($agent->isMobile())
                    <a href="{{ route('create') }}" class="btn">
                        <i class="fas fa-plus-circle text-success" style="font-size: 20px"></i>
                    </a>
                @elseif($agent->isDesktop())
                    <a href="{{ route('create') }}" class="btn btn-success py-3 ">
                        Добавить проверку
                    </a>
                @endif
            </div>
        </div>
        <div class="col-12 bg-white py-4 mt-4 shadow" style="border-radius: 10px">
            <div class="accordion md-accordion accordion-blocks" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Collapsible Group Item #1
                                <i class="fas fa-angle-down rotate-icon" style="margin-top: 2px;"></i>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                         data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-12 col-lg-2">
                                    <h6 class=font-weight-bolder>
                                        АУПС
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <h6 class=font-weight-bolder>
                                        АУПТ
                                    </h6>
                                    <p>
                                        <i class="fa fa-times-circle text-danger"></i>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Первичные средства пожаротушения
                                    </h6>

                                    @for($i = 0; $i < 5; $i++)
                                        <p>
                                            Оп-{{$i+1}} колличество {{$i+rand(1, 5)}}ед
                                        </p>
                                    @endfor

                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Водоснабжение (пожарный гидрант, водоем)
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Внутренние противопожарные краны (наличие)
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Планы эвакуации (наличие)
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Запасы пенообразования
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <p class="h4 h3-lg">
                                        Изображения
                                    </p>
                                    <div class="row">

                                        @for($i = 0; $i < 6; $i++)
                                            <div class="col-3">
                                                <a class="grouped_elements" rel="group2" href="image_big_3.jpg">
                                                    <img src="{{ asset }}" alt=""/>
                                                </a>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <h6 class=font-weight-bolder>
                                        Примичание
                                    </h6>
                                    @for($i = 0; $i < 3; $i++)
                                        <img src="" alt="">
                                        <p>
                                            Lorem ipsum-{{$i}} dolor sit-{{$i}}.
                                        </p>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                Collapsible Group Item #2
                                <i class="fas fa-angle-down rotate-icon" style="margin-top: 2px;"></i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-12 col-lg-2">
                                    <h6 class=font-weight-bolder>
                                        АУПС
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <h6 class=font-weight-bolder>
                                        АУПТ
                                    </h6>
                                    <p>
                                        <i class="fa fa-times-circle text-danger"></i>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Первичные средства пожаротушения
                                    </h6>

                                    @for($i = 0; $i < 5; $i++)
                                        <p>
                                            Оп-{{$i+1}} колличество {{$i+rand(1, 5)}}ед
                                        </p>
                                    @endfor

                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Водоснабжение (пожарный гидрант, водоем)
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Внутренние противопожарные краны (наличие)
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Планы эвакуации (наличие)
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Запасы пенообразования
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12 col-lg-9">
                                    <h6 class=font-weight-bolder>
                                        Примичание
                                    </h6>
                                    @for($i = 0; $i < 3; $i++)
                                        <p>
                                            Lorem ipsum-{{$i}} dolor sit-{{$i}}.
                                        </p>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                Collapsible Group Item #3
                                <i class="fas fa-angle-down rotate-icon" style="margin-top: 2px;"></i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                         data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-12 col-lg-2">
                                    <h6 class=font-weight-bolder>
                                        АУПС
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <h6 class=font-weight-bolder>
                                        АУПТ
                                    </h6>
                                    <p>
                                        <i class="fa fa-times-circle text-danger"></i>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Первичные средства пожаротушения
                                    </h6>

                                    @for($i = 0; $i < 5; $i++)
                                        <p>
                                            Оп-{{$i+1}} колличество {{$i+rand(1, 5)}}ед
                                        </p>
                                    @endfor

                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Водоснабжение (пожарный гидрант, водоем)
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Внутренние противопожарные краны (наличие)
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Планы эвакуации (наличие)
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <h6 class=font-weight-bolder>
                                        Запасы пенообразования
                                    </h6>
                                    <p>
                                        <i class="fa fa-check-circle text-success"></i>
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12 col-lg-9">
                                    <h6 class=font-weight-bolder>
                                        Примичание
                                    </h6>
                                    @for($i = 0; $i < 3; $i++)
                                        <p>
                                            Lorem ipsum-{{$i}} dolor sit-{{$i}}.
                                        </p>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
