<!-- Modal -->
<div  class="modal fade" id="modal_form" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog <?php echo isset($def['options']['is_form_fullscreen']) ? 'tb-modal-fullscreen' : '';?>"
    @if (isset($def['options']['form_width']))
        style="width: {{$def['options']['form_width']}};" data-width="{{$def['options']['form_width']}}" 
    @endif
    >

        <div class="form-preloader smoke_lol"><i class="fa fa-gear fa-4x fa-spin"></i></div>

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="modal_form_label">{{__cms('Создание')}}</h4>
            </div>
            
            @include('admin::tb.form_create')


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@include('admin::tb.form_create_validation')
