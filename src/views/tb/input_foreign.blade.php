<select

 @if (Input::has("id") && $readonly_for_edit)
     disabled
 @endif

 name="{{ $name }}" class="dblclick-edit-input form-control input-small unselectable">
    @if ($is_null)
        <option value="">{{ $null_caption ? : '...' }}</option>
    @endif

    @if ($recursive)
         @foreach ($options as $value => $caption)
              {{$caption}}
         @endforeach
    @else
         @foreach ($options as $value => $caption)
               <option value="{{ $value }}" {{$value == $selected ? "selected" : ""}} >{{ __cms($caption) }}</option>
         @endforeach
    @endif

</select>
