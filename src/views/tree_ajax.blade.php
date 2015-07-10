 <link rel="stylesheet" href="/packages/vis/builder/js/plugin/jstree/themes/default/style.min.css" />
 <link rel="stylesheet" href="{{ asset('packages/vis/builder/js/plugin/resizableColumns/jquery.resizableColumns.css') }}" type="text/css" media="screen" title="no title" charset="utf-8"/>

 <div id="table-preloader" class="smoke_lol"><i class="fa fa-gear fa-4x fa-spin"></i></div>

    <p ><a class="show_hide_tree">{{__cms('Показать дерево')}}</a></p>

    <div id="tree_top">
        <div class="tree_top_content">@include('admin::tree.tree')</div>
    </div>    
    
    <table id="tb-tree-table" class="table table-bordered">
        <thead>
          <tr>
            <th class="text-left">@include('admin::tree.content_header')</th>
          </tr>
        </thead>
        <tbody>
         <tr>
            <td class="tree-td tree-dark" style="padding: 0px; vertical-align: top;text-align: left;">
                {{ $content }}
            </td>
         </tr>
        </tbody>
    </table>
 @include('admin::tree.create_modal')


<script src="/packages/vis/builder/js/plugin/jstree/jstree.min.js"></script>
<script src="{{ asset('packages/vis/builder/js/plugin/resizableColumns/jquery.resizableColumns.js') }}"></script>
<script src="{{ asset('packages/vis/builder/js/plugin/resizableColumns/store.js') }}"></script>

<script src="{{ asset('packages/vis/builder/tb-tree.js') }}"></script>
<script>
    Tree.admin_prefix = '{{ Config::get('builder::admin.uri') }}';
    Tree.parent_id = '{{ $current->id }}';

    $(".show_hide_tree").click(function(){
         $("#tree_top").toggle();

         if($(".show_hide_tree").text() == "{{__cms('Показать дерево')}}") {
            $(".show_hide_tree").text("{{__cms('Спрятать дерево')}}")
         } else {
           $(".show_hide_tree").text("{{__cms('Показать дерево')}}")
         }
    });

 $(".breadcrumb").html("<li><a href='/admin'>{{__cms('Главная')}}</a></li> <li>{{__cms('Структура сайта')}}</li>");
    $("title").text("{{__cms('Структура сайта')}} - {{{ __cms(Config::get('builder::admin.caption')) }}}");
</script>

