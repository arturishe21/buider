<td style="width: 80px">
 @if(count($def['actions']))
  <div style="display: inline-block">
       <div class="btn-group hidden-phone pull-right">
            <a class="btn dropdown-toggle btn-default"  data-toggle="dropdown"><i class="fa fa-cog"></i> <i class="fa fa-caret-down"></i></a>
            <ul class="dropdown-menu">

                @if (isset($def['actions']['custom']))
                       @foreach ($def['actions']['custom'] as $button)
                           {{ $actions->fetch('custom', $row, $button) }}
                       @endforeach
                @endif

                {{ $actions->fetch('update', $row) }}
                {{ $actions->fetch('clone', $row) }}
                {{ $actions->fetch('revisions', $row) }}
                {{ $actions->fetch('preview', $row) }}
                {{ $actions->fetch('views_statistic', $row) }}
                {{ $actions->fetch('delete', $row) }}

            </ul>
        </div>
    </div>
  @endif
</td>
