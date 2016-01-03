<section>
    <div class="tab-pane active">
                
        <ul class="nav nav-tabs tabs-pull-right">
            <label class="label pull-left" style="line-height: 32px;">{{__cms($caption)}}</label>
            @foreach ($tabs as $tab)
                @if ($loop->first)
                    <li class="active">
                @else
                    <li class="">
                @endif
                    <a href="#{{$pre .  $name . $tab['postfix']}}" data-toggle="tab">{{__cms($tab['caption'])}}</a>
                </li>
            @endforeach
        </ul>
        
        <div class="tab-content padding-5">
            @foreach ($tabs as $tab)
                @if ($loop->first)
                    <div class="tab-pane active" id="{{ $pre . $name . $tab['postfix']}}">
                @else
                    <div class="tab-pane" id="{{ $pre . $name . $tab['postfix']}}">
                @endif
                    <textarea toolbar = "{{$toolbar}}" id="{{$pre . $name . $tab['postfix']}}-wysiwyg" name="{{ $name . $tab['postfix'] }}" class="text_block">{{ $tab['value'] }}</textarea>
                </div>
            @endforeach
        </div>
    </div>
</section>


