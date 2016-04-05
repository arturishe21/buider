<!-- Modal -->
<div class="modal fade tb-modal" id="modal_form_edit"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog " style="width: 1100px" >
        <div class="form-preloader smoke_lol"><i class="fa fa-gear fa-4x fa-spin"></i></div>

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="modal_form_edit_label">{{__cms('Версии')}}</h4>
            </div>
            <div class="content_revisions">

            <table class="revisions">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Пользователь</td>
                        <td>Поле</td>
                        <td>Старое значение</td>
                        <td>Новое значение</td>
                        <td>Дата/Время</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                     @forelse($history as $k => $historyRecord)
                       <tr>
                        <td>{{$k+1}}</td>
                        <td><a href="/admin/tb/users/{{ $historyRecord->userResponsible()->id }}?type=revisions" target="_blank">{{ $historyRecord->userResponsible()->first_name }}</a></td>
                        <td>{{{ $historyRecord->fieldName()}}}</td>
                        <td><div class="value_old_new">{{{ $historyRecord->old_value}}}</div></td>
                        <td><div class="value_old_new">{{{ $historyRecord->new_value}}}</div></td>
                        <td>{{{ $historyRecord->created_at}}}</td>
                        <td><a onclick="TableBuilder.getReturnHistory({{$historyRecord->id}});">Вернуть изменения</a></td>
                       </tr>
                     @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px 0"><p>Изменений не было</p></td>
                        </tr>
                     @endforelse
                </tbody>
            </table>
            </div>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

