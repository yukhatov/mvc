/**
 * Created by artur on 06.10.16.
 */

var files;
$('input[type=file]').change(function(){
    files = this.files;
});

$('#form-add-feedback').submit(function(e) {
    var $this = $(this),
        valid = isValid();

    if(!valid){
        e.preventDefault();
    }
});

function isValid()
{
    var $this = $(this),
        valid = true;

    if($("#file-js").val().length != 0)
    {
        var isjpg = substr_count($("#file-js").val().toLowerCase(), '.jpg'),
            isgif = substr_count($("#file-js").val().toLowerCase(), '.gif'),
            ispng = substr_count($("#file-js").val().toLowerCase(), '.png');

        if(!(isjpg || isgif || ispng))
        {
            alert('JPG, GIF and PNG only!');
            valid = false;
        }
    }

    if($("#name-js").val().length == 0 || $("#email-js").val().length == 0 || $("#message-js").val().length == 0)
    {
        alert('Name, Email and Message fields required!');
        valid = false;
    }

    return valid;
}

function substr_count(string,substring,start,length)
{
    var c = 0;
    if(start) { string = string.substr(start); }
    if(length) { string = string.substr(0,length); }
    for (var i=0;i<string.length;i++)
    {
        if(substring == string.substr(i,substring.length))
            c++;
    }
    return c;
}

$('#preview-button-js').on('click', function(e) {
    event.stopPropagation();
    event.preventDefault();

    var valid = isValid();

    if(!valid){
        return;
    }

    var data = new FormData();
    $.each( files, function( key, value ){
        data.append( key, value );
    });

    if(files && files.length){
        $.ajax({
            url: 'index.php?route=feedback/upload',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function( respond, textStatus, jqXHR ){
                preview(respond);
            },
            error: function( jqXHR, textStatus, errorThrown ){
                console.log('ОШИБКИ AJAX запроса: ' + textStatus );
            }
        });
    }else{
        preview();
    }
});

function preview(respond)
{
    if(respond){
        var file = respond.name;
    }
    else{
        var file = '';
    }

    var mainDiv = $('#main-js'),
        name = $('#name-js').val(),
        email = $('#email-js').val(),
        message = $('#message-js').val();

    var currentdate = new Date();
    var datetime = currentdate.getFullYear() + "-"
        + (currentdate.getMonth()+1)  + "-"
        + currentdate.getDate() + " "
        + currentdate.getHours() + ":"
        + currentdate.getMinutes() + ":"
        + currentdate.getSeconds();

    var tmpDiv = '<div class="panel panel-default" id="tmp-js">';
        tmpDiv += '<div class="panel-heading"> ' + datetime + ' by: <label>' + name + '</label>  ' + email;
        tmpDiv += '</div>';
        tmpDiv += '<div class="panel-body">';
            if(file.length != 0)
            {
                tmpDiv += '<img src="images/temp/' + file + '">';

            }
            tmpDiv += '<div class="caption">';
                tmpDiv += '<br><p>' + message + '</p>';
            tmpDiv += '</div>';
        tmpDiv += '</div>';
    tmpDiv += '</div>';

    $('#tmp-js').remove();

    mainDiv.append(tmpDiv);
}