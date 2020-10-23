@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <div class="p-3 bg-form card-body-admin">
        <div class="row">
            <div class="col-sm-12 table-responsive">
                <table class="table table-striped  table-hover" id="histories-table">
                    <thead class="bg-red-table text-dark">
                    <tr>
                        <th scope="col">Пользователь</th>
                        <th scope="col">Событие</th>
                        <th scope="col">Объект</th>
                        <th scope="col">Этап</th>
                        <th scope="col">Дата</th>
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
            $('#histories-table').DataTable({
                processing: true,
                serverSide: true,
                {{--ajax: '{!! route('admin.history.datatable.data', $build) !!}',--}}
                {{--columns: [--}}
                {{--    {data: 'user_id', name: 'user_id'},--}}
                {{--    {data: 'action', name: 'action'},--}}
                {{--    {data: 'object_id', name: 'object_id'},--}}
                {{--    {data: 'stage_id', name: 'stage_id'},--}}
                {{--    {data: 'created_at', name: 'created_at'},--}}
                {{--]--}}
            });
        });
    </script>
@endpush






