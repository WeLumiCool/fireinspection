@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <div class="p-3 bg-form card-body-admin">
        <div class="row">
            <div class="col-sm-12 table-responsive">
                <div class="row justify-content-end pb-2">
                    <div class="col-auto">
                        <a href="{{ route('admin.types.create') }}" class="btn btn-success">{{ __('Создать') }}</a>
                    </div>
                </div>

                    <table class="table table-striped  table-hover" id="types-table">
                        <thead class="bg-primary text-light">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">actions</th>
                        </tr>
                        </thead>
                    </table>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(function () {
            $('#types-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.type.datatable.data') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'actions', name: 'actions', searchable: false, orderable: false},
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Russian.json"
                },
            });
        });
    </script>
@endpush
