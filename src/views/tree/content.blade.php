
<div class="tb-tree-content-inner">

@if ($current->hasTableDefinition())
    @section('table_form')
        {{ $form }}
    @stop
        {{ $table }}
@else

    <div class="smart-form">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{__cms('Название')}}</th>
                <th>{{__cms('Шаблон')}}</th>
                <th>Url</th>
                <th style="width: 60px">{{__cms('Активный')}}</th>
                <th style="width: 80px">
                    <a href="javascript:void(0);" onclick="Tree.showCreateForm('{{$current->id}}');" style="min-width: 70px;" class="btn btn-success btn-sm">{{__cms('Добавить')}}</a>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach($current['children'] as $item)
                @include('admin::tree.content_row')
            @endforeach

        </tbody>

        <tfoot>
        </tfoot>

    </table>
    </div>

    <script>
    TableBuilder.action_url = "";
    //alert(TableBuilder.action_url);

    // FIXME: move to js file
        $(document).ready(function(){
            $('.tpl-editable').editable2({
                url: window.location.href,
                source: [
                <?php /* FIXME: */ $tpls = \Config::get('builder::tree.templates', array()); ?>
                @foreach ($tpls as $capt => $tpl)
                    { value: '{{{$capt}}}', text: '{{{$capt}}}' }, 
                @endforeach
                ],
                display: function(value, response) {
                    return false;   //disable this method
                },
                success: function(response, newValue) {
                    $(this).html('$' + newValue);
                },
                params: function(params) {
                    //originally params contain pk, name and value
                    params.query_type = 'do_update_node';
                    return params;
                }
            });
        });
    </script>

@endif
    
</div>