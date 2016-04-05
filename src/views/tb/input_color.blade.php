
<input id="{{$name}}"
       name="{{$name}}"
       @if (isset($value))
         value="{{{ $value }}}"
       @endif
       type="text" 
       class="form-control input-sm unselectable">

 @if (isset($comment) && $comment)
   <div class="note">
       {{$comment}}
   </div>
 @endif
<script>
jQuery(document).ready(function() {
    $('#{{$name}}').colorpicker().on('changeColor.colorpicker', function(event){
       $("#{{$name}}").val(event.color.toHex());
     });
});
</script>