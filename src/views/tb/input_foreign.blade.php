
<select name="{{ $name }}" class="dblclick-edit-input form-control input-small unselectable">
    @if ($is_null)
        <option value="">{{ $null_caption ? : '...' }}</option>
    @endif

    @foreach ($options as $value => $caption)
       <option value="{{ $value }}" {{$value == $selected ? "selected" : ""}} >{{ __cms($caption) }}</option>
    @endforeach
</select>
