

  <table class="table  table-hover table-bordered " id="sort_t">
             <thead>
                 <tr>
                     <th style="width: 25%">{{__cms('Название')}}</th>
                     <th>{{__cms('Код')}}</th>
                     <th>{{__cms('Тип')}}</th>
                      <th>{{__cms('Группа')}}</th>
                     <th>{{__cms('Значение')}}</th>
                     <th style="width: 80px">
                      <a class="btn btn-sm btn-success" onclick="Settings.getCreateForm(this);">
                       {{__cms('Создать')}}
                      </a>
                     </th>
                 </tr>
             </thead>
             <tbody >
           @forelse($data as $k=>$el )
                <tr class="tr_{{$el->id}} " id_page="{{$el->id}}">
                    <td style="text-align: left;">
                        <a onclick="Settings.getEdit({{$el->id}})">{{$el->title}}</a>
                    </td>
                    <td><span class="select_text">Setting::get("{{$el->slug}}")</span></td>
                    <td>{{__cms(Config::get('builder::settings.type')[$el->type])}}</td>
                    <td>{{__cms(Config::get('builder::settings.groups')[$el->group_type])}}</td>
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
                                 <li>
                                     <a onclick="Settings.doDelete({{$el->id}});" style="color:red"><i class="fa red fa-times"></i> {{__cms('Удалить')}}</a>
                                 </li>
                            </ul>
                        </div>
                      </div>
                    </td>
                </tr>
            @empty
                  <tr>
                     <td colspan="5"  class="text-align-center">
                         {{__cms('Каталог пустой')}}
                      </td>
                 </tr>
            @endforelse


            </tbody>
        </table>




  <div class="dt-toolbar-footer">


      <div class="col-sm-4 col-xs-12 hidden-xs">
          <div id="dt_basic_info" class="dataTables_info" role="status" aria-live="polite">
            {{__cms('Показано')}}
          <span class="txt-color-darken listing_from">{{$data->getFrom()}}</span>
            -
          <span class="txt-color-darken listing_to">{{$data->getTo()}}</span>
           {{__cms('из')}}
          <span class="text-primary listing_total">{{$data->getTotal()}}</span>
            {{__cms('записей')}}
          </div>
      </div>
      <div class="col-xs-12 col-sm-8">
        <div id="dt_basic_paginate" class="dataTables_paginate paging_simple_numbers">
          {{$data->appends(array('group' => Input::get('group')))->links()}}
        </div>
      </div>
  </div>

