<ul>
    @foreach($item->children()->get(array('id', 'title', 'parent_id')) as $child)
        @if ($child->children()->count())
            <li data-id="{{$child->id}}" data-parent-id="{{$child->parent_id}}">
                {{$child->title}}
                @include('admin::tree.node_children', array('item' => $child))
            </li>
        @else
            <li data-id="{{$child->id}}" data-parent-id="{{$child->parent_id}}">
                @include('admin::tree.node', array('item' => $child))
            </li>
        @endif
    @endforeach
</ul>


