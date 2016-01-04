<input
@if ($is_password)
    type="password"
    @if ((isset($value) && $value))
        value="password"
    @endif
@else
    type="text"
    value="{{{ $value }}}"
@endif
    id="{{$name}}"
    name="{{ $name }}"
placeholder="{{{ $placeholder }}}"
@if ($mask)
    data-mask="{{$mask}}"
@endif
class="dblclick-edit-input form-control input-sm unselectable" />
