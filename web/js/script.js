/* Russian (UTF-8) initialisation for the jQuery UI date picker plugin. */
/* Written by Andrew Stromnov (stromnov@gmail.com). */
( function (factory) {
    if (typeof define === "function" && define.amd) {

        // AMD. Register as an anonymous module.
        define(["../widgets/datepicker"], factory);
    } else {

        // Browser globals
        factory(jQuery.datepicker);
    }
}(function (datepicker) {

    datepicker.regional.ru = {
        closeText: "Закрыть",
        prevText: "&#x3C;Пред",
        nextText: "След&#x3E;",
        currentText: "Сегодня",
        monthNames: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
            "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
        monthNamesShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн",
            "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
        dayNames: ["воскресенье", "понедельник", "вторник", "среда", "четверг", "пятница", "суббота"],
        dayNamesShort: ["вск", "пнд", "втр", "срд", "чтв", "птн", "сбт"],
        dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
        weekHeader: "Нед",
        dateFormat: "dd.mm.yy",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ""
    };
    datepicker.setDefaults(datepicker.regional.ru);

    return datepicker.regional.ru;

}) );

function multiDataPicker(){
    $('.datepicker').datepicker({
        dateFormat: "dd/mm/yy",
        onSelect: function (date, inst) {
            var dateArr = date.split('/');
            var selDate = new Date(dateArr[2]+'-'+dateArr[1]+'-'+dateArr[0]);
            $(this).parent().prev('input[type=hidden]').val(selDate.getTime() / 1000);
        }
    });
}

function getProjectCombobox(client, projectInput){
    $.ajax({
        type: 'POST',
        url: '/ajax/get-project',
        data: 'client='+client,
        success: function (msg) {
            var projectsArr = JSON.parse(msg);
            projectInput.html('');
            projectInput.val('');
            projectInput.combobox("destroy");
            projectInput.append('<option value=""></option>');
            $.each(projectsArr, function(){
                projectInput.append('<option value="'+$(this)[0].id+'">'+$(this)[0].name+'</option>');
            });
            projectInput.combobox();
        }
    });
}
/* Preloader */
$(window).on("load", function () {

    /*preload*/
    var preload = $('.preloader');
    preload.find('.spinner').fadeOut(function () {
        preload.fadeOut(500);
    });

});

