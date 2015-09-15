<tr data-id="{{ $item->id }}">
    <td>
    @if($item->children()->count())
        <i class="fa fa-folder"></i>
    @else
        <i class="fa fa-file-code-o"></i>
    @endif
     <a href="?node={{ $item->id }}">{{ $item->title }}</a></td>
    <td>
        <a class="tpl-editable" href="javascript:void(0);" 
            data-type="select" 
            data-name="template" 
            data-pk="{{ $item->id }}" 
            data-value="{{{ $item->template }}}" 
            data-original-title="{{__cms("Выберите шаблон")}}">
                {{{ $item->template }}}
        </a>
    </td>
    
    <td style="white-space: nowrap;">{{ $item->slug }}</td>
    <td style="position: relative;">
        @if (\Config::get('builder::tree.node_active_field.options'))
            <div class="node-active-smoke-lol" style="display:none; position: absolute; width: 100%; height: 100%; top: 0; background: #E5E5E5; left: 0px; z-index: 69; opacity: 0.6;"></div>
            <table>
            <tbody>
                <?php foreach(\Config::get('builder::tree.node_active_field.options') as $setIdent => $caption): ?>
                    <tr style="white-space: nowrap;">
                    <td>
                        <span class="">
                            {{$caption}}: 
                        </span>
                    </td>
                    <td>
                        <span class="onoffswitch">
                            <input onchange="Tree.activeSetToggle(this, '{{$item->id}}');" type="checkbox" name="onoffswitch[{{$setIdent}}]" 
                                    class="onoffswitch-checkbox" 
                                    @if ($item->isActive($setIdent)) checked="checked" @endif 
                                    id="myonoffswitch{{$item->id}}-{{$setIdent}}">
                            <label class="onoffswitch-label" for="myonoffswitch{{$item->id}}-{{$setIdent}}"> 
                                <span class="onoffswitch-inner" data-swchon-text="{{__cms('ДА')}}" data-swchoff-text="{{__cms("НЕТ")}}"></span>
                                <span class="onoffswitch-switch"></span> 
                            </label> 
                        </span>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        @else
            <span class="onoffswitch">
                <input onchange="Tree.activeToggle('{{$item->id}}', this.checked);" type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" @if ($item->is_active) checked="checked" @endif id="myonoffswitch{{$item->id}}">
                <label class="onoffswitch-label" for="myonoffswitch{{$item->id}}"> 
                    <span class="onoffswitch-inner" data-swchon-text="{{__cms('ДА')}}" data-swchoff-text="{{__cms("НЕТ")}}"></span>
                    <span class="onoffswitch-switch"></span> 
                </label> 
            </span>
        @endif
    </td>
    <td style="text-align: center">
       <div style="display: inline-block">
         <div class="btn-group hidden-phone pull-right">
              <a class="btn dropdown-toggle btn-default"  data-toggle="dropdown"><i class="fa fa-cog"></i> <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url($item->getUrl()) }}?show=1" target="_blank"><i class="fa fa-eye"></i> {{__cms('Предпросмотр')}} </a></li>
                        <li>
                            <a onclick="Tree.showEditForm('{{ $item->id }}');">
                                <i class="fa fa-pencil"></i>
                                {{__cms("Редактировать")}}
                            </a>
                        </li>
                        <li>
                            <a onclick="Tree.doDelete('{{ $item->id }}', this);" class="node-del-{{$item->id}}" style="color: red">
                                <i class="fa fa-times"></i>
                                {{__cms('Удалить')}}
                            </a>
                        </li>
                    </ul>
         </div>
    </div>
    </td>
</tr>