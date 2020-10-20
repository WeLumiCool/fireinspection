@extends('layouts.app')
@section('content')
    <div class="section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 pb-4">
                    <div id="map"></div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        #map {
            width: 1000px;
            height: 500px;
            padding: 10px;
            margin-top: 50px;
        }

        @media (max-width: 1075px) {
            #map {
                width: 600px;
                height: 500px;
            }
        }

        @media (max-width: 694px) {
            #map {
                width: 400px;
                height: 500px;
            }
        }

        @media (max-width: 428px) {
            #map {
                width: 320px;
                height: 500px;
            }
        }

        @media (max-width: 320px) {
            #map {
                width: 300px;
                height: 400px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://api-maps.yandex.ru/2.1/?apikey=a2435f91-837f-4a88-87c0-7ac7813eb317&lang=ru_RU"
            type="text/javascript"></script>
    <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>

    <script>
        ymaps.ready(function () {
            var myMap = new ymaps.Map('map', {
                    center: [42.865388923088396, 74.60104350048829],
                    zoom: 12
                }, {
                    searchControlProvider: 'yandex#search'
                }),
                clusterer = new ymaps.Clusterer({
                    preset: 'islands#redIcon',
                }),
                getPointData = function (index, name, address, id) {
                    return {
                        balloonContentHeader: name,
                        balloonContentBody: [
                            '<address>',
                            address,
                            '<br>',
                            '<a href="show/' +
                            id +
                            '">' +
                            'Побробнее' +
                            '</a>',
                            '</address>'
                        ].join('')
                    };
                },
                getPointOptions = function (category) {

                    if (category === "Незаконный") {

                        return {
                            preset: 'islands#redDotIcon',
                        }
                    }
                    else if (category === "Строящийся") {
                        return {
                            preset: 'islands#darkGreenDotIcon',
                        }
                    }
                    else if (category === "Завершенный") {
                        return {
                            preset: 'islands#nightDotIcon',
                        }
                    }
                },
                points = [];
            owner = [];
            address = [];
            category = [];
            id = [];

{{--            @foreach($builds as $build)--}}
{{--            points.push([{{ $build->latitude }}, {{ $build->longitude }}]);--}}
{{--            owner.push("{{ $build->name }}");--}}
{{--            address.push("{{ $build->address }}");--}}
{{--            category.push("{{ $build->category }}")--}}
{{--            id.push("{{ $build->id }}")--}}
{{--            @endforeach--}}
{{--                geoObjects = [];--}}
{{--            for (var i = 0, len = points.length; i < len; i++) {--}}

{{--                geoObjects[i] = new ymaps.Placemark(points[i], getPointData(i, owner[i], address[i], id[i]), getPointOptions(category[i]));--}}
{{--            }--}}

            clusterer.add(geoObjects)
            myMap.geoObjects.add(clusterer);
        });

    </script>
@endpush
