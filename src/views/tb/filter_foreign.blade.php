
<select name="filter[{{ $name }}]" class="form-control input-small">
    <option value=""></option>
    
    @foreach ($options as $value => $caption)
            <option value="{{ $value }}" {{($caption == $selected) ? "selected" : ""}}>{{ __cms($caption) }}</option>
    @endforeach
</select>