"use strict";

var Core =
{
    init: function()
    { 
          Core.setOnlyNum();
          Core.setClickClosePop();
    },

    //delete record
    Delete: function(id, table)
    {
        jQuery.SmartMessageBox({
            title : "Удалить?",
            content : "Эту операцию нельзя будет отменить.",
            buttons : '[Нет][Да]'
        }, function(ButtonPressed) {
            if (ButtonPressed === "Да") {
                jQuery.ajax({
                    type: "POST",
                    url: "/admin/delete",
                    data: { id: id, table:table},
                    dataType: 'json',
                    success: function(response) {

                        if (response.status) {

                            jQuery.smallBox({
                                title : "Запись удалена успешно",
                                content : "",
                                color : "#659265",
                                iconSmall : "fa fa-check fa-2x fadeInRight animated",
                                timeout : 4000
                            });

                            $(".tr_"+id).remove();
                        } else {
                            jQuery.smallBox({
                                title : "Что-то пошло не так, попробуйте позже",
                                content : "",
                                color : "#C46A69",
                                iconSmall : "fa fa-times fa-2x fadeInRight animated",
                                timeout : 4000
                            });
                        }
                    }
                });
            }
        });
    }, // end Delete

    //delete get paran in url
    delPrm: function(Prm)
    {
        var  Url = window.location.href;
        var a = Url.split('?');
        var re = new RegExp('(\\?|&)'+Prm+'=[^&]+','g');

        Url=('?'+a[1]).replace(re,'');
        Url=Url.replace(/^&|\?/,'');
        var dlm=(Url=='')? '': '?';

       if(typeof a[1] == "undefined") {
            return a[0];
        }

        return a[0]+dlm+Url;
    },

    //add get param in url
     setAttr: function(prmName, val)
     {
        var res = '';
        var d = location.href.split("#")[0].split("?");
        var base = d[0];
        var query = d[1];
        if (query) {
            var params = query.split("&");
            for(var i = 0; i < params.length; i++) {
                var keyval = params[i].split("=");
                if(keyval[0] != prmName) {
                    res += params[i] + '&';
                }
            }
        }
        res += prmName + '=' + val;

        return base + '?' + res;
    }, // end setAttr

    urlParam: function(name)
    {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null) {
            return null;
        } else{
            return results[1] || 0;
        }
    },//end urlParam

    // keyup event for class only_num
    setOnlyNum: function()
    {
        $(document).on("keyup", '.only_num', function () {
            var val = String($(this).val());
            var newstr = val.replace(/[^0-9]/gi,"");
            $(this).val(newstr);
        });
    },// end setOnlyNum

    //click on close popup
    setClickClosePop: function()
    {
        $(document).on('click', '#modal_form_edit .close, .modal-footer button', function (e) {
            var url = Core.delPrm("id");
            window.history.pushState(url, '', url);
        });
    } // end setClickClosePop

};

jQuery(document).ready(function() {
    Core.init();
    $.getQuery = function( query, url) {
        query = query.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
        var expr = "[\\?&]"+query+"=([^&#]*)";
        var regex = new RegExp( expr );
        var results = regex.exec( url );
        if(results !== null) {
            return results[1];
            return decodeURIComponent(results[1].replace(/\+/g, " "));
        } else {
            return false;
        }
    };
});