$(function () {
    /*tin*/
    // POPUP удалить запись
    $('.clients-btn.delete').on('click', function () {
        if ($(this).hasClass('form-del')) {
            $('#del-form input#id-del-object').val($(this).closest('form').find('#transactionform-transaction_id').val());
            $('#del-form h2 span').text($(this).closest('form').find('#transactionform-price').val() + ' ' + $(this).closest('form').find('#transactionform-implementer').val());
            $('#del-form .add-submit-btn').addClass('reload');
            $('#edit-client-popup').animate({'top': '-3000px'}, 500);
        } else {
            $('#del-form input#id-del-object').val($(this).closest('tr').find('.del-name').attr('object-id'));
            $('#del-form h2 span').text($(this).closest('tr').find('.del-name').text());
            $('#del-form .add-submit-btn').removeClass('reload');
        }

        var objectType = $(this).attr('object-type');
        var objectTitle = '.' + objectType;
        $('#del-form input#type-del-object').val(objectType);
        $('h2.title').css('display', 'none');
        $(objectTitle).css('display', 'inline');
        $('.overlay').fadeIn(250, function () {
            $('#del-client-popup').animate({'top': $(window).scrollTop() + 100}, 500);
        });
        return false;
    });
    $('.overlay, #del-client-popup .close, #del-client-popup .cancel-submit-btn').click(function () {
        $('#del-client-popup').animate({'top': '-3000px'}, 500, function () {
            $('.overlay').fadeOut(250);
        });
        return false;
    });
    //delet ajax
    $('#del-form .add-submit-btn').on('click', function(){
        var $yiiform = $(this).parents('form');
        var dataForm = $yiiform.serializeArray();
        var trId = '#tr-id-' + $yiiform.find('#id-del-object').val();
        if ($(this).hasClass('reload')){
            var reload = true;
        } else {
            var reload = false;
        }
        // отправляем данные на сервер
        $.ajax({
            type: $yiiform.attr('method'),
            url: $yiiform.attr('action'),
            data: dataForm,
            success: function (msg) {
                if (msg){
                    if (reload){
                        window.location.reload();
                    }else {
                        $(trId).remove();
                        $('#del-client-popup .close').trigger('click');
                    }
                } else {
                    alert('Ошибка!!!');
                }
            }
        });

        return false;
    });

    // POPUP новый клиент
    $('.add-client-btn').on('click', function () {
        $('.overlay').fadeIn(250, function () {
            $('#add-client-popup').animate({'top': $(window).scrollTop() + 100}, 500);
        });
        return false;
    });
    $('.overlay, #add-client-popup .close').click(function () {
        $('#add-client-popup').animate({'top': '-3000px'}, 500, function () {
            $('.overlay').fadeOut(250);
        });
        return false;
    });

    // POPUP новый проект
    $('.add-project-btn').on('click', function () {

        $('#new-project-form').removeClass('edit');
        $('#new-project-form .message').html('');
        $('#new-project-form #projectform-name').val('');
        $('#new-project-form #projectform-tag').val('').trigger('refresh');
        $('#new-project-form #projectform-price').val('');
        $('#new-project-form #projectform-project_id').val('');
        $('#new-project-form #projectform-date_start').val('');
        $('.overlay').fadeIn(250, function () {
            $('#add-project-popup').animate({'top': $(window).scrollTop() + 100}, 500);
        });
        return false;
    });

    // POPUP редактировать проект
    $('.clients-btn.edit').on('click', function () {
        $('#new-project-form').addClass('edit');
        $('#new-project-form .message').html('');
        $('#new-project-form #projectform-name').val($(this).closest('tr').find('.del-name').text());
        $('#new-project-form #projectform-tag').val($(this).closest('tr').find('.category').attr('tag-id')).trigger('refresh');
        $('#new-project-form #projectform-price').val($(this).closest('tr').find('.price').attr('price-val'));
        $('#new-project-form #projectform-client').val($(this).closest('tr').find('.name').attr('client-id'));
        $('#new-project-form #projectform-project_id').val($(this).closest('tr').find('.del-name').attr('object-id'));
        $('#new-project-form #projectform-date_start').val($(this).closest('tr').find('.project-open-date').attr('date-start'));


        $('.overlay').fadeIn(250, function () {
            $('#add-project-popup').animate({'top': $(window).scrollTop() + 100}, 500);
        });
        return false;
    });
    $('.overlay, #add-project-popup .close').click(function () {
        $('#add-project-popup').animate({'top': '-3000px'}, 500, function () {
            $('.overlay').fadeOut(250);
        });
        return false;
    });

    //добавление клиента
    $('#new-client-form .add-submit-btn').on('click', function () {
        var $yiiform = $(this).parents('form');
        var dataForm = $yiiform.serializeArray();
        // отправляем данные на сервер
        $.ajax({
            type: $yiiform.attr('method'),
            url: $yiiform.attr('action'),
            data: dataForm,
            success: function (msg) {
                var oMsg = JSON.parse(msg)
                console.log(msg);
                console.log(oMsg);
                if (oMsg.add) {
                   // $('#new-client-form .help-block-error').addClass('green').html(oMsg.add);
                    window.location.href = '/project/'+oMsg.add;
                } else if (oMsg.error) {
                    $('#new-client-form .help-block-error').removeClass('green').html(oMsg.error);
                }
            }
        });

        return false;
    });

    //добавление проекта
    $('#new-project-form .add-submit-btn').on('click', function () {
        var $yiiform = $(this).parents('form');
        var dataForm = $yiiform.serializeArray();
        // отправляем данные на сервер
        $.ajax({
            type: $yiiform.attr('method'),
            url: $yiiform.attr('action'),
            data: dataForm,
            success: function (msg) {
                var oMsg = JSON.parse(msg)
                if (oMsg.add) {
                    $('#new-project-form .message').addClass('green').html(oMsg.add);
                    setTimeout(function() {
                        //var curUrlArr = window.location.href.split('#');
                        //window.location.href = curUrlArr[0] + '#tr-id-' + oMsg.id;
                        //window.location.reload(true);
                        window.location.reload();
                    }, 1000);
                } else if (oMsg.error) {
                    var errMess = '';
                    $.each(oMsg.error, function(el,i){

                        errMess = errMess + i[0] + '<br/>';
                    });
                    $('#new-project-form .message').removeClass('green').html(errMess);
                } else  if (oMsg.edit) {
                    $('#new-project-form .message').addClass('green').html(oMsg.edit);
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            }
        });

        return false;
    });

    /* Tabs form*/
    $('.tab-menu-form.one a').click(function () {
        //var tab_bl = $(this).attr('href');

        $(this).closest('.tabs').find('.tab-menu-form li').removeClass('active');
        $(this).parent().addClass('active');

        // $(this).closest('.tabs').find('.tab-item').hide().attr('disabled', 'disabled');
        // $(tab_bl).fadeIn().removeAttr('disabled');
        if ($(this).attr('href') == 'enrollment') {
            $('#transactionform-type').val('enrollment');
            $('.implementer').css('display', 'none');
            $('#transactionform-implementer').val('|-');
            $('#transactionform-implementer_id').val('');
            $(this).parents('form').find('.value-price').removeClass('minus');
            $(this).parents('form').find('.cash0').prop("checked", true).trigger('refresh');
            $(this).parents('form').find('.cash1').prop("checked", false).trigger('refresh');
        } else {
            $('#transactionform-type').val('charge');
            $('.implementer').css('display', 'block');
            $('.implementer input').val('');
            $(this).parents('form').find('.value-price').addClass('minus');
            $(this).parents('form').find('.cash1').prop("checked", true).trigger('refresh');
            $(this).parents('form').find('.cash0').prop("checked", false).trigger('refresh');
        }

        return false;
    });

    $('.tab-menu-form.multi li a').click(function () {
        //var tab_bl = $(this).attr('href');

        $(this).closest('.tabs').find('.tab-menu-form li').removeClass('active');
        $(this).parent().addClass('active');

        if ($(this).attr('href') == 'enrollment') {
            $('#transactionmultiform-type').val('enrollment');
            $('.value-creator .trigger-implementer').val('|-');
            $('.value-creator .trigger-implementer').attr('value','|-');
            $('.trigger-implementer-id').val('');
            $('.trigger-implementer-id').attr('value', '');
            $('#multi-tr-form .value-price').removeClass('minus');
        } else {
            $('#transactionmultiform-type').val('charge');
            $('.value-creator .trigger-implementer').val('');
            $('.value-creator .trigger-implementer').attr('value','');
            $('#multi-tr-form .value-price').addClass('minus');
        }
        $(this).closest('form').toggleClass('charge');

        return false;
    });

    // добавление полей транзакции
    $('.add-more-btn').on('click', function(){
        $('.glyphicon-plus').trigger('click');
        if ($('.tab-menu-form.multi .active a').attr('href') == 'charge'){
            $('#multi-tr-form .value-price').addClass('minus');
        }
        var lastGroup = $('.multiple-input-list__item.group-col').eq($('.multiple-input-list__item.group-col').length - 2);
        var newGroup = $('.multiple-input-list__item.group-col').eq($('.multiple-input-list__item.group-col').length - 1);
        newGroup.find('.trigger-date').val(lastGroup.find('.trigger-date').val());
        newGroup.find('.trigger-datevisible').val(lastGroup.find('.trigger-datevisible').val());
        newGroup.find('.trigger-implementer').val(lastGroup.find('.trigger-implementer').val());
        newGroup.find('.trigger-implementer-id').val(lastGroup.find('.trigger-implementer-id').val());
        return false;
    });
    //datepicker AddTransaction
    if ($('#datepicker_inline').length) {
        $('#datepicker_inline').datepicker({
            dateFormat: "yy-mm-dd",
            onSelect: function (date, inst) {
                var selDate = new Date(date);
                $('#transactionform-date').val(selDate.getTime() / 1000);
            }
        });
    }

    if ($('.datepicker').length) {
        $('.datepicker').attr('autocomplete', 'off');
        $(function () {
            multiDataPicker();
        });
    }
    // автозаполнение

    $.widget("custom.combobox", {
        _create: function () {
            this.wrapper = $("<span>")
                .addClass("custom-combobox")
                .insertAfter(this.element);

            this.element.hide();
            this._createAutocomplete();
            //this._createShowAllButton();
        },

        _createAutocomplete: function () {
            var selected = this.element.children(":selected"),
                value = selected.val() ? selected.text() : "";
            this.input = $("<input>")
                .appendTo(this.wrapper)
                .val(value)
                .attr("title", "")
                .addClass("form-control")
                .attr('placeholder', this.bindings[0].attributes['placeholder'].value)
                .autocomplete({
                    delay: 0,
                    minLength: 0,
                    source: $.proxy(this, "_source")
                })
                .tooltip({
                    classes: {
                        "ui-tooltip": "ui-state-highlight"
                    }
                });

            this._on(this.input, {
                autocompleteselect: function (event, ui) {
                    ui.item.option.selected = true;
                    this._trigger("select", event, {
                        item: ui.item.option
                    });
                },

                autocompletechange: "_removeIfInvalid"
            });
        },

        _source: function (request, response) {
            var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
            response(this.element.children("option").map(function () {
                var text = $(this).text();
                if (this.value && ( !request.term || matcher.test(text) ))
                    return {
                        label: text,
                        value: text,
                        option: this
                    };
            }));
        },

        _removeIfInvalid: function (event, ui) {

            // Selected an item, nothing to do
            if (ui.item) {
                return;
            }

            // Search for a match (case-insensitive)
            var value = this.input.val(),
                valueLowerCase = value.toLowerCase(),
                valid = false;
            this.element.children("option").each(function () {
                if ($(this).text().toLowerCase() === valueLowerCase) {
                    this.selected = valid = true;
                    return false;
                }
            });

            // Found a match, nothing to do
            if (valid) {
                return;
            }

            // Remove invalid value
            this.input
                .val("")
                .attr("title", value + " не соответствует ни одному значению")
                .tooltip("open");
            this.element.val("");
            this._delay(function () {
                this.input.tooltip("close").attr("title", "");
            }, 2500);
            this.input.autocomplete("instance").term = "";
        },

        _destroy: function () {
            this.wrapper.remove();
            this.element.show();
        }
    });
    $("select#transactionform-project_id").combobox();
    $("select#transactionform-client_id").combobox({
        select: function (event, ui) {
            getProjectCombobox(ui.item.value,  $("#transactionform-project_id"));
        },
    });


    //$(".combobox-multi").combobox();
    $('.project-combobox-multi').combobox();
    $(".client-combobox-multi").combobox({
        select: function (event, ui) {
            getProjectCombobox(ui.item.value, $(this).closest('.value-name').siblings('.value-job').children('select'));
        },
    });

    $(document).on('focus', '.ui-autocomplete-input', function(){
        $(this).autocomplete( "search", "" );
    });


    // окно добавления транзакций на странице проекта
    $('.add-price-btn').click(function () {
        if ($(this).hasClass('plus')){
            $('#tr-form-ajax .tab-menu-form li:first a').trigger('click');
        } else {
            $('#tr-form-ajax .tab-menu-form li:last a').trigger('click');
        }

        $('#edit-client-popup #transactionform-client').val($(this).closest('tr').find('a.name').html());
        $('#edit-client-popup #transactionform-client_id').val($(this).closest('tr').find('a.name').attr('client-id'));
        $('#edit-client-popup #transactionform-project').val($(this).closest('tr').find('.del-name').html());
        $('#edit-client-popup #transactionform-project_id').val($(this).closest('tr').find('.del-name').attr('object-id'));
        $('#edit-client-popup #transactionform-price').val('');
        $('#edit-client-popup #transactionform-date').val(parseInt(new Date()/1000));
        $('#edit-client-popup #transactionform-comment').val('');
        $('#edit-client-popup #transactionform-transaction_id').val('');
        $('#edit-client-popup #transactionform-implementer_id').val('');
        //$('#edit-client-popup #transactionform-implementer').val('');
        $( '#datepicker_inline').datepicker( "setDate", new Date());
        $('#edit-client-popup .submit-btn').html('Добавить');
        $('#edit-client-popup .form-del').css('display', 'none');

        $('.overlay').fadeIn(250, function () {
            $('#edit-client-popup').animate({'top': $(window).scrollTop() + 100}, 500);
        });
        return false;
    });

    // окно редактирования транзакций на странице проекта
    $('.price-detail-item .info').click(function () {

        if ($(this).closest('.price-detail-items').next('.add-price-btn').hasClass('minus') != ''){
            $('#tr-form-ajax .tab-menu-form li:last a').trigger('click');
            $('#edit-client-popup #transactionform-implementer_id').val($(this).attr('implementerid'));
            $('#edit-client-popup #transactionform-implementer').val($(this).attr('implementername'));
        } else {
            $('#tr-form-ajax .tab-menu-form li:first a').trigger('click');
        }



        $( "#datepicker_inline" ).datepicker( "setDate", new Date(parseInt($(this).siblings('.date').attr('date'))*1000) );
        $('#edit-client-popup #transactionform-price').val($(this).siblings('.value').attr('price'));
        $('#edit-client-popup #transactionform-date').val($(this).siblings('.date').attr('date'));
        $('#edit-client-popup #transactionform-comment').val($(this).children('.content').html());
        $('#edit-client-popup #transactionform-transaction_id').val($(this).attr('transactionid'));
        $('#edit-client-popup #transactionform-client').val($(this).closest('tr').find('a.name').html());
        $('#edit-client-popup #transactionform-client_id').val($(this).closest('tr').find('a.name').attr('client-id'));
        $('#edit-client-popup #transactionform-project').val($(this).closest('tr').find('.del-name').html());
        $('#edit-client-popup #transactionform-project_id').val($(this).closest('tr').find('.del-name').attr('object-id'));
        $('#edit-client-popup .submit-btn').html('Обновить');
        $('#edit-client-popup .form-del').css('display', 'inline-block');




        $('.overlay').fadeIn(250, function () {
            $('#edit-client-popup').animate({'top': $(window).scrollTop() + 100}, 500);
        });
        return false;
    });

    // закрытие окна транзакций на странице проекта
    $('.overlay, #edit-client-popup .cancel-btn, #edit-client-popup .close').click(function () {
        $('#edit-client-popup').animate({'top': '-3000px'}, 500, function () {
            $('.overlay').fadeOut(250);
        });
        return false;
    });

    //добавление транзакции со страницы проектов
    $('#edit-client-popup .submit-btn').on('click', function(){

        var $yiiform = $(this).parents('form');
        var dataForm = $yiiform.serializeArray();
        // отправляем данные на сервер
        $.ajax({
            type: $yiiform.attr('method'),
            url: $yiiform.attr('action'),
            data: dataForm,
            success: function (msg) {
                var oMsg = JSON.parse(msg)
                if (oMsg.add) {
                    $('#edit-client-popup .message').addClass('green').html(oMsg.add);
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                } else if (oMsg.edit) {
                    $('#edit-client-popup .message').addClass('green').html(oMsg.edit);
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                } else {
                    $('#edit-client-popup .message').removeClass('green').html(oMsg['transactionform-price'].join(', '));
                }
            }
        });

        return false;
    });

    



    //открытие-закрытие проекта
    $('.clients-btn.close').on('click', function(){
        var button = $(this);
        var project = $(this).closest('tr').find('.del-name').attr('object-id');
        if (button.hasClass('open')){
            var status = 1;
        } else {
            var status = 0;
        }
        $.ajax({
            type: 'POST',
            url: '/ajax/status-project',
            data: 'project='+project+'&status='+status,
            success: function (msg) {
                var Arr = JSON.parse(msg);
                console.log(Arr);
                if (Arr.edit == 1){
                    button.toggleClass('open');
                }
                button.html(Arr.msg);
            }
        });
        return false;
    });

    // фильтрация проектов
    $('.status-btn').on('click', function(){
        if (!($(this).hasClass('active'))){
           $('#projectsearch-status').val($(this).attr('status'));
            $('#filtering-project-form-id').submit();
        }
        return false;
    });

    // сортировка проектов
    $('#select-sort-id').on('change', function(){
        $('#project-sort-id').val($(this).val());
        $('#filtering-project-form-id').submit();
    });
    /*END tin*/
    var width = $(window).width();
    var height = $(window).height();

    /* Clients Menu */
    $('.clients-items').on('click', '.clients-menu', function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('.projects-overlay').fadeOut();
            $('.projects-popup').fadeOut();
        } else {
            $(this).addClass('active');
            $('.projects-overlay').fadeIn();
            $('.projects-popup').fadeIn();
        }
        return false;
    });

    /* Gallery */
    $(".gallery-group").fancybox({
        // Options will go here
    });

    /* Tabs */
    $('.tab-menu a').click(function () {
        var tab_bl = $(this).attr('href');

        $(this).closest('.tabs').find('.tab-menu li').removeClass('active');
        $(this).parent().addClass('active');

        $(this).closest('.tabs').find('.tab-item').hide();
        $(tab_bl).fadeIn();

        return false;
    });

    /* Balance Collapse */
    $('.balence-table').on('click', 'tr.dropdown', function () {
        if ($(this).find('.dropdown-label').hasClass('opened')) {
            $(this).find('.dropdown-label').removeClass('opened');
            $(this).next().find('.subtable').slideUp();
        } else {
            $(this).find('.dropdown-label').addClass('opened');
            $(this).next().find('.subtable').slideDown();
        }
    });

    /* Form Styler */
    if ($('.styler').length) {
        $('input.styler, select.styler, .styler input').styler();
    }

    /* slimScroll */
    $('.scrollbox-x').slimScroll({
        axis: 'x',
        width: '1100px',
        height: 'auto',
        touchScrollStep: 100
    });

    /* Tel Mask */
    if ($("input[name='tel']").length) {
        $("input[name='tel']").mask("+7 (999) 999-99-99", {placeholder: ""});
    }

    /* Datepicker From-To */
    $.datepicker.setDefaults($.datepicker.regional["ru"]);
    if ($('.date-range').length) {
        var dateFormat = 'dd/mm/yy',

            from = $(this).find('.from').datepicker({
                defaultDate: '+1w',
                changeMonth: true
            }).on('change', function () {
                to.datepicker('option', 'minDate', getDate(this));
            }),
            to = $(this).find('.to').datepicker({
                defaultDate: '+1w',
                changeMonth: true
            }).on('change', function () {
                from.datepicker('option', 'maxDate', getDate(this));
            });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
    }



    /* Transactions Popup */
    $('.one-tr-btn').click(function () {
        $('.add-tr-form').fadeIn();
        return false;
    });
    $('.multi-tr-btn').click(function () {
        $('.add-multi-tr-form').fadeIn();
        return false;
    });



    /* Validation Forms */

    /* Login Form */
    $("#login-form").validate({
        success: "valid"
    });
});