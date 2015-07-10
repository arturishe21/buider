
        <aside id="left-panel">

            <div class="login-info">
                <span>
                    <a >
                        <img src="/packages/vis/builder/img/no_photo_user.jpg" class="online">
                        <span>
                            {{$user->email}}
                        </span>
                    </a>
                </span>
            </div>
            <!-- end user info -->
            <nav>
                <ul style="display: block;">
                    @foreach($menu as $k=>$el)
                         <li {{isset($el['link']) &&  Request::URL() == URL::to("/admin".$el['link'])?"class='active'":""}}>
                             <a  {{isset($el['link']) && !isset($el['submenu'])?"href='/admin".$el['link']."'":""}}>
                                <i class="fa fa-lg fa-fw fa-{{$el['icon']}}"></i>
                                <span class="menu-item-parent">{{__cms($el['title'])}}</span>
                             </a>

                              @if(isset($el['submenu']))
                               <ul>
                                  @foreach($el['submenu'] as $k_sub_menu=>$sub_menu)
                                    <li {{Request::URL() == URL::to("/admin".$sub_menu['link'])?"class='active'":""}}>
                                        <a href="/admin{{$sub_menu['link']}}">{{__cms($sub_menu['title'])}}</a>
                                    </li>
                                  @endforeach

                                </ul>
                             @endif
                        </li>
                    @endforeach
                </ul>
             </nav>
            <span class="minifyme" data-action="minifyMenu"> 
                <i class="fa fa-arrow-circle-left hit"></i> 
            </span>

        </aside>
        <!-- END NAVIGATION -->