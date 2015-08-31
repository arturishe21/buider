<li>
    <a href="{{ url(sprintf($def['link'], $row[$def['params'][0]])) }}"><i class="fa fa-{{$def['icon']}}"></i>
    {{ __cms($def['caption'])  }}
    </a>
</li>
