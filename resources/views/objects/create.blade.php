@extends('layouts.app')
@section('content')
    <section >
        <div class="container ">
            <div class="row">
                <div class="col-12 bg-form card-body-admin p-lg-5">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <p class="font-weight-bold h2">Добавление объекта</p>
                        </div>
                        <div class="form-group">
                            <label for="name_field">Наименование:<span class="text-danger">*</span></label>
                            <input id="name_field" type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="district">Район:<span class="text-danger">*</span></label>
                            <input id="district" type="text" class="form-control" name="district" required>
                        </div>
                        <div class="form-group">
                            <label for="type_of_object">Тип объекта:</label>
                            <select class="form-control" id="type_of_object" name="type_id">
                                    <option value="1">sdfsdf</option>
                                    <option value="2">234sdf</option>
                                    <option value="3">fgtyh</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address_field">Адрес:<span class="text-danger">*</span></label>
                            <input id="address_field" type="text" class="form-control" name="address"
                                   placeholder="Поставьте маркер на карте" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control d-none" id="latitude" name="latitude" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control d-none" id="longitude" name="longitude" required>
                        </div>

                        <div class="form-group">
                            <div class="form-group col">
                                <div id="map" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>

                        <button type="submit" title="{{ __('Добавить') }}"
                                class="btn n btn-success">{{ __('Добавить') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $('#legality-check').change(function () {
            var checkbox = $(this),
                label = $('#legality-check_label');
            if (!checkbox.is(':checked')) {
                label.get(0).lastChild.nodeValue = 'не легален';
                label.css({'color':'red'});
            } else {
                label.get(0).lastChild.nodeValue = 'легален';
                label.css({'color':'green'});
            }
        });
    </script>
    <script>
        let is_legality = true;
        $('#category_of_object').change(function (e) {
            let value = e.currentTarget.value;
            if (value === 'Незаконный') {
                if(is_legality) {
                    $('.files-input').removeAttr('required');
                    $('.mutable-req span').remove();
                }
                is_legality = false;
            } else {
                if(!is_legality) {
                    $('.files-input').prop('required', true);
                    $('.mutable-req').append('<span class="text-danger">*</span>');
                }
                is_legality = true;
            }
        })
    </script>
    <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">

        ymaps.ready(init);

        function init() {
            var myPlacemark,
                myMap = new ymaps.Map('map', {
                    center: [42.865388923088396, 74.60104350048829],
                    zoom: 12
                }, {
                    searchControlProvider: 'yandex#search'
                });
            // Слушаем клик на карте.
            myMap.events.add('click', function (e) {
                var coords = e.get('coords');
                $('#latitude').val(coords[0]);
                $('#longitude').val(coords[1]);
                // Если метка уже создана – просто передвигаем ее.
                if (myPlacemark) {
                    myPlacemark.geometry.setCoordinates(coords);
                }
                // Если нет – создаем.
                else {
                    myPlacemark = createPlacemark(coords);
                    myMap.geoObjects.add(myPlacemark);
                    // Слушаем событие окончания перетаскивания на метке.
                    myPlacemark.events.add('dragend', function () {
                        getAddress(myPlacemark.geometry.getCoordinates());
                    });
                }
                getAddress(coords);
            });

            // Создание метки.
            function createPlacemark(coords) {
                return new ymaps.Placemark(coords, {
                    iconCaption: 'поиск...'
                }, {
                    preset: 'islands#violetDotIconWithCaption',
                    draggable: true
                });
            }

            // Определяем адрес по координатам (обратное геокодирование).
            function getAddress(coords) {
                myPlacemark.properties.set('iconCaption', 'поиск...');
                ymaps.geocode(coords).then(function (res) {
                    var firstGeoObject = res.geoObjects.get(0);
                    console.log(firstGeoObject.getAddressLine());
                    document.getElementById('address_field').value = firstGeoObject.getAddressLine();
                    myPlacemark.properties
                        .set({
                            // Формируем строку с данными об объекте.
                            iconCaption: [
                                // Название населенного пункта или вышестоящее административно-территориальное образование.
                                firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                                // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                                firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                            ].filter(Boolean).join(', '),
                            // В качестве контента балуна задаем строку с адресом объекта.
                            balloonContent: firstGeoObject.getAddressLine()
                        });
                });
            }
        }
    </script>
@endpush
