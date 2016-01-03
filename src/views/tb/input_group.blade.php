<div class="group" name="{{$name}}">
  <div class="other_section">
    @foreach($rows as $k => $filds)
     <div class="section_group">
        <p style="text-align: right"><a class="delete_group"  onclick="TableBuilder.deleteGroup(this)"><i class="fa red fa-times"></i> Удалить</a></p>
        @foreach($filds as $fild)
            <section>
                <label class="label">{{$fild['caption']}}</label>
                <div style="position: relative;">
                    <label class="input">
                     {{$fild['html']}}
                    </label>
                </div>
            </section>
         @endforeach
     </div>
    @endforeach

   </div>
    <a class="add_group" onclick="TableBuilder.addGroup(this)"><i class="fa fa-plus-square"></i> Добавить</a>
</div>
<script>
    $(".group[name={{$name}}] input, .group[name={{$name}}] textarea" ).each(function( index ) {

        if ($(this).hasClass("multiimage")) {

        }

        if ($(this).attr("name") != undefined) {
           $(this).attr("id", "{{$name}}_" + $(this).attr("name"));
           $(this).attr("name", "{{$name}}[" + $(this).attr("name")+ "][]");
        }

    });
</script>