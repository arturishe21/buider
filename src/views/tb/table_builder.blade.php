<div id="{{ $def['options']['ident'] }}" class="widget-box table-builder dataTables_wrapper">

        @include('admin::tb.form')
        @include('admin::tb.table')
        
        @include('admin::tb.ui_overlay')

        <iframe id="submiter" name="submiter" style="display:none; visibility:hidden;"></iframe>                    
    </div>



</div>

<script type="text/javascript">
//jQuery(document).ready(function() {
    TableBuilder.optionsInit({
        ident: '{{ $def['options']['ident'] }}',
        table_ident: '{{ $def['options']['table_ident'] }}',
        form_ident: '{{ $def['options']['form_ident'] }}',
        action_url: '{{ $def['options']['action_url'] }}'

    });
   // TableBuilder.options.is_page_form = false;

    TableBuilder.action_url = '{{ $def['options']['action_url'] }}';
    TableBuilder.admin_prefix = '{{ $def['options']['admin_uri'] }}';
//});
</script>