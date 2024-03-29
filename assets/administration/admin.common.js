function setLocation(url) {
    window.location.href = url;
}

function showThrobber(message) {
    $('.throbber-header').html(message);
    window.setTimeout(function () {
        $(".throbber").show();
    }, 1000);
}

$(document).ready(function () {
    $('.multi-store-override-option').each(function (k, v) {
        checkOverriddenStoreValue(v, $(v).attr('data-for-input-selector'));
    });
    $('i.help').tooltip();

    var currentT = localStorage.getItem('theme');

    if (currentT == 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
    }
});

function checkAllOverriddenStoreValue(item) {
    $('.multi-store-override-option').each(function (k, v) {
        $(v).prop('checked', item.checked);
        checkOverriddenStoreValue(v, $(v).attr('data-for-input-selector'));
    });
}

function checkOverriddenStoreValue(obj, selector) {
    var elementsArray = selector.split(",");
    if (!$(obj).is(':checked')) {
        $(selector).attr('disabled', true);
        //Kendo UI elements are enabled/disabled some other way
        $.each(elementsArray, function(key, value) {
            var kenoduiElement = $(value).data("kendoNumericTextBox");
            if (kenoduiElement !== undefined && kenoduiElement !== null) {
                kenoduiElement.enable(false);
            }
        });
    }
    else {
        $(selector).removeAttr('disabled');
        //Kendo UI elements are enabled/disabled some other way
        $.each(elementsArray, function(key, value) {
            var kenoduiElement = $(value).data("kendoNumericTextBox");
            if (kenoduiElement !== undefined && kenoduiElement !== null) {
                kenoduiElement.enable();
            }
        });
    };
}

function tabstrip_on_tab_select(e) {
    $("#selected-tab-index").val($(e.item).index());
}

function tabstrip_on_tab_show(e, load) {
    var element = '.k-state-active';
    if (load === undefined) {
        $(e.contentElement).find('[data-role="grid"]').each(function (x) {
            var grid = $(this).data('kendoGrid');
            grid.dataSource.page(1);
        });
    }
    else {
        $(element).find('[data-role="grid"]').each(function (x) {
            var grid = $(this).data('kendoGrid');
            grid.dataSource.page(1);
        });
    }

}


function display_kendoui_grid_error(e) {
    if (e.errors) {
        if ((typeof e.errors) == 'string') {
            //single error
            //display the message
            alert(e.errors);
        } else {
            //array of errors
            //source: http://docs.kendoui.com/getting-started/using-kendo-with/aspnet-mvc/helpers/grid/faq#how-do-i-display-model-state-errors?
            var message = "The following errors have occurred:";
            //create a message containing all errors.
            $.each(e.errors, function (key, value) {
                if (value.errors) {
                    message += "\n";
                    message += value.errors.join("\n");
                }
            });
            //display the message
            alert(message);
        }
    } else if (e.errorThrown) {
        alert('Error happened');
    }
}

// CSRF (XSRF) security
function addAntiForgeryToken(data) {
    //if the object is undefined, create a new one.
    if (!data) {
        data = {};
    }
    //add token
    var tokenInput = $('input[name=_token]');
    if (tokenInput.length) {
        data._token	 = tokenInput.val();
    }
    return data;
};


// Ajax activity indicator bound to ajax start/stop document events

$(document).ajaxStart(function () {
    StartPageLoading();
}).ajaxStop(function () {
    StopPageLoading();
});

function StartPageLoading(options) {
    if (options && options.animate) {
        $('.page-spinner-bar').remove();
        $('body').append('<div class="page-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
    } else {
        $('.page-loading').remove();
        $('body').append('<div class="page-loading"><img src="/administration/build/images/loading.gif"/>&nbsp;&nbsp;<span>' + (options && options.message ? options.message : 'Loading...') + '</span></div>');
    }
}

function StopPageLoading() {
    $('.page-loading, .page-spinner-bar').remove();
}
