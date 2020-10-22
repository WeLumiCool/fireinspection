<main class="pt-5 my-5" >
    <div class="container pt-5">
        <div class="p-3 bg-show">
            <div class="col-12 ">
                <p class="h2 font-weight-bold text-center text-caral">Список объектов</p>
            </div>
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <div class="row">
                        <div class="col-lg-9 col-sm-12 d-flex align-items-center">
                            <div class="form-group">
                                <label for="type">Выберите тип объекта:</label>
                                <select id="type" data-column="2" class="form-control filter-select mb-2    ">
                                    <option value="">Все</option>

                                    <option value="12">sdfsdfsd</option>
                                    <option value="12">sdfssdfsdfbcvdfsd</option>
                                    <option value="12">sdfssdfsdfdfsd</option>

                                </select>
                            </div>
                        </div>
                        <div
                            class="d-flex col-lg-3 justify-content-lg-end my-2 pr-lg-2 col-12 d-flex justify-content-center align-items-center ">
                            <a href="{{ route('create') }}" type="button"
                               class="btn btn-red  waves-effect text-right " style="padding: 8px 26px;">
                                Добавить объект
                            </a>
                        </div>
                    </div>
                    <table class="table table-bordered w-100 hover" id="builds-table">
                        <thead class="bg-red-table text-dark">
                        <tr>
                            <th scope="col">Наименование</th>
                            <th scope="col">Адрес</th>
                            <th scope="col">Район</th>
                        </tr>

                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

@push('styles')
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <style>
        #builds-table tr:hover {
            cursor: pointer;
        }
    </style>
@endpush

@push('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>

            let table;
            if (window.innerWidth < 768) {
                table = $('#builds-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('build2.datatable.data') !!}',
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'address', name: 'address'},
                        {data: 'district', name: 'district'},
                    ],
                    columnDefs: [
                        {
                            targets: [3],
                            visible: false,
                            searchable: false,
                        }
                    ],
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Russian.json"
                    },

                });
                $('.filter-select').change(function () {
                    console.log($(this).data('column'));
                    table.column($(this).data('column'))
                        .search($(this).val())
                        .draw();
                });
                $('#builds-table').addClass("compact");
            } else {
                table = $('#builds-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('build2.datatable.data') !!}',
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'address', name: 'address'},
                        {data: 'district', name: 'district'},
                    ],
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Russian.json"
                    },
                });
                $('.filter-select').change(function () {
                    console.log($(this).data('column'));
                    table.column($(this).data('column'))
                        .search($(this).val())
                        .draw();
                })

            }

            $('#builds-table tbody').on('click', 'tr', function () {
                let data = table.row(this).data();
                window.location.href = window.location.origin + '/show/' + data.id;
            });
    </script>
{{--    <script>--}}

{{--            $('#builds-table').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                ajax: '{!! route('build2.datatable.data') !!}',--}}
{{--                columns: [--}}
{{--                    {data: 'name', name: 'name'},--}}
{{--                    {data: 'address', name: 'address'},--}}
{{--                    {data: 'district', name: 'district'},--}}
{{--                ],--}}
{{--                "language": {--}}
{{--                    "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Russian.json"--}}
{{--                },--}}
{{--            });--}}
{{--            // $('.filter-select').change(function () {--}}
{{--            //     console.log($(this).data('column'));--}}
{{--            //     table.column($(this).data('column'))--}}
{{--            //         .search($(this).val())--}}
{{--            //         .draw();--}}
{{--            // })--}}
{{--            $('#builds-table tbody').on('click', 'tr', function () {--}}
{{--                let data = table.row(this).data();--}}
{{--                window.location.href = window.location.origin + '/show/' + data.id;--}}
{{--            });--}}
{{--    </script>--}}
@endpush
