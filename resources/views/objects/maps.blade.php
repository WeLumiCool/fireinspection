@extends('layouts.app')
@section('content')

    <div class="section">
        <div class="container bg-form">
            <div class="row">
                <div class="col-lg-3 pt-2 col-sm-12">
                    <div class="form-group">
                        <label for="role-select">Район:</label>
                        <select name="district" id="district" class="form-control filter_select">
                            <option value="0">Все</option>
                            @foreach(['Первомайский', 'Свердловский', 'Ленинский', 'Октябрьский'] as $district)
                                <option value="{{ $district }}">{{ $district }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 pt-2 col-sm-12">
                    <div class="form-group">
                        <label for="type_of_object">Тип объекта:</label>
                        <select class="form-control filter_select" id="type" name="type_id">
                            <option value="0">Все</option>
                        @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div id="main">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        #map {
            width: 100%;
            height: 500px;
            padding: 10px;
        }

    </style>
@endpush

@push('scripts')
    <script src="https://api-maps.yandex.ru/2.1/?apikey=a2435f91-837f-4a88-87c0-7ac7813eb317&lang=ru_RU"
            type="text/javascript"></script>
    <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).on('change', '.filter_select', function () {
            let type;
            let district;
            if ($(this).attr('id') === "district") {
                district = $(this).children("option:selected").val();
                let select = document.getElementById('type');
                type = select.options[select.selectedIndex].value;
            }
            else    {
                type = $(this).children("option:selected").val();
                let select = document.getElementById('district');
                district = select.options[select.selectedIndex].value;
            }
            $.ajax({
                url: "{{ route('district.check') }}",
                method: 'GET',
                data: {
                    district: district,
                    type: type,
                },
                success: function (data) {
                    // console.log(document.getElementById('main'));
                    $('#main').html(data.view);
                }
            });
        })
    </script>
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
                    clusterIconLayout: "default#pieChart"

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

                getPointOptions = function (legality) {

                    if (legality === "1") {

                        return {
                            preset: 'islands#redDotIcon',
                        }
                    } else if (legality === "0") {
                        return {
                            preset: 'islands#darkGreenDotIcon',
                        }
                    }else if (legality === "2") {
                        return {
                            preset: 'islands#violetDotIcon',
                        }
                    }
                },
                points = [];
            owner = [];
            address = [];
            category = [];
            id = [];
            legality = [];

            @foreach($builds as $build)

                points.push([{{ $build->latitude }}, {{ $build->longitude }}]);
                owner.push("{{ $build->name }}");
                address.push("{{ $build->address }}");
                category.push("{{ $build->type->name }}");
                id.push("{{ $build->id }}");
            @if($build->checks->first())
                legality.push("{{ $build->checks->first()->legality }}");
            @else
                legality.push('2');
                @endif
            @endforeach

                geoObjects = [];
            for (var i = 0, len = points.length; i < len; i++) {

                geoObjects[i] = new ymaps.Placemark(points[i], getPointData(i, owner[i], address[i], id[i]), getPointOptions(legality[i]));
            }

            clusterer.add(geoObjects);
            myMap.geoObjects.add(clusterer);
        });
    </script>
@endpush
