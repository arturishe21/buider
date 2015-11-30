<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <title> @yield('title') - {{{ __cms(Config::get('builder::admin.caption')) }}}</title>
        <meta name="description" content="">
        <meta name="author" content="VIS-A-VIS">


        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- FAVICONS -->
        <link rel="shortcut icon" href="{{ Config::get('builder::admin.favicon_url') }}" type="image/x-icon">

        <!-- Basic Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

        {{ Minify::stylesheet(array(
                                    '/packages/vis/builder/css/bootstrap.min.css',
                                    '/packages/vis/builder/css/smartadmin-production-plugins.min.css',
                                    '/packages/vis/builder/css/smartadmin-production.min.css',
                                    '/packages/vis/builder/css/smartadmin-skins.min.css',
                                    '/packages/vis/builder/css/smartadmin-rtl.min.css',
                                    '/packages/vis/builder/css/demo.min.css',
                                    '/packages/vis/builder/css/table-builder.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/froala_editor.min.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/froala_style.min.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/plugins/code_view.min.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/plugins/colors.min.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/plugins/emoticons.min.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/plugins/image_manager.min.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/plugins/image.min.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/plugins/line_breaker.min.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/plugins/table.min.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/plugins/char_counter.min.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/plugins/video.min.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/plugins/fullscreen.min.css',
                                    '/packages/vis/builder/js/plugin/editor_floala/css/plugins/file.min.css',
                                    '/packages/vis/builder/js/plugin/jstree/themes/default/style.min.css',
                                    '/packages/vis/builder/js/plugin/resizableColumns/jquery.resizableColumns.css',
                                    '/packages/vis/builder/css/your_style.css'
                                    ));
         }}

        <!-- GOOGLE FONT -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <script src="{{asset('packages/vis/builder/js/libs/jquery-2.0.2.min.js')}}"></script>
       {{-- <script src="/packages/vis/builder/js/translate_phrase_{{$thisLang}}.js"></script>--}}
        <script src="{{asset('packages/vis/builder/js/core.js')}}"></script>
        <script src="{{asset('packages/vis/builder/js/slug_generate.js')}}"></script>

        <script src="{{asset('packages/vis/builder/table-builder.js')}}"></script>

        @yield('styles')
        @yield('scripts_header')

    </head>
    <body class="{{ Cookie::get('tb-misc-body_class', '') }} {{ $skin }}">

        <div id="modal_wrapper"></div>
        <div class="table_form_create">

        </div>

        @include('admin::partials.header')
        @include('admin::partials.navigation')

        <!-- MAIN PANEL -->
        <div id="main" role="main">

            <div id="main-content">
                <div id="ribbon">
                    @yield('ribbon')
                </div>

                <div id="content">
                    @yield('headline')
                    <div id="content">
                            <div class="row" id="content_admin">
                                @yield('main')
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN PANEL -->
        @include('admin::partials.scripts')

        @yield('scripts')

        @include('admin::partials.translate_phrases')

        <div class="load_page" style="position: absolute; display: none; z-index: 1111111; height: 50px; top: 10px; left: 50%"><i class="fa fa-spinner fa-spin" style="font-size: 30px"></i></div>

    </body>

</html>