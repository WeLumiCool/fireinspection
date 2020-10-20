<div class="modal fade" id="addStages" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление этапа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" method="post" id="save_form" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="lRSZckGY12PQBKdVynYP3XPk08QwYPERybXujFn7">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="stage_field"> Дата проверки:<span class="text-danger">*</span></label>
                        <input id="stage_field" type="date" class="form-control" name="date" required="">
                    </div>
                    <div class="form-group">
                        <label for="stage_field">АУПС:<span class="text-danger">*</span></label>
                        <input id="stage_field" type="checkbox" class="form-control w-25" name="aups" required="">
                    </div>
                    <div class="form-group">
                        <label for="stage_field">АУПТ:<span class="text-danger">*</span></label>
                        <input id="stage_field" type="checkbox" class="form-control w-25" name="aupt" required="">
                    </div>
                    <div class="form-group">
                        <label for="stage_field">Первичные средства пожаротушения:<span
                                class="text-danger">*</span></label>
                        <input id="stage_field" type="text" class="form-control" name="sredstva-tusheniya" required="">
                    </div>
                    <div class="form-group">
                        <label for="stage_field">Колличество средств пожаротушения:<span
                                class="text-danger">*</span></label>
                        <input id="stage_field" type="number" class="form-control" name="sredstva-tusheniya-count"
                               required="">
                    </div>
                    <div class="form-group">
                        <label for="stage_field">Водоснабжение (пожарный гидрант, водоем):<span
                                class="text-danger">*</span></label>
                        <input id="stage_field" type="checkbox" class="form-control w-25" name="images[]" accept="image/*"
                               required="" multiple="">
                    </div>
                    <div class="form-group">
                        <label for="stage_field">Внутренние противопожарные краны (наличие):<span
                                class="text-danger">*</span></label>
                        <input id="stage_field" type="checkbox" class="form-control w-25" name="images[]" accept="image/*"
                               required="" multiple="">
                    </div>
                    <div class="form-group">
                        <label for="stage_field">Планы эвакуации (наличие):<span class="text-danger">*</span></label>
                        <input id="stage_field" type="checkbox" class="form-control w-25" name="images[]" accept="image/*"
                               required="" multiple="">
                    </div>
                    <div class="form-group">
                        <label for="stage_field">Запасы пенообразования:<span class="text-danger">*</span></label>
                        <input id="stage_field" type="checkbox" class="form-control w-25" name="images[]" accept="image/*"
                               required="" multiple="">
                    </div>
                    <div class="form-group">
                        <label for="note_field">Примечание:<span class="text-danger">*</span></label>
                        <textarea id="note_field" class="form-control" name="note" required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="save_button" type="submit" class="btn btn-primary waves-effect waves-light">Сохранить
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
