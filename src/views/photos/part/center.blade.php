<table id="tb-tree-table" class="table table-bordered table_album ">
    <thead>
        <tr>
            <th class="text-left">
                <a class="node_link" href="?id_album=1">Фотогалерея</a>
                /
                @foreach($breadcrumbs as $page)
                  @if ($page->id != 1)
                    <a class="node_link" href="?id_album={{$page->id}}">{{$page->title}}</a> /
                  @endif
                @endforeach
                <p class="table_album_action_a">
                    <a class="add_album" onclick="Photo.getFormAddAlbum()">Добавить альбом</a>
                    <a class="add_photo">Добавить фотографии</a>
                </p>
            </th>
        </tr>
    </thead>
</table>
<div class="content_all_photo">
    @forelse($alboums as $album)
      <div class="one_photo" onclick="Photo.doOpenAlbum({{$album->id}})">
          <div class="fa fa-folder"></div>
          <p>{{$album->title}}</p>
      </div>
    @empty
       <div class="empty_album"> Пусто в каталоге</div>
    @endforelse

    <div style="clear: both"></div>
</div>

    @include("admin::photos.part.popup_add_album")
    <script src="/packages/vis/builder/photos.js"></script>
<script>
     $("title").text("{{__cms('Фотогалерея')}} - {{{ __cms(Config::get('builder::admin.caption')) }}}");
</script>