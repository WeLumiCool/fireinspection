@extends('admin.layouts.dashboard')

@section('dashboard_content')
    <div class="p-3 bg-form card-body-admin">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-10 col-md-10">
                <form action="{{ route('admin.stages.update', $stage) }}" method="post" id="save_form"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="stage_field"> Этап:<span class="text-danger">*</span></label>
                        <input id="stage_field" type="text" class="form-control" name="stage"
                               value="{{ $stage->stage }}" required>
                    </div>
                    <div class="form-group">
                        <label for="stage_field">Описание:<span class="text-danger">*</span></label>
                        <textarea id="stage_field" class="form-control" name="desc"
                                  required>{{ $stage->desc }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="stage_field">Дата проверки:<span
                                    class="text-danger">*</span></label>
                        <input id="stage_field" type="date" class="form-control" name="date"
                               value="{{ date('Y-m-d', strtotime($stage->date)) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="stage_field">Наименование докуметов:<span
                                    class="text-danger">*</span></label>
                        <input id="stage_field" type="text" class="form-control" name="document"
                               value="{{ $stage->document }}" required>
                    </div>
                    <div class="form-group">
                        <label for="stage_field">Докуметы:<span class="text-danger">*</span></label>
                        <input id="stage_field" type="file" class="form-control" name="document_scan[]"
                               multiple>
                    </div>
                    <div class="form-group">
                        <label for="stage_field">Изображения:<span class="text-danger">*</span></label>
                        <input id="stage_field" type="file" class="form-control" name="images[]"
                               multiple>
                    </div>
                    <div class="form-group">
                        <label for="stage_field">Примечание:<span class="text-danger">*</span></label>
                        <input id="stage_field" type="text" class="form-control" name="note" value="{{ $stage->note }}"
                               required>
                    </div>
                    <div class="form-group">
                        <label class="mutable-req" for="project_field">
                            АКТ оценки соотвествия вводимого в эксплуатацию
                            завершенного строительства объекта:</label>
                        <input id="project_field" type="file" class="form-control files-input" name="certificate[]"
                               accept="application/pdf" multiple>
                    </div>
                    <input id="build_id" type="hidden" name="build_id" value="{{ $stage->build->id }}">
                    <button id="save_button" type="submit" class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
