@if (isset($def['actions']['filter']))
     <form name="filter">
       <table>
        <tr>
            <td>
                {{$def['actions']['filter']['caption'] or ""}}
            </td>
            @if(isset($def['actions']['filter']['fields']) && count($def['actions']['filter']['fields']))
                @foreach($def['actions']['filter']['fields'] as $field)
                     <td>
                           <section>
                               <div style="position: relative;">
                                   <label class="input">
                                       <select {{isset($field['width']) ? "style='width:".$field['width']."px'" : ""}} class="dblclick-edit-input form-control input-small unselectable" name="filter[{{$field['name_field']}}]">
                                           <option  value="">{{$field['caption']}}</option>
                                           @if (isset($field['options']) && count($field['options']))
                                                @foreach($field['options'] as $option)
                                                 <option value="{{{$option['value']}}}"
                                                 {{Input::get("filter.".$field['name_field']) == $option['value'] ? "selected" : ""}}>
                                                 {{{$option['title']}}}</option>
                                                @endforeach
                                           @endif

                                       </select>
                                   </label>
                               </div>
                           </section>
                        </td>
                @endforeach
            @endif
        </tr>
       </table>
    </form>
    <script>
        $("form[name=filter] select").change(function(){
            var urlFilter = $("form[name=filter]").serialize();
            doAjaxLoadContent(window.location.pathname + "?" +urlFilter);
        });
    </script>
 @endif