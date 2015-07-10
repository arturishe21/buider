


<section>
    <div class="tab-pane active">
                
        <ul class="nav nav-tabs tabs-pull-right">
            <label class="label pull-left" style="line-height: 32px;">{{$caption}}</label>
            @foreach ($tabs as $tab)
                @if ($loop->first)
                    <li class="active">
                @else
                    <li class="">
                @endif
                
                    <a href="#{{$pre .  $name . $tab['postfix']}}" data-toggle="tab">{{$tab['caption']}}</a>
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
                    
                    <div id="{{$pre . $name . $tab['postfix']}}-wysiwyg">{{ $tab['value'] }}</div>
                    
                    <textarea id="{{$pre . $name . $tab['postfix']}}-inner" name="{{ $name . $tab['postfix'] }}" style="display:none;" class="hidden">{{ $tab['value'] }}</textarea>

                    
                </div>
            @endforeach
            
        </div>

    </div>
</section>
