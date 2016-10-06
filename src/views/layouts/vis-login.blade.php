<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

        <title>{{{ __cms(Config::get('builder::admin.caption')) }}}</title>

        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Basic Styles -->
         <link rel="stylesheet" type="text/css" media="screen" href="{{asset('packages/vis/builder/css/font-awesome.min.css')}}">


        {{ Minify::stylesheet(array(
                                    '/packages/vis/builder/css/bootstrap.min.css',
                                    '/packages/vis/builder/css/smartadmin-production.min.css',
                                    '/packages/vis/builder/css/smartadmin-skins.min.css',
                                    '/packages/vis/builder/css/demo.min.css',
                                    '/packages/vis/builder/css/your_style.css'
                                    ), array('defer' => true)) }}

        {{ Minify::stylesheet('/packages/vis/builder/css/login.css', array('defer' => true)) }}


        <!-- FAVICONS -->
        <link rel="shortcut icon" href="{{ Config::get('builder::admin.favicon_url') }}" type="image/x-icon">
        <link rel="icon" href="{{ Config::get('builder::admin.favicon_url') }}" type="image/x-icon">

        <!-- GOOGLE FONT -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    </head>
    
    <body id="login" class="animated fadeInDown">

        @yield('main')
        
        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="{{asset('/packages/vis/builder/js/libs/jquery-2.0.2.min.js')}}"></script>
        <script src="{{asset('/packages/vis/builder/js/libs/jquery-ui-1.10.3.min.js')}}"></script>
        <script src="{{asset('packages/vis/builder/js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>

        <script type="text/javascript">
            //runAllForms();
            //jQuery(document).ready(function(){
                jQuery(function() {
                    // Validation
                    jQuery("#login-form").validate({
                        // Rules for form validation
                        rules : {
                            email : {
                                required : true,
                                email : true
                            },
                            password : {
                                required : true,
                                minlength : 6,
                                maxlength : 20
                            }
                        },
    
                        // Messages for form validation
                        messages : {
                            email : {
                                required : '{{__cms('Введите адрес эл.почты')}}',
                                email : '{{__cms('Введите валидный адрес эл.почты')}}'
                            },
                            password : {
                                required : '{{__cms('Введите пароль')}}'
                            }
                        },
    
                        // Do not change code below
                        errorPlacement : function(error, element) {
                            error.insertAfter(element.parent());
                        }
                    });
                });
            //});
        </script>
        
    </body>
</html>

