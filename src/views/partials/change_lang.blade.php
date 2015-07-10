@if(Config::get("jarboe::translate_cms.langs"))
   <?
    $this_lang_cms = Cookie::get("lang_admin") ? : Config::get("jarboe::translate_cms.lang_default");
   ?>

    <ul class="header-dropdown-list hidden-xs">
        <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             <img alt="" src="/packages/vis/builder/img/flags/{{$this_lang_cms == "ua" ? "ukr" : $this_lang_cms}}.png">
             <span> {{Config::get("jarboe::translate_cms.langs")[$this_lang_cms]}} </span> <i class="fa fa-angle-down"></i> </a>
            <ul class="dropdown-menu pull-right">

              @foreach(Config::get("jarboe::translate_cms.langs") as $alias => $title)

                <li {{$this_lang_cms == $alias ? "class='active'" : ""}}>
                    <a href="{{route("change_lang")."?lang=".$alias}}"><img src="/packages/vis/builder/img/flags/{{$alias == "ua" ? "ukr" : $alias }}.png"> {{$title}}</a>
                </li>
              @endforeach

            </ul>
        </li>
    </ul>
@endif