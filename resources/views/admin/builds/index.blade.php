@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <div class="p-3 bg-form card-body-admin">

        <div class="row">
            <div class="col-sm-12 table-responsive">
                <div class="row">
                    <div class="col-lg-2 col-sm-12 d-flex align-items-center">
                        <div class="form-group">
                            <label for="type">Выберите район:</label>
                            <select id="type" data-column="2"
                                    class="form-control form-control-sm district-select mb-2    ">
                                <option value="">Все</option>
                                @foreach(['Свердловский','Ленинский', 'Октябрьский', 'Первомайский'] as $district)
                                    <option value="{{ $district }}">{{ $district }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-12 d-flex align-items-center">
                        <div class="form-group">
                            <label for="type">Выберите тип:</label>
                            <select id="type" data-column="3"
                                    class="form-control form-control-sm type-select mb-2    ">
                                <option value="">Все</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div
                        class="d-flex col-lg-2 offset-lg-6 justify-content-lg-end my-2 pr-lg-2 col-12 d-flex justify-content-center align-items-center ">
                        <a href="{{ route('create') }}" type="button"
                           class="btn btn-red  waves-effect text-right " style="padding: 8px 26px;">
                            Добавить объект
                        </a>
                    </div>
                </div>

                <table class="table table-striped table-hover" id="builds-table">
                    <thead class="bg-red-table text-dark">
                    <tr>
                        <th scope="col">Наименование</th>
                        <th scope="col">Адрес</th>
                        <th scope="col">Район</th>
                        <th scope="col">Тип объекта</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('styles')
@endpush

@push('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(function () {
            let table = $('#builds-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.build.datatable.data') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'address', name: 'address'},
                    {data: 'district', name: 'district'},
                    {data: 'type_id', name: 'type_id'},
                    {data: 'actions', name: 'actions', searchable: false, orderable: false},
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Russian.json"
                },
            });
            $('.district-select').change(function () {
                console.log($(this).data('column'));
                table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
            });
            $('.type-select').change(function () {
                console.log($(this).data('column'));
                table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
            });
        });
    </script>
@endpush
