$(document).ready(function() {
    function addUser(nomb, ap, user, pass, mail){
        var parametros ={
            "nomb": nomb,
            "ap": ap,
            "user": user,
            "pass": pass,
            "mail": mail
        };
        $.ajax({
            data: parametros,
            url:'dll/crud.php',
            type: 'POST',
            success: function(data){
                console.log('OK!');
                console.log(data.length);
                console.log(data.nomvb);
                for (var i = data.length - 1; i >= 0; i--) {
                    // console.log(data.items[i]);
                    var item = data[i];
                    var p = '';
                    p += '<tr>';
                    p += '<td>'+item.nomb+'</td>';
                    p += '<td>'+item.ap+'</td>';
                    p += '<td>'+item.user+'</td>';
                    p += '<td>'+item.pass+'</td>';
                    p += '<td>'+item.correo+'</td>';
                    p += '<td><button id="uid" type="button" class="btn btn-warning btn-xs-1 btn-block" data-toggle="modal" data-target="#myModal"><span id="iconoU" class="icon-pencil2"></span></button></td>';
                    p += '<td><button id="crud" type="button" class="btn btn-danger btn-xs-1 btn-block"><input type="hidden" name="uid" value="uid"><span id="icono" class="icon-bin"></span></button></td>';
                    p += '</tr>';
                    $(p).appendTo('#results');
                };


            },
            error: function(xhr, textStatus){
                console.log('Error');
            }
        }); //end Ajax
    }
});