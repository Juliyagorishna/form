/* Article FructCode.com */
$( document ).ready(function() {
    $("#btn").click( //# = id
        function(){
            sendAjaxForm('result_form', 'ajax_form', 'action_ajax_form.php');
            return false;
        }
    );
});

function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: 'html',
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);

            if (result.result === 'error') {
                $('#errors').html('');
                $.each(result.text_error, function (key, value) {
                    $('#errors').append('<p>' + value + '</p>');
                });
            } else {
                $('#ajax_form').hide();
                $('#result_form').html('Регистрация успешна');
            }
        },
        error: function(response) { // Данные не отправлены
            $('#resultв_form').html('Ошибка. Данные не отправлены.');
        }
    });
}
