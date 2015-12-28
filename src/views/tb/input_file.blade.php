@if ($is_multiple)
    <div class="progress progress-micro" style="margin-bottom: 0;">
        <div class="img-progress progress-bar progress-bar-primary bg-color-redLight" style="width: 0%;" role="progressbar"></div>
    </div>
    <div class="input input-file">
        <span class="button">
            <input type="file" multiple onchange="TableBuilder.uploadFileMulti(this, '{{$name}}');">
            Выбрать
        </span>
        <input type="text"
               id="{{ $name }}"
               value=""
               placeholder="Выберите файлы для загрузки"
               readonly="readonly">
    </div>
    </label>
    <label>
    <div class="tb-uploaded-file-container-{{$name}} uploaded-files">
        <ul>
            @if($value && is_object($value))
                @foreach($value as $file)
                    <li>
                        {{basename($file)}} <a href="{{$file}}" target="_blank">Скачать</a>
                        <a class="delete" onclick="TableBuilder.doDeleteFile(this)">Удалить</a>
                        <input type="hidden" class="file_multi" nameident = "{{$name}}" value="{{$file}}">
                    </li>
                @endforeach
            @endif
        </ul>
        <script>
         TableBuilder.doSortFileUpload();
        </script>
    </div>

@else
    <div class="progress progress-micro" style="margin-bottom: 0;">
        <div class="img-progress progress-bar progress-bar-primary bg-color-redLight" style="width: 0%;" role="progressbar"></div>
    </div>
     <div class="input input-file">
         <span class="button">
             <input type="file" onchange="TableBuilder.uploadFile(this, '{{$name}}');">
             Выбрать
         </span>
         <input type="text"
                id="{{ $name }}"
                name="{{ $name }}"
                value="{{ $value }}"
                placeholder="@if($value) {{$value}} @else Выберите файл для загрузки @endif"
                readonly="readonly">
     </div>
    </label>
    <label>
     <div class="tb-uploaded-file-container-{{$name}}">
         @if ($value)
         <a href="{{url($value)}}" target="_blank">Скачать</a>
         @endif
     </div>

@endif


