
    <li>
           <a href="{{ url(sprintf($def['link'], $row[$def['params'][0]])) }}"><i class="fa fa-{{$def['icon']}}"></i> {{ $def['caption'] or 'Edit #'. $row['id'] }}</a>
    </li>
