'use strict';

var TableBuilder = {

    options: null,
    storage: {},
    picture: {},
    admin_prefix: '',
    action_url: '',
    table: '#widget-grid',
    preloader: '#table-preloader',
    form_preloader: '.form-preloader',
    form: '#modal_form',
    form_edit: '#modal_form_edit',
    export_form: '#tb-export-form',
    form_label: '#modal_form_edit_label',
    form_wrapper: '#modal_wrapper',
    image_storage_wrapper: '#modal_image_storage_wrapper',
    create_form: '#create_form',
    edit_form: '#edit_form',
    filter: '#filters-row :input',
    is_page_form: false,

    onDoEdit: null,
    onDoCreate: null,
    afterGetEditForm: null,
    onGetCreateForm: null,

    init: function(options)
    {
        TableBuilder.options = TableBuilder.getOptions(options);

        TableBuilder.initDoubleClickEditor();
        TableBuilder.initSearchOnEnterPressed();
        TableBuilder.initSelect2Hider();
    }, // end init

    optionsInit : function(options)
    {
        TableBuilder.options = TableBuilder.getOptions(options);
    },

    initFroalaEditor: function () {

        var langEditor = "en";

        if (langCms == "ua") {
            langEditor = "uk";
        } else {
            langEditor = langCms;
        }

        $('.text_block').froalaEditor(
            {
                inlineMode: false,
                imageUploadURL: '/admin/upload_image',
                heightMin: 100,
                heightMax: 500,
                fileUploadURL: "/admin/upload_file",
                imageManagerLoadURL: "/admin/load_image",
                imageDeleteURL: "/admin/delete_image",
                language: langEditor
            });

        $("a[href='https://froala.com/wysiwyg-editor']").parent().remove();
    },

    getActionUrl: function()
    {
        return TableBuilder.action_url ? TableBuilder.action_url : '/admin/handle/tree';
    }, // end getActionUrl

    initSearchOnEnterPressed: function()
    {
        jQuery('.filters-row input').keypress(function(event) {
            var keyCode   = event.keyCode ? event.keyCode : event.which;
            var enterCode = '13';

            if (keyCode == enterCode) {
                TableBuilder.search();
                event.preventDefault();
            }
        });
    }, // end initSearchOnEnterPressed

    getOptions: function(options) {
        var defaultOptions = {
            lang: {},
            ident: null,
            table_ident: null,
            form_ident: null,
            action_url: null,
            list_url: null,
            is_page_form: false,
            onSearchResponse: null,
            onFastEditResponse: null,
            onShowEditFormResponse: null
        };

        var options = jQuery.extend(defaultOptions, options);

        TableBuilder.checkOptions(options);

        return options;
    }, // end getOptions

    checkOptions: function(options)
    {
        var requiredOptions = [
            'ident',
            'table_ident',
            'form_ident',
            'action_url'
        ];

        jQuery.each(requiredOptions, function(index, value) {
            if (typeof options[value] === null) {
                alert('TableBuilder: ['+ value +'] is required option.' );
            }
        });
    }, // end checkOptions

    lang: function (ident) {
        if (typeof TableBuilder.options.lang[ident] != "undefined") {
            return TableBuilder.options.lang[ident];
        }

        return ident;
    }, // end lang

    search: function()
    {
        TableBuilder.showProgressBar();

        var $form = jQuery('#'+ TableBuilder.options.table_ident);

        var data = $form.serializeArray();
        data.push({ name: "query_type", value: "search" });
        data.push({ name: "__node", value: TableBuilder.getUrlParameter('node') });

        /* Because serializeArray() ignores unset checkboxes and radio buttons: */
        data = data.concat(
            $form.find('input[type=checkbox]:not(:checked)')
                .map(function() {
                    return {"name": this.name, "value": 0};
                }).get()
        );

        var $posting = jQuery.post(TableBuilder.getActionUrl(), data);

        $posting.done(function(response) {
            doAjaxLoadContent(location.href);
            // window.location.replace(window.location.origin + window.location.pathname + window.location.search);
        });

    }, // end search

    showProgressBar: function()
    {
        jQuery('#'+TableBuilder.options.ident).find('.ui-overlay').fadeIn();
    }, // end showProgressBar

    hideProgressBar: function()
    {
        jQuery('#'+TableBuilder.options.ident).find('.ui-overlay').fadeOut();
    }, // end hideProgressBar


    closeFastEdit: function(context, type, response)
    {
        var $editElem = jQuery(context).parent().parent();
        $editElem.removeClass('dblclick-edit-opened');
        var $elem = $editElem.find(".dblclick-edit");

        if (type == 'cancel') {
            // var previousValue = $elem.attr('previous-value');
            var previousValue = $elem.parent().find('.tb-previous-value').text();
            $elem.html(previousValue);
            $editElem.find(".dblclick-edit-input").val(previousValue);
        } else if (type == 'close') {
            $elem.html(response.value);
        }
    }, // end closeFastEdit

    saveFastEdit: function(context, rowId, rowIdent)
    {
        TableBuilder.showProgressBar();

        var $context = jQuery(context).parent().parent();
        var value = $context.find('.dblclick-edit-input').val();

        var data = [
            {name: "query_type", value: "fast_save"},
            {name: "id", value: rowId},
            {name: "name", value: rowIdent},
            {name: "value", value: value}
        ];

        var $posting = jQuery.post(TableBuilder.getActionUrl(), data);

        $posting.done(function(response) {
            TableBuilder.hideProgressBar();

            if (jQuery.isFunction(TableBuilder.options.onFastEditResponse)) {
                TableBuilder.options.onFastEditResponse(response);
            }
            TableBuilder.closeFastEdit(context, 'close', response);
        });
    }, // end saveFastEdit

    getUrlParameter: function(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return sParameterName[1];
            }
        }
    }, // end getUrlParameter

    getCreateForm: function()
    {
        // FIXME:
        if (TableBuilder.onGetCreateForm) {
            TableBuilder.onGetCreateForm();
        }
        TableBuilder.showPreloader();

        if ($(".table_form_create #modal_form").size() == 0) {
            $.post(TableBuilder.getActionUrl(),{"query_type" : "show_add_form"},
                function(data){
                    $(".table_form_create").html(data);
                    jQuery(TableBuilder.form).modal('show');
                    TableBuilder.initFroalaEditor();
                    TableBuilder.hidePreloader();
                });
        } else {
            jQuery(TableBuilder.form).modal('show');
            TableBuilder.hidePreloader();
        }

    }, // end getCreateForm

    initSelect2Hider: function()
    {
        jQuery('.modal-dialog').on('click', function() {
            jQuery('.select2-enabled[id^="many2many"]').select2("close");
            jQuery('.select2-hidden-accessible').hide();
        });

    }, // end initSelect2Hider

    getCloneForm: function(id)
    {
        $.post( TableBuilder.getActionUrl(), {"query_type" : "clone_record", "id" : id})
            .done(function( data ) {
                doAjaxLoadContent(location.href);
            }).fail(function(xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);
                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            });
    },

    handleStartLoad: function()
    {
        var idPage = Core.urlParam('id');
        if ($.isNumeric(idPage)) {
            TableBuilder.getEditForm(idPage);
        }

        var idRevisionPage = Core.urlParam('revision_page');
        if ($.isNumeric(idRevisionPage)) {
            TableBuilder.getRevisions(idRevisionPage);
        }

    }, // end handleStartLoad

    getEditForm: function(id, context)
    {
        var urlPage = "?id=" + id;
        window.history.pushState(urlPage, '', urlPage);

        TableBuilder.showPreloader();
        TableBuilder.flushStorage();
        jQuery('#wid-id-1').find('tr[data-editing="true"]').removeAttr('data-editing');

        var data = [
            {name: "query_type", value: "show_edit_form"},
            {name: "id", value: id},
            {name: "__node", value: TableBuilder.getUrlParameter('node')}
        ];

        jQuery.ajax({
            type: "POST",
            url: TableBuilder.getActionUrl(),
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    jQuery(TableBuilder.form_wrapper).html(response.html);
                    TableBuilder.initFroalaEditor();

                    jQuery(TableBuilder.form_edit).modal('show').css("top", $(window).scrollTop());;
                    jQuery(TableBuilder.form_edit).find('input[data-mask]').each(function() {
                        var $input = jQuery(this);
                        $input.mask($input.attr('data-mask'));
                    });
                } else {
                    TableBuilder.showErrorNotification("Что-то пошло не так, попробуйте позже");
                }

                TableBuilder.hidePreloader();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }
        });
    }, // end getEditForm

    getRevisions: function(id, context)
    {
        var urlPage = "?revision_page=" + id;
        window.history.pushState(urlPage, '', urlPage);
        TableBuilder.showPreloader();

        var data = [
            {name: "query_type", value: "show_revisions"},
            {name: "id", value: id},
        ];
        jQuery.ajax({
            type: "POST",
            url: TableBuilder.getActionUrl(),
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    jQuery(TableBuilder.form_wrapper).html(response.html);
                    jQuery(TableBuilder.form_edit).modal('show').css("top", $(window).scrollTop());
                } else {
                    TableBuilder.showErrorNotification("Что-то пошло не так, попробуйте позже");
                }

                TableBuilder.hidePreloader();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }
        });
    },

    getReturnHistory: function(id)
    {
        var data = [
            {name: "query_type", value: "return_revisions"},
            {name: "id", value: id},
        ];
        jQuery.ajax({
            type: "POST",
            url: TableBuilder.getActionUrl(),
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.status) {

                    TableBuilder.showSuccessNotification("Сохранено");

                    jQuery(TableBuilder.form_edit).modal('hide');
                    window.history.back();
                    return;

                } else {
                    TableBuilder.showErrorNotification("Что-то пошло не так, попробуйте позже");
                }

                TableBuilder.hidePreloader();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }
        });
    },

    doDelete: function(id, context)
    {
        jQuery.SmartMessageBox({
            title : phrase["Удалить?"],
            content : phrase["Эту операцию нельзя будет отменить."],
            buttons : '[' + phrase["Нет"] + '][' + phrase["Да"] + ']'
        }, function(ButtonPressed) {
            if (ButtonPressed === phrase["Да"]) {
                TableBuilder.showPreloader();

                jQuery.ajax({
                    type: "POST",
                    url: TableBuilder.getActionUrl(),
                    data: { id: id, query_type: "delete_row", "__node": TableBuilder.getUrlParameter('node') },
                    dataType: 'json',
                    success: function(response) {

                        if (response.status) {

                            TableBuilder.showSuccessNotification(phrase['Поле удалено успешно']);
                            jQuery('tr[id-row="'+id+'"]').remove();
                        } else {
                            TableBuilder.showErrorNotification(phrase["Что-то пошло не так, попробуйте позже"]);
                        }

                        TableBuilder.hidePreloader();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        var errorResult = jQuery.parseJSON(xhr.responseText);

                        TableBuilder.showErrorNotification(errorResult.message);
                        TableBuilder.hidePreloader();
                    }
                });

            }

        });
    }, // end doDelete

    doEdit: function(id)
    {

        TableBuilder.showPreloader();
        TableBuilder.showFormPreloader(TableBuilder.form_edit);

        var values = jQuery(TableBuilder.edit_form).serializeArray();
        values.push({ name: 'id', value: id });
        values.push({ name: 'query_type', value: "save_edit_form" });
        values.push({ name: "__node", value: TableBuilder.getUrlParameter('node') });

        // take values from temp storage (for images)
        jQuery.each(values, function(index, val) {
            if (typeof TableBuilder.storage[val.name] !== 'undefined') {

                var json = JSON.stringify(TableBuilder.storage[val.name]);
                values[index] = {
                    name:  val.name,
                    value: json
                };

            }
            if (typeof TableBuilder.picture[val.name] !== 'undefined') {
                values[index] = {
                    name:  val.name,
                    value: TableBuilder.picture[val.name]
                };
            }
        });

        // FIXME:
        if (TableBuilder.onDoEdit) {
            values = TableBuilder.onDoEdit(values);
        }

        /* Because serializeArray() ignores unset checkboxes and radio buttons: */
        values = values.concat(
            jQuery(TableBuilder.edit_form).find('input[type=checkbox]:not(:checked)')
                .map(function() {
                    return {"name": this.name, "value": 0};
                }).get()
        );

        var selectMultiple = [];
        jQuery(TableBuilder.edit_form).find('select[multiple="multiple"]').each(function(i, value) {
            if (!$(this).val()) {
                selectMultiple.push({"name": this.name, "value": ''});
            }
        })

        jQuery.ajax({
            type: "POST",
            url: TableBuilder.getActionUrl(),
            data: values,
            dataType: 'json',
            success: function(response) {

                TableBuilder.hideFormPreloader(TableBuilder.form_edit);

                if (response.id) {

                    TableBuilder.showSuccessNotification(phrase['Сохранено']);

                    if (TableBuilder.options.is_page_form) {
                        //window.location.href = TableBuilder.options.list_url;
                        window.history.back();
                        return;
                    }

                    jQuery(TableBuilder.form_edit).modal('hide');

                    jQuery('#wid-id-1').find('tr[id-row="'+id+'"]').replaceWith(response.html);

                } else {

                    var errors = '';
                    jQuery(response.errors).each(function(key, val) {
                        errors += val +'<br>';
                    });

                    TableBuilder.showBigErrorNotification(errors);
                }
                TableBuilder.hidePreloader();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }
        });
    }, // end doEdit

    removeInputValues: function(context)
    {
        jQuery(':input', context)
            .removeAttr('checked')
            .removeAttr('selected')
            .not(':button, :submit, :reset, input[type="hidden"], :radio, :checkbox')
            .val('');
        jQuery('textarea', context).text('');

        jQuery('input, textarea', context).removeClass('valid').removeClass('invalid');
        jQuery('.state-success, .state-error', context).removeClass('state-success').removeClass('state-error');
    }, // end removeInputValues

    doCreate: function()
    {
        TableBuilder.showPreloader();
        TableBuilder.showFormPreloader(TableBuilder.form);

        var values = jQuery(TableBuilder.create_form).serializeArray();
        values.push({ name: "query_type", value: "save_add_form" });
        values.push({ name: "__node", value: TableBuilder.getUrlParameter('node') });

        // take values from temp storage (for images)
        jQuery.each(values, function(index, val) {
            if (typeof TableBuilder.storage[val.name] !== 'undefined') {
                var json = JSON.stringify(TableBuilder.storage[val.name]);
                values[index] = {
                    name:  val.name,
                    value: json
                };
            }

            if (typeof TableBuilder.picture[val.name] !== 'undefined') {
                values[index] = {
                    name:  val.name,
                    value: TableBuilder.picture[val.name]
                };
            }
        });

        var selectMultiple = [];
        jQuery(TableBuilder.create_form).find('select[multiple="multiple"]').each(function(i, value) {
            if (!$(this).val()) {
                selectMultiple.push({"name": this.name, "value": ''});
            }
        })

        values = values.concat(selectMultiple);

        // FIXME:
        if (TableBuilder.onDoCreate) {
            values = TableBuilder.onDoCreate(values);
        }

        /* Because serializeArray() ignores unset checkboxes and radio buttons: */
        values = values.concat(
            jQuery(TableBuilder.create_form).find('input[type=checkbox]:not(:checked)')
                .map(function() {
                    return {"name": this.name, "value": 0};
                }).get()
        );

        jQuery.ajax({
            type: "POST",
            url: TableBuilder.getActionUrl(),
            data: values,
            dataType: 'json',
            success: function(response) {
                TableBuilder.hideFormPreloader(TableBuilder.form);

                if (response.id) {
                    TableBuilder.showSuccessNotification(phrase['Новоя запись добавлена']);

                    if (TableBuilder.options.is_page_form) {
                        //window.location.href = TableBuilder.options.list_url;
                        window.history.back();
                        return;
                    }

                    jQuery('#wid-id-1').find('tbody').prepend(response.html);

                    TableBuilder.removeInputValues(TableBuilder.form);
                    jQuery(TableBuilder.form).modal('hide');

                } else {
                    var errors = '';
                    jQuery(response.errors).each(function(key, val) {
                        errors += val +'<br>';
                    });
                    TableBuilder.showBigErrorNotification(errors);
                }

                TableBuilder.hidePreloader();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }

        });
    }, // end doCreate

    showPreloader: function()
    {
        jQuery(TableBuilder.preloader).show();
    }, // end showPreloader

    hidePreloader: function()
    {
        jQuery(TableBuilder.preloader).hide();
    }, // end hidePreloader

    showFormPreloader: function(context)
    {
        jQuery(TableBuilder.form_preloader, context).show();
    }, // end showPreloader

    hideFormPreloader: function(context)
    {
        jQuery(TableBuilder.form_preloader, context).hide();
    }, // end hidePreloader

    uploadImage: function(context, ident)
    {
        var data = new FormData();
        data.append("image", context.files[0]);
        data.append('ident', ident);
        data.append('query_type', 'upload_photo');

        data.append('__node', TableBuilder.getUrlParameter('id_tree'));

        var $progress = jQuery(context).parent().parent().parent().parent().parent().find('.progress-bar');
        //console.log($progress);

        jQuery.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    console.log(evt);
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = percentComplete * 100;
                        percentComplete = percentComplete +'%';
                        $progress.width(percentComplete);
                    }
                }, false);

                xhr.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                    }
                }, false);

                return xhr;
            },
            data: data,
            type: "POST",
            url: TableBuilder.getActionUrl(),
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status) {
                    $progress.width('0%');

                    TableBuilder.picture[ident] = response.data.sizes.original;

                    var html = '<div style="position: relative; display: inline-block;">';
                    html += '<img class="image-attr-editable" ';
                    html +=      'data-tbident="'+ ident +'" ';
                    html +=      ' src="'+ response.link +'" />';
                    html += ' <div class="tb-btn-delete-wrap">';
                    html += '    <button class="btn btn-default btn-sm tb-btn-image-delete" ';
                    html += '            type="button" ';
                    html += '            onclick="TableBuilder.deleteSingleImage(\''+ ident +'\', this);">';
                    html += '        <i class="fa fa-times"></i>';
                    html += '    </button>';
                    html += ' </div>';
                    html += '</div>';

                    // FIXME: too ugly to execute
                    jQuery(context).parent().parent().parent().parent().find('.tb-uploaded-image-container').html(html);


                } else {
                    TableBuilder.showErrorNotification(phrase["Ошибка при загрузке изображения"]);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }
        });
    }, // end uploadImage

    uploadMultipleImages: function(context, ident)
    {
        $(".no_photo").hide();
        var arr = context.files;
        for (var index = 0; index < arr.length; ++index) {

            var data = new FormData();
            data.append("image", context.files[index]);
            data.append('ident', ident);
            data.append('query_type', 'upload_photo');

            if (TableBuilder.getUrlParameter('node') == undefined) {
                data.append('__node', TableBuilder.getUrlParameter('id_tree'));
            } else {
                data.append('__node', TableBuilder.getUrlParameter('node'));
            }

            var $progress = jQuery(context).parent().parent().parent().parent().parent().find('.progress-bar');

            var num = 0;

            if (typeof TableBuilder.storage[ident] !== 'undefined') {
                num = TableBuilder.storage[ident].length;
            }
            data.append('num', num);

            jQuery.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        console.log(evt);
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = percentComplete * 100;
                            console.log('upl :' + percentComplete);

                            percentComplete = percentComplete + '%';
                            //Do something with upload progress here

                            $progress.width(percentComplete);
                        }
                    }, false);

                    xhr.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            console.log('dwl :' + percentComplete);
                            //Do something with download progress
                        }
                    }, false);

                    return xhr;
                },
                data: data,
                type: "POST",
                url: TableBuilder.getActionUrl(),
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status) {

                        $progress.width('0%');


                        TableBuilder.storage[ident].push(
                            response.data.sizes.original
                        );
                        //  alert(TableBuilder.storage[ident].length)

                        var html = '';
                        html += '<li>';
                        html += '<img src="' + response.link + '" class="images-attr-editable" ' +
                        'data-tbnum="' + num + '" ' +
                        'data-tbalt="" ' +
                        'data-tbtitle="" ' +
                        'data_src_original="'+response.data.sizes.original+'"'+
                        'data-tbident="' + ident + '" />';
                        html += '<div class="tb-btn-delete-wrap">';
                        html += '<button class="btn btn-default btn-sm tb-btn-image-delete" '
                        html += 'type="button" '
                        html += "onclick=\"TableBuilder.deleteImage('" + num + "','" + ident + "', this);\">"
                        html += '<i class="fa fa-times"></i>'
                        html += '</button>'
                        html += '</div>';
                        html += '</li>';

                        // FIXME: too ugly to execute
                        jQuery(context).parent().parent().parent().parent().find('.tb-uploaded-image-container').children().append(html);

                    } else {

                        TableBuilder.showErrorNotification(phrase["Ошибка при загрузке изображения"]);

                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorResult = jQuery.parseJSON(xhr.responseText);

                    TableBuilder.showErrorNotification(errorResult.message);
                    TableBuilder.hidePreloader();
                }
            });
        }
    }, // end uploadMultipleImages

    deleteImage: function(num, ident, context)
    {
        var $li = jQuery(context).parent().parent();
        num = $li.index();
        $li.remove();

        // remove deleted image from storage
        var arr_img = TableBuilder.storage[ident];

        arr_img.splice(num, 1);
    }, // end deleteImage

    deleteSingleImage: function(ident, context)
    {
        var $imageWrapper = jQuery(context).parent().parent();
        $imageWrapper.hide();
        TableBuilder.picture[ident] = "";
    }, // end deleteSingleImage

    doChangeSortingDirection: function(ident, context)
    {
        // TableBuilder.showPreloader();

        var $context = jQuery(context);

        var isAscDirection = $context.hasClass('sorting_asc');
        var direction = isAscDirection ? 'desc' : 'asc';

        var vals = [
            {name: "query_type", value: "change_direction"},
            {name: "direction", value: direction},
            {name: "field", value: ident},
            {name: "__node", value: TableBuilder.getUrlParameter('node')}
        ];

        jQuery.ajax({
            data: vals,
            type: "POST",
            url: TableBuilder.getActionUrl(),
            cache: false,
            dataType: "json",
            success: function(response) {
                doAjaxLoadContent(window.location.href);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);
                TableBuilder.showErrorNotification(errorResult.message);
            }
        });
    }, // end doChangeSortingDirection


    uploadFile: function(context, ident)
    {
        var data = new FormData();
        data.append("file", context.files[0]);
        data.append('query_type', 'upload_file');
        data.append('ident', ident);
        data.append('__node', TableBuilder.getUrlParameter('node'));

        jQuery.ajax({
            data: data,
            type: "POST",
            url: TableBuilder.getActionUrl(),
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status) {
                    jQuery(context).parent().next().val(response.short_link);

                    var html = '<a href="'+ response.link +'" target="_blank">Скачать</a>';
                    jQuery(context).parent().parent().next().html(html);
                } else {
                    TableBuilder.showErrorNotification("Ошибка при загрузке файла");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }
        });
    }, // end uploadFile

    showErrorNotification: function(message)
    {
        jQuery.smallBox({
            title : message,
            content : "",
            color : "#C46A69",
            iconSmall : "fa fa-times fa-2x fadeInRight animated",
            timeout : 10000,
            class : "error"
        });
    }, // end showErrorNotification

    showSuccessNotification: function(message)
    {
        jQuery.smallBox({
            title : message,
            content : "",
            color : "#659265",
            iconSmall : "fa fa-check fadeInRight animated",
            timeout : 3000
        });
    }, // end showSuccessNotification

    doEmbedToText: function($summernote, text)
    {
        jQuery.ajax({
            type: "POST",
            // FIXME: move action url to options
            url: TableBuilder.admin_prefix +'/tb/embed-to-text',
            data: {text: text},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    console.log(response);
                    var html = $summernote.code().replace(text, response.html);
                    $summernote.code('').html(html);
                } else {
                    TableBuilder.showErrorNotification(phrase['Что-то пошло не так, попробуйте позже']);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }
        });
    }, // end doEmbedToText

    setPerPageAmount: function(perPage)
    {
        TableBuilder.showProgressBar();

        var data = {
            query_type: "set_per_page",
            per_page: perPage,
            "__node": TableBuilder.getUrlParameter('node')
        };

        var $posting = jQuery.post(TableBuilder.getActionUrl(), data);
        $posting.done(function(response) {
            window.location.replace(window.location.origin + window.location.pathname + window.location.search);
            //window.location.replace(response.url);
        });
    }, // end setPerPageAmount

    doExport: function(type)
    {
        TableBuilder.showPreloader();

        var $iframe = jQuery("#submiter");

        var values = jQuery(TableBuilder.export_form).serializeArray();
        values.push({ name: 'type', value: type });
        values.push({ name: 'query_type', value: "export" });

        var out = new Array();
        jQuery.each(values, function(index, val) {
            out.push(val['name'] +'='+ val['value']);
        });

        if (document.location.search) {
            var url = document.location.pathname + document.location.search + '&' + out.join('&');
        } else {
            var url = document.location.pathname +'?'+ out.join('&');
        }

        $iframe.attr('src', url);

        TableBuilder.hidePreloader();
    }, // end doExport

    flushStorage: function()
    {
        TableBuilder.storage = {};
    }, // end flushStorage

    showBigErrorNotification: function(errors)
    {
        jQuery.bigBox({
            content : errors,
            color   : "#C46A69",
            icon    : "fa fa-warning shake animated"
        });
    }, // end showBigErrorNotification

    doImport: function(context, type)
    {
        TableBuilder.showPreloader();

        var data = new FormData();
        data.append("file", context.files[0]);
        data.append('type', type);
        data.append('query_type', 'import');

        jQuery.SmartMessageBox({
            title : "Произвести импорт?",
            content : "Результат импорта нельзя отменить",
            buttons : '[Нет][Да]'
        }, function(ButtonPressed) {
            if (ButtonPressed === "Да") {

                jQuery.ajax({
                    data: data,
                    type: "POST",
                    url: TableBuilder.getActionUrl(),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status) {
                            TableBuilder.showSuccessNotification('Импорт прошел успешно');
                        } else {
                            if (typeof response.errors === "undefined") {
                                TableBuilder.showErrorNotification('Что-то пошло не так');
                            } else {
                                var errors = '';
                                jQuery(response.errors).each(function(key, val) {
                                    errors += val +'<br>';
                                });
                                TableBuilder.showBigErrorNotification(errors);
                            }
                        }
                        TableBuilder.hidePreloader();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        var errorResult = jQuery.parseJSON(xhr.responseText);

                        TableBuilder.showErrorNotification(errorResult.message);
                        TableBuilder.hidePreloader();
                    }
                });

            } else {
                TableBuilder.hidePreloader();
            }
        });
    }, // end doImport

    doDownloadImportTemplate: function(type)
    {
        TableBuilder.showPreloader();

        var $iframe = jQuery("#submiter");

        var values = new Array();
        values.push('type='+ type);
        values.push('query_type=get_import_template');

        var url = document.location.pathname +'?'+ values.join('&');

        $iframe.attr('src', url);

        TableBuilder.hidePreloader();
    }, // end doDownloadImportTemplate

    doSelectAllMultiCheckboxes: function(context)
    {
        var isChecked = jQuery('input', context).is(':checked');
        var $multiActionCheckboxes = jQuery('.multi-checkbox input');

        $multiActionCheckboxes.prop('checked', isChecked);
    }, // end doSelectAllMultiCheckboxes

    doMultiActionCall: function(type)
    {
        TableBuilder.showPreloader();

        var values = jQuery('#'+ TableBuilder.options.table_ident).serializeArray();
        values.push({ name: 'type', value: type });
        values.push({ name: 'query_type', value: 'multi_action' });
        values.push({ name: '__node', value: TableBuilder.getUrlParameter('node') });

        jQuery.ajax({
            type: "POST",
            url: TableBuilder.getActionUrl(),
            data: values,
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    if (response.is_hide_rows) {
                        jQuery(response.ids).each(function(key, val) {
                            jQuery('tr[id-row="'+ val +'"]', '#'+ TableBuilder.options.table_ident).remove();
                        });
                    }

                    TableBuilder.showSuccessNotification(response.message);
                } else {
                    if (typeof response.errors === "undefined") {
                        TableBuilder.showErrorNotification('Что-то пошло не так');
                    } else {
                        var errors = '';
                        jQuery(response.errors).each(function(key, val) {
                            errors += val +'<br>';
                        });
                        TableBuilder.showBigErrorNotification(errors);
                    }
                }

                TableBuilder.hidePreloader();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }
        });
    }, // end doMultiActionCall

    doMultiActionCallWithOption: function(context, type, option)
    {
        TableBuilder.showPreloader();

        var values = jQuery('#'+ TableBuilder.options.table_ident).serializeArray();
        values.push({ name: 'type', value: type });
        values.push({ name: 'option', value: option });
        values.push({ name: 'query_type', value: 'multi_action_with_option' });
        values.push({ name: '__node', value: TableBuilder.getUrlParameter('node') });

        jQuery.ajax({
            type: "POST",
            url: TableBuilder.getActionUrl(),
            data: values,
            dataType: 'json',
            success: function(response) {
                jQuery(context).parent().parent().parent().removeClass('open');

                if (response.status) {
                    if (response.is_hide_rows) {
                        jQuery(response.ids).each(function(key, val) {
                            jQuery('tr[id-row="'+ val +'"]', '#'+ TableBuilder.options.table_ident).remove();
                        });
                    }

                    TableBuilder.showSuccessNotification(response.message);
                } else {
                    if (typeof response.errors === "undefined") {
                        TableBuilder.showErrorNotification(phrase['Что-то пошло не так, попробуйте позже']);
                    } else {
                        var errors = '';
                        jQuery(response.errors).each(function(key, val) {
                            errors += val +'<br>';
                        });
                        TableBuilder.showBigErrorNotification(errors);
                    }
                }

                TableBuilder.hidePreloader();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }
        });
    }, // end doMultiActionCallWithOption

    saveOrder: function(order)
    {
        console.log(order);

        jQuery.ajax({
            type: "POST",
            url: TableBuilder.getActionUrl(),
            data: { order: order, query_type: 'change_order' },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    TableBuilder.showSuccessNotification(phrase['Порядок следования изменен']);
                } else {

                    TableBuilder.showErrorNotification(phrase['Что-то пошло не так, попробуйте позже']);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }
        });
    }, // end saveOrder

    openImageStorageModal: function(context, storageTypeSelect)
    {
        jQuery.ajax({
            type: "POST",
            url: TableBuilder.getActionUrl(),
            data: { query_type: 'image_storage', storage_type: 'show_modal', "__node": TableBuilder.getUrlParameter('node'), storage_type_select: storageTypeSelect },
            dataType: 'json',
            success: function(response) {

                if (response.status) {
                    $(TableBuilder.image_storage_wrapper).html(response.html);
                    $('.image_storage_wrapper').show();
                    $('.tb-modal:visible').addClass('superbox-modal-hide').hide();

                    Superbox.input = $(context).parent().parent().find('input');
                    Superbox.type_select = storageTypeSelect;
                } else {
                    TableBuilder.showErrorNotification(phrase['Что-то пошло не так, попробуйте позже']);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }
        });
    }, // end openImageStorageModal

    closeImageStorageModal: function()
    {
        $('.image_storage_wrapper').hide();
        $('.superbox-modal-hide').removeClass('superbox-modal-hide').show();
    }, // end closeImageStorageModal

    openFileStorageModal: function(context)
    {
        jQuery.ajax({
            type: "POST",
            url: TableBuilder.getActionUrl(),
            data: { query_type: 'file_storage', storage_type: 'show_modal', "__node": TableBuilder.getUrlParameter('node') },
            dataType: 'json',
            success: function(response) {

                if (response.status) {
                    $(TableBuilder.image_storage_wrapper).html(response.html);
                    $('.image_storage_wrapper').show();
                    $('.tb-modal:visible').addClass('superbox-modal-hide').hide();

                    FileStorage.input = $(context).parent().parent().find('input');
                } else {
                    TableBuilder.showErrorNotification(phrase['Что-то пошло не так, попробуйте позже']);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorResult = jQuery.parseJSON(xhr.responseText);

                TableBuilder.showErrorNotification(errorResult.message);
                TableBuilder.hidePreloader();
            }
        });
    }, // end openFileStorageModal

    reLoadTable : function ()
    {
        //  alert(window.location.href);
    } //end reLoadTable
};

$(window).load(function() {
    TableBuilder.initFroalaEditor();
    TableBuilder.handleStartLoad();
});


