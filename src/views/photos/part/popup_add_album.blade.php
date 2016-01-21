<div id="popup_add_album" class="modal fade in" data-backdrop="static" aria-hidden="false" aria-labelledby="myModalLabel" role="dialog">
    <div class="modal-dialog " data-width="620px">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button"> × </button>
                <h4 id="modal_form_label" class="modal-title">Создание альбома</h4>
            </div>
            <div class="modal-body">
                <form id="create_form" class="smart-form" novalidate="novalidate" action="" method="post">
                    <label class="input">
                        <input class="dblclick-edit-input form-control input-sm unselectable" type="text" placeholder="Введите название альбома" name="title" value="">
                    </label>
                    <input type="hidden" name="id_parent_album" value="{{$idAlbum}}">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-sm" type="button" onclick="jQuery('#create_form').submit();">
                    <span class="glyphicon glyphicon-floppy-disk"></span>
                    Сохранить
                </button>
                <button class="btn btn-default" data-dismiss="modal" type="button"> Отмена </button>
            </div>
        </div>
    </div>
</div>
