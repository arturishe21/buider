<textarea rows="{{$rows or '3'}}"
          class="custom-scroll"
          id="{{$name}}"
          name="{{ $name }}">{{ $value }}</textarea>
@if (isset($comment) && $comment)
  <div class="note">
      {{$comment}}
  </div>
@endif