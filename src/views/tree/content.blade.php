
<div class="tb-tree-content-inner">


    <div class="smart-form">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px"></th>
                <th>{{__cms('Название')}}</th>
                <th>{{__cms('Шаблон')}}</th>
                <th>Url</th>
                <th style="width: 60px">{{__cms('Активный')}}</th>
                <th style="width: 80px">
                    <a href="javascript:void(0);" onclick="Tree.showCreateForm('{{$current->id}}');" style="min-width: 70px;" class="btn btn-success btn-sm">{{__cms('Добавить')}}</a>
                </th>
            </tr>
        </thead>
        <tbody class="ui-sortable">

            @if($current->parent_id)
                <tr>
                    <td colspan="6">
                        <a href="?node={{$current->parent_id}}" class="node_link">&larr; Назад</a>
                    </td>
                </tr>
            @endif
            @foreach($current['children'] as $item)
                @include('admin::tree.content_row')
            @endforeach
        </tbody>

        <tfoot>
        </tfoot>

    </table>
    </div>

    <script>
        $(document).ready(function(){
            TableBuilder.action_url = "/admin/handle/{{$treeName}}";
            $('.tpl-editable').editable2({
                url: window.location.href,
                source: [
                <?php $tpls = \Config::get('builder::' . $treeName . '.templates', array()); ?>
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

    
</div>