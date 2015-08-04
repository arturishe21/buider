 <div class="{{$fieldEdit}}">
    {{$pageEditor->$field}}
 </div>

<link rel="stylesheet" type="text/css" media="screen" href="{{asset('/packages/vis/builder/js/plugin/editor_floala/css/froala_editor_all.min.css')}}">
<script src="{{asset('/packages/vis/builder/js/plugin/editor_floala/js/froala_editor_all.min.js')}}"></script>
<script src="{{asset('/packages/vis/builder/js/plugin/editor_floala/js/langs/ru.js')}}"></script>
<script>

      $('.{{$fieldEdit}}').editable(
          {
              inlineMode: true,
              alwaysVisible: true,
              imageUploadURL: '/admin/upload_image',
              minHeight:100,
              fileUploadURL: "/admin/upload_file",
              imagesLoadURL: "/admin/load_image",
              imageDeleteURL: "/admin/delete_image",
              language: 'ru',
              countCharacters: false
          });
         $("a[href='http://editor.froala.com']").parent().hide();
         $('.{{$fieldEdit}}').on('editable.contentChanged', function (e, editor) {
             var textEditor = $('.{{$fieldEdit}}').editable("getHTML", true, true);

             $.post("/admin/quick_edit", { id : "{{$pageEditor->id}}", model: "{{get_class($pageEditor)}}", text : textEditor, field : "{{$field}}" },
                    function(data){

              });
         });
</script>