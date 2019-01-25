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
        $('#del-form input#id-del-object').val($(this).closest('tr').find('.del-name').attr('object-id'));
        $('#del-form h2 span').text($(this).closest('tr').find('.del-name').text());
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
        // отправляем данные на сервер
        $.ajax({
            type: $yiiform.attr('method'),
            url: $yiiform.attr('action'),
            data: dataForm,
            success: function (msg) {
                if (msg){
                    var trId = '#tr-id-' + $yiiform.find('#id-del-object').val();
                    $(trId).remove();
                    $('#del-client-popup .close').trigger('click');
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
                    $('#new-project-form .message').removeClass('green').html(oMsg.error);
                }
            }
        });

        return false;
    });

    /* Tabs form*/
    $('.tab-menu-form a').click(function () {
        //var tab_bl = $(this).attr('href');

        $(this).closest('.tabs').find('.tab-menu-form li').removeClass('active');
        $(this).parent().addClass('active');

        // $(this).closest('.tabs').find('.tab-item').hide().attr('disabled', 'disabled');
        // $(tab_bl).fadeIn().removeAttr('disabled');
        if ($(this).attr('href') == 'enrollment') {
            $('#transactionform-type').val('enrollment');
            $('.implementer').css('display', 'none');
            $('.implementer input').val('');
            $('#tr-form .value-price').removeClass('minus');
        } else {
            $('#transactionform-type').val('charge');
            $('.implementer').css('display', 'block');
            $('#tr-form .value-price').addClass('minus');
        }

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
    $("#transactionform-project_id").combobox();
    $("#transactionform-client_id").combobox({
        select: function (event, ui) {
            console.log(ui.item.value);
            $.ajax({
                type: 'POST',
                url: '/ajax/get-project',
                data: 'client='+ui.item.value,
                success: function (msg) {
                    var projectsArr = JSON.parse(msg);
                    $("#transactionform-project_id").html('');
                    $("#transactionform-project_id").val('');
                    $("#transactionform-project_id").combobox("destroy");
                    $("#transactionform-project_id").append('<option value=""></option>');
                    $.each(projectsArr, function(){
                        $("#transactionform-project_id").append('<option value="'+$(this)[0].id+'">'+$(this)[0].name+'</option>');
                    });
                    $("#transactionform-project_id").combobox();
                    //$("#transactionform-project_id").html(msg);
                }
            });
        },
    });

    // окно транзакций на странице проекта
    /* Edit Client Popup */
    $('.add-price-btn').click(function () {
        if ($(this).hasClass('plus')){
            $('#tr-form .tab-menu li:first a').trigger('click');
        } else {
            $('#tr-form .tab-menu li:last a').trigger('click');
        }
        $('.overlay').fadeIn(250, function () {
            $('#edit-client-popup').animate({'top': $(window).scrollTop() + 100}, 500);
        });
        return false;
    });

    $('.overlay, #edit-client-popup .cancel-btn, #edit-client-popup .close').click(function () {
        $('#edit-client-popup').animate({'top': '-3000px'}, 500, function () {
            $('.overlay').fadeOut(250);
        });
        return false;
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
        $('input.styler, select.styler').styler();
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

    if ($('.datepicker').length) {
        $(function () {
            $('.datepicker').datepicker();
        });
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