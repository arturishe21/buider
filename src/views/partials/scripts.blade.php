
<script src="{{asset('packages/vis/builder/js/libs/jquery-ui-1.10.3.min.js')}}"></script>

{{--
<script src="{{asset('packages/vis/builder/js/plugin/datatables/jquery.dataTables-cust.min.js')}}"></script>
<script src="{{asset('packages/vis/builder/js/plugin/datatables/ColReorder.min.js')}}"></script>
<script src="{{asset('packages/vis/builder/js/plugin/datatables/FixedColumns.min.js')}}"></script>
<script src="{{asset('packages/vis/builder/js/plugin/datatables/ColVis.min.js')}}"></script>
<script src="{{asset('packages/vis/builder/js/plugin/datatables/ZeroClipboard.js')}}"></script>
<script src="{{asset('packages/vis/builder/js/plugin/datatables/media/js/TableTools.min.js')}}"></script>
<script src="{{asset('packages/vis/builder/js/plugin/datatables/DT_bootstrap.js')}}"></script>
<script src="{{asset('packages/vis/builder/js/plugin/jquery-nestable/jquery.nestable.min.js')}}"></script>
<script src="{{asset('packages/vis/builder/js/plugin/x-editable/moment.min.js')}}"></script>
<script src="{{asset('packages/vis/builder/js/plugin/x-editable2/x-editable.min.js')}}"></script>

--}}


{{ Minify::javascript(
            array('/packages/vis/builder/js/app.config.js',
                  '/packages/vis/builder/js/app.min.js',
                  '/packages/vis/builder/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js',
                  '/packages/vis/builder/js/bootstrap/bootstrap.min.js',
                  '/packages/vis/builder/js/notification/SmartNotification.js',
                  '/packages/vis/builder/js/smartwidgets/jarvis.widget.min.js',
                  '/packages/vis/builder/js/plugin/jquery-validate/jquery.validate.min.js',
                  '/packages/vis/builder/js/plugin/masked-input/jquery.maskedinput.min.js',
                  '/packages/vis/builder/js/plugin/clockpicker/clockpicker.min.js',
                  '/packages/vis/builder/js/plugin/select2/select2.min.js',
                  '/packages/vis/builder/js/plugin/fastclick/fastclick.js',
                  '/packages/vis/builder/js/demo.min.js',
            /*      '/packages/module/app_modules/core/assets/js/plugin/datatables/jquery.dataTables-cust.min.js',
                  '/packages/module/app_modules/core/assets/js/plugin/datatables/ColReorder.min.js',
                  '/packages/module/app_modules/core/assets/js/plugin/datatables/FixedColumns.min.js',
                  '/packages/module/app_modules/core/assets/js/plugin/datatables/ColVis.min.js',
                  '/packages/module/app_modules/core/assets/js/plugin/datatables/ZeroClipboard.js',
                  '/packages/module/app_modules/core/assets/js/plugin/datatables/media/js/TableTools.min.js',
                  '/packages/module/app_modules/core/assets/js/plugin/datatables/DT_bootstrap.js',
                  '/packages/module/app_modules/core/assets/js/plugin/x-editable/moment.min.js',*/
                  '/packages/vis/builder/js/plugin/x-editable2/x-editable.min.js',
                  '/packages/vis/builder/js/plugin/datepicker/jquery.ui.datepicker-ru.js',
                  '/packages/vis/builder/js/plugin/datetimepicker/jquery-ui-timepicker-addon.js',
                  '/packages/vis/builder/js/plugin/datetimepicker/jquery-ui-timepicker-addon-i18n.min.js',
                  '/packages/vis/builder/js/plugin/datetimepicker/jquery-ui-sliderAccess.js',
                  )) }}


<script src="{{asset('/packages/vis/builder/js/plugin/editor_floala/js/froala_editor_all.min.js')}}"></script>

<script src='/packages/vis/builder/js/plugin/editor_floala/js/langs/{{$thisLang}}.js'></script>

<script type="text/javascript">

   langCms = "{{$thisLang}}";

   function doAjaxLoadContent(url) {
      $("#content_admin").html("{{__cms('Загрузка...')}}");
      $.post(url, {},
         function(data){
             $("#content_admin").html(data);
              window.history.pushState(url, '', url);
      });
   }

        $(document).on('click', 'nav a', function (e) {

            var href = $(this).attr('href');

            if (href) {

               $("nav li").removeClass("active");
               $(this).parent().addClass("active");

               doAjaxLoadContent(href);
               e.preventDefault();
             }
        });

        $(document).on('click', '.pagination a', function (e) {

            var href = $(this).attr('href');
            doAjaxLoadContent(href);
            e.preventDefault();
        });

$(document).ready(function() {
    pageSetUp();

    $.timepicker.regional['ru'] = {
        timeOnlyTitle: '{{__cms('Выберите время')}}',
        timeText: '{{__cms('Время')}}',
        hourText: '{{__cms('Часы')}}',
        minuteText: '{{__cms('Минуты')}}',
        secondText: '{{__cms('Секунды')}}',
        millisecText: '{{__cms('Миллисекунды')}}',
        timezoneText: '{{__cms('Часовой пояс')}}',
        currentText: '{{__cms('Сейчас')}}',
        closeText: '{{__cms('Закрыть')}}',
        timeFormat: 'HH:mm',
        amNames: ['AM', 'A'],
        pmNames: ['PM', 'P'],
        isRTL: false
    };
    $.timepicker.setDefaults($.timepicker.regional['ru']);

});

   // TBMenu.admin_uri = '{{\Config::get('builder::admin.uri')}}';
</script>