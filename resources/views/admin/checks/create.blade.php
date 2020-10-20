@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <div class="p-3 bg-form card-body-admin">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-12 col-md-10">
                <form action="{{ route('admin.checks.store') }}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <p class="font-weight-bold h2">Добавление проверки</p>
                    </div>
                    <div class="form-group">
                        <input id="aups_check" type="checkbox" name="has_aups" required>
                        <label for="aups_check"> АУПС<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-group">
                        <input id="aupt_check" type="checkbox" name="has_aupt" required>
                        <label for="aupt_check">АУПТ<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-group">
                        <input id="aupt_check" type="checkbox" name="has_cranes" required>
                        <label for="aupt_check">Кран<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-group">
                        <input id="aupt_check" type="checkbox" name="has_evacuation" required>
                        <label for="aupt_check">План эвакуации<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-group">
                        <input id="aupt_check" type="checkbox" name="has_foam" required>
                        <label for="aupt_check">Запасы пенооброзование<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-group">
                        <input id="aupt_check" type="checkbox" name="has_hydrant" required>
                        <label for="aupt_check">Гидрант<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-group">
                        <input id="aupt_check" type="checkbox" name="has_reservoir" required>
                        <label for="aupt_check">Водоем<span class="text-danger">*</span></label>
                    </div>
                    <div class="form">
                        <div class="form-group">
                            <label for="type_psp_select">Тип первичной пажаротушение:</label>
                            </br>
                            <select class="form-control-sm" name="type_psp" id="type_psp_select">
                                @foreach($typePsps as $typePsp)
                                    <option value="{{ $typePsp }}">{{ $typePsp->name }}</option>
                                @endforeach
                            </select>
                            <input name="" type="number" min="0">
                            <button class="" type="button">delete</button>
                        </div>
                    </div>
                    <input type="hidden" name="build_id" value="{{ $id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <button type="submit" title="{{ __('Добавить') }}"
                            class="btn n btn-success">{{ __('Добавить') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
