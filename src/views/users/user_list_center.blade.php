<div class="jarviswidget jarviswidget-color-blue" id="wid-id-1" >
      <header>
          <span class="widget-icon"> <i class="fa fa-table"></i> </span>
          <h2>Управление пользователями</h2>
      </header>

      <!-- widget div-->
       <div class="table_center no-padding">
          <table class="table  table-hover table-bordered " id="sort_t">
              <thead>
                  <tr>
                  @if(isset($fields))
                      @foreach ($fields as $ident => $field)
                          <th>{{ $field['caption'] }}</th>
                      @endforeach
                  @endif
                      <th class="e-insert_button-cell">
                          <a href="{{ url(\Config::get('builder::admin.uri') .'/tb/users/create') }}">
                          <button class="btn btn-default btn-sm" style="min-width: 66px;"
                                  type="button" onclick="TableBuilder.getCreateForm();">
                              Добавить
                          </button>
                          </a>
                      </th>
                  </tr>
              </thead>

              <tbody>

                  @foreach ($users as $user)
                  <tr>
                    @if(isset($fields))
                      @foreach ($fields as $ident => $field)
                          @if ($ident == 'password')
                              <td>********</td>
                          @elseif ($ident == 'id')
                              <td style="width: 1%;">{{ $user->$ident }}</td>
                          @else
                              <td>{{ $user->$ident }}</td>
                          @endif
                      @endforeach
                    @endif

                      <td style="width: 1%;">
                          <a href="{{ url(\Config::get('builder::admin.uri') .'/tb/users/'. $user->id) }}">
                              <button type="button" class="btn btn-default btn-sm" rel="tooltip" title="" data-placement="bottom" data-original-title="Update">
                                  <i class="fa fa-pencil"></i>
                              </button>
                          </a>
                          <button onclick="TBUser.doRemoveUser(this, '{{$user->id}}');" type="button" class="btn btn-default btn-sm" rel="tooltip" title="" data-placement="bottom" data-original-title="Remove">
                              <i class="fa fa-remove"></i>
                          </button>
                      </td>

                  </tr>
                  @endforeach
              </tbody>

          </table>

  </div>
  </div>

<script src="{{asset('packages/vis/builder/tb-user.js')}}"></script>
<script>

    TBUser.admin_uri = '{{Config::get('builder::admin.uri')}}';

   $(".breadcrumb").html("<li><a href='/admin'>Главная</a></li> <li>Управление пользователями</li>");
   $("title").text("Управление пользователями - {{{ Config::get('builder::admin.caption') }}}");
 </script>