@extends('admin.layouts.dashboard')
@section('dashboard_content')
    <div class="container bg-form card-body-admin py-4">
        <div class="row p-4 " id="show_articles">
            <div class="col-2">id</div>
            <div class="col-10">{{ $typeBuild->id }}</div>
            <div class="col-2">Заголовок:</div>
            <div class="col-10">{{ $typeBuild->name }}</div>
            <div class="col-2">Пункт проверок:</div>
            <div class="col-10">
            @foreach($points as $item)
                {{ $item->name }},
            @endforeach
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        #show_articles .col-2, #show_articles .col-10 {
            padding-top: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #dcdcdd;
        }
        #show_articles .col-2 {
            border-right: 1px solid #dcdcdd;
        }
    </style>
@endpush
