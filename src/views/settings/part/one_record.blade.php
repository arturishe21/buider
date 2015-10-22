<td style="text-align: left;">
    <a onclick="Settings.getEdit({{$el->id}})">{{{$el->title}}}</a>
</td>
<td><span class="select_text">Setting::get("{{$el->slug}}")</span></td>
<td>{{__cms(Config::get('builder::settings.type')[$el->type])}}</td>
<td>{{__cms(isset(Config::get('builder::settings.groups')[$el->group_type])? Config::get('builder::settings.groups')[$el->group_type] : "")}}</td>
<td>
  @if($el->type==1 || $el->type==6)
        <a onclick="Settings.getEdit({{$el->id}})">{{__cms('Тексовое поле')}}</a>
  @elseif($el->type==2)
        <a onclick="Settings.getEdit({{$el->id}})">{{__cms('Список')}}</a>
  @elseif($el->type==3)
        <a onclick="Settings.getEdit({{$el->id}})">{{__cms('Двойной список')}} </a>
   @elseif($el->type==5)
         <a onclick="Settings.getEdit({{$el->id}})">{{__cms('Тройной список')}}</a>
  @elseif($el->type==4)
        <a href="{{$el->value}}" target="_blank">{{{basename($el->value)}}}</a>
  @else
        {{{$el->value}}}
  @endif
</td>
<td>
 <div style="display: inline-block">
    <div class="btn-group hidden-phone pull-right">
        <a class="btn dropdown-toggle btn-default"  data-toggle="dropdown"><i class="fa fa-cog"></i> <i class="fa fa-caret-down"></i></a>
        <ul class="dropdown-menu pull-right" id_rec ="{{$el->id}}">
             <li>
                <a class="edit_record" onclick="Settings.getEdit({{$el->id}})"><i class="fa fa-pencil"></i> {{__cms('Редактировать')}}</a>
             </li>
            {{-- <li>
                 <a onclick="Settings.doDelete({{$el->id}});" style="color:red"><i class="fa red fa-times"></i> {{__cms('Удалить')}}</a>
             </li>--}}
        </ul>
    </div>
  </div>
</td>