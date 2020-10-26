@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <div class="p-3 bg-form card-body-admin">

        <div class="row">
            <div class="col-sm-12 table-responsive">
                <div class="row justify-content-end mb-3">
                    <div class="col-auto">
                        <a href="{{ route('admin.builds.create') }}" class="btn btn-success">{{ __('Создать') }}</a>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="builds-table">
                    <thead class="bg-red-table text-dark">
                    <tr>
                        <th scope="col">Наименование</th>
                        <th scope="col">Адрес</th>
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
                    {data: 'type_id', name: 'type_id'},
                    {data: 'actions', name: 'actions', searchable: false, orderable: false},
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Russian.json"
                },
            });
            // $('.filter-select').change(function () {
            //     console.log($(this).data('column'));
            //     table.column($(this).data('column'))
            //         .search($(this).val())
            //         .draw();
            // })
        });
    </script>
@endpush
