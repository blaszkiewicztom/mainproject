function sendMessageFunction(path) {
    $('#ajax_call').hide();
    $.ajax({

        url: path,
        beforeSend: function() { $('#ajax_loading').show(500); },
        complete: function() { $('#ajax_loading').hide(500); },
        type: "POST",
        dataType: "json",
        data: {
            "name": "tomek"
        },
        async: true,
        success: function (data) {
            document.getElementById("ajax_call").innerHTML = data.output;
            $('#ajax_call').show();
        }
    });
    return false;

}
function loadForm(val, path){
    $('#send_message_form_ajax').hide();
    $.ajax({

        url: path,
        beforeSend: function() { $('#ajax_loading_message_form').show(500); },
        complete: function() { $('#ajax_loading_message_form').hide(500); },
        type: "POST",
        dataType: "json",
        data: {
            "submit_value": val
        },
        async: true,
        success: function (data) {
            document.getElementById("send_message_form_ajax").innerHTML = data.output;
            $('#send_message_form_ajax').show();
        }
    });
    $('#sendMessageFormModal').modal('show');
    return false;
}
function loadHistoryOfMessages(path){
    $('#ajax_call').hide();
    $.ajax({

        url: path,
        beforeSend: function() { $('#ajax_loading').show(500); },
        complete: function() { $('#ajax_loading').hide(500); },
        type: "POST",
        dataType: "html",
        data: {
            "data": "data"
        },
        async: true,
        success: function (data) {
            document.getElementById("ajax_call").innerHTML = data;
            $('#ajax_call').show();
        }
    });
    return false;

}
function loadSystemMessages(path){
    $('#ajax_call').hide();
    $.ajax({

        url: path,
        beforeSend: function() { $('#ajax_loading').show(500); },
        complete: function() { $('#ajax_loading').hide(500); },
        type: "POST",
        dataType: "html",
        data: {
            "data": "data"
        },
        async: true,
        success: function (data) {
            document.getElementById("ajax_call").innerHTML = data;
            $('#ajax_call').show();
        }
    });
    return false;

}