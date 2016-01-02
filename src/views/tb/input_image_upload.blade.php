
@if ($is_multiple)
    <div class="progress progress-micro" style="margin-bottom: 0;">
        <div class="img-progress progress-bar progress-bar-primary bg-color-redLight" role="progressbar" style="width: 0%;"></div>
    </div>
    <div class="input input-file">
        <span class="button">
            <input type="file" multiple accept="image/*" onchange="TableBuilder.uploadMultipleImages(this, '{{$name}}');">
            Выбрать
        </span>
        <input type="text"
               id="{{ $name }}"
               name="{{ $name }}"
               {{--value="{{ $value }}"--}}
               placeholder="{{__cms('Выберите изображение для загрузки')}}"
               readonly="readonly">
    </div>
    <div class="tb-uploaded-image-container">
        @if ($source)

            <ul class="dop_foto">
            @foreach ($source as $key => $image)
                <li>
                    <img class="images-attr-editable"
                         data-tbnum="{{$key}}"
                         src="{{glide($image, ['w'=>'120','h'=>'120']) }}" data_src_original = "{{$image}}" />

                    <div class="tb-btn-delete-wrap">
                        <button class="btn btn-default btn-sm tb-btn-image-delete"
                                type="button"
                                onclick="TableBuilder.deleteImage('{{ $key }}', '{{$name}}', this);">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </li>
            @endforeach
            </ul>

            <script>
                TableBuilder.storage['{{$name}}'] = jQuery.parseJSON('{{$value}}');
            </script>
        @else
            <ul  class="dop_foto"></ul>
            <div class="no_photo" style="text-align: center; ">
                {{__cms('Нет изображений')}}
            </div>
            <script>
                TableBuilder.storage['{{$name}}'] = new Array();
            </script>
        @endif
        <script>
             $('.dop_foto').sortable(
                    {
                        items: "> li",
                        update: function( event, ui ) {
                            TableBuilder.storage['{{$name}}'] = new Array();
                            $(".dop_foto li").each(function(i) {
                                srcImg = $(this).find("img").attr("data_src_original");
                                TableBuilder.storage['{{$name}}'].push(
                                   srcImg
                               );
                            });
                        }
                    }
               );
        </script>
    </div>
    <div style="clear: both"></div>
<label>

@else


    <div class="progress progress-micro" style="margin-bottom: 0;">
        <div class="img-progress progress-bar progress-bar-primary bg-color-redLight" role="progressbar" style="width: 0%;"></div>
    </div>

    <div class="input input-file">
        <span class="button">
            <input type="file" accept="image/*" onchange="TableBuilder.uploadImage(this, '{{$name}}');">
            {{__cms('Выбрать')}}
        </span>
        <input type="text" id="{{ $name }}" placeholder="{{__cms('Выберите изображение для загрузки')}}" readonly="readonly">
        <input type="hidden" value="{{$value}}" name="{{ $name }}">
    </div>

    <div class="tb-uploaded-image-container">

        @if (isset($value) && $value)
            <div style="position: relative; display: inline-block;">
                <img class="image-attr-editable"
                     data-tbident="{{$name}}"
                     src="{{ glide($value, ['w'=>$width,'h'=>$height]) }}" />
                <div class="tb-btn-delete-wrap">
                    <button class="btn btn-default btn-sm tb-btn-image-delete" type="button"
                            onclick="TableBuilder.deleteSingleImage('{{$name}}', this);">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <script>
                TableBuilder.picture['{{$name}}'] = '{{$value}}';
            </script>
        @else
            <p style="padding: 20px 0 10px 0">{{__cms('Нет изображения')}}</p>
        @endif
    </div>

@endif
