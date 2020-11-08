@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <div class="p-3 bg-form card-body-admin">
        <div class="row p-3">
            <div class="col-12 col-sm-12 col-lg-12 col-md-10">
                <form action="{{ route('admin.builds.update', $build) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row justify-content-center">
                        <p class="font-weight-bold h2">Редактирование объекта</p>
                    </div>
                    <div class="form-group">
                        <label for="name_field">Наименование:<span class="text-danger">*</span></label>
                        <input id="name_field" type="text" class="form-control" name="name" value="{{ $build->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="name_field">ИНН: <span class="text-danger">*</span></label>
                        <input id="name_field" type="text" class="form-control" name="inn" value="{{ $build->inn }}" required>
                    </div>
                    <div class="form-group">
                        <label for="type_of_object">Тип объекта:</label>
                        <select class="form-control" id="type_of_object" name="type_id">
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ $build->type_id == $type->id ? 'selected' : '' }} >{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address_field">Адрес:<span class="text-danger">*</span></label>
                        <input id="address_field" type="text" class="form-control" name="address" value="{{ $build->address }}" required>
                    </div>
                    <div class="form-group">
                        <label for="role-select">Район:</label>
                        <select name="district" id="role-select" class="form-control">
                            @foreach(['Первомайский', 'Свердловский', 'Ленинский', 'Октябрьский'] as $district)
                                <option value="{{ $district }}" {{ $build->district == $district ? 'selected' : '' }}>{{ $district }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control d-none" id="latitude" value="{{ $build->latitude }}" name="latitude" >
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control d-none" id="longitude" value="{{ $build->longitude }}" name="longitude" >
                    </div>


                    <div class="form-group">
                        <div class="form-group col">
                            <div id="map" style="width: 100%; height: 400px;"></div>
                        </div>
                    </div>

                    <button type="submit" title="{{ __('Изменить') }}"
                            class="btn n btn-success">{{ __('Изменить') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            let legality = document.getElementById('legality-check').value;
            if (legality === '0') {
                document.getElementById('legality-check_label').innerHTML = 'Не легален';
                document.getElementById('legality-check_label').style.color = 'red';
            }
            else {
                document.getElementById('legality-check_label').innerHTML = 'Легален';
                document.getElementById('legality-check_label').style.color = 'green';
            }
            $('#legality-check').change(function () {
                var checkbox = $(this),
                    label = $('#legality-check_label');
                if (!checkbox.is(':checked')) {
                    label.get(0).lastChild.nodeValue = 'Разрешение не имеется';
                    label.css({'color':'red'});
                } else {
                    label.get(0).lastChild.nodeValue = 'Разрешение имеется';
                    label.css({'color':'green'});
                }
            });
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

