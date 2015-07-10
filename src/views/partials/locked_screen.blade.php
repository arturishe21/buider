
<form id="locked-screen-form" class="smart-form animated flipInY" action="{{url('login')}}" style="width: 450px;margin: 100px auto 0;">
    <header>
    </header>

    <fieldset>
        
        <section>
            <label class="label">{{trans('jarboe::login.email')}}</label>
            <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="email" name="email">
                <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> {{trans('jarboe::login.email_tooltip')}}</b></label>
        </section>

        <section>
            <label class="label">{{trans('jarboe::login.password')}}</label>
            <label class="input"> <i class="icon-append fa fa-lock"></i>
                <input type="password" name="password">
                <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> {{trans('jarboe::login.password_tooltip')}}</b> </label>
        </section>
        
        @if (\Config::get('builder::login.is_active_remember_me'))
        <section>
            <label class="checkbox">
                <input type="checkbox" name="remember" checked="checked">
                <i></i>{{trans('jarboe::login.remember_me')}}</label>
        </section>
        @endif
    </fieldset>
    <footer>
        <button type="submit" class="btn btn-primary submit_button">
            {{trans('jarboe::login.sign_in')}}
        </button>
    </footer>
</form>

<script>
 $(document).ajaxComplete(function(event, xhr, settings) {
        if (xhr.status == 401) {
            $('#locked-screen').show();
            $('.tb-modal:visible').addClass('superbox-modal-hide').hide();
        } else if (xhr.status == 500) {
            var response = $.parseJSON(xhr.responseText);
            $.bigBox({
                title : response.error.type,
                content : '<p style="overflow-y: auto; word-break: break-all; height: 100px;">'+ response.error.message +"<br>@"+ response.error.line +"<br>"+ response.error.file +'</p>',
                color : "#C79121",
                icon : ""
            });
        }
    });

    $('#locked-screen-form').submit(function(event) {
        jQuery.ajax({
            type: "POST",
            url: $('#locked-screen-form').attr('action') +'?is_from_locked_screen=12',
            data: $('#locked-screen-form').serializeArray(),
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#locked-screen').hide();
                    $('#locked-screen-form')[0].reset();

                    TableBuilder.hidePreloader();
                    TableBuilder.hideFormPreloader(TableBuilder.form_edit);
                    TableBuilder.hideFormPreloader(TableBuilder.form);
                    $('.superbox-modal-hide').removeClass('superbox-modal-hide').show();
                } else {
                    TableBuilder.showErrorNotification(response.error);
                }
            }
        });
        event.preventDefault();
    });
    jQuery("#locked-screen-form").validate({
        // Rules for form validation
        rules : {
            email : {
                required : true,
                email : true
            },
            password : {
                required : true,
                minlength : 3,
                maxlength : 20
            }
        },
        // Messages for form validation
        messages : {
            email : {
                required : '{{trans('jarboe::login.email_required')}}',
                email : '{{trans('jarboe::login.email_valid')}}'
            },
            password : {
                required : '{{trans('jarboe::login.password_required')}}'
            }
        },
        // Do not change code below
        errorPlacement : function(error, element) {
            error.insertAfter(element.parent());
        }
    });

</script>

