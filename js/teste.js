$('#consultaPonto').click(function () {
   
    $.ajax({
        url: "gestaoPonto.php", //Arquivo php
        type: "post",
        

        success: function (data) {			//Sucesso no AJAX
            Lobibox.notify('success', {
                title: 'Ponto cadastrado',
            });

        },
        error: function (request, status, erro) {
            alert("Problema ocorrido: " + status + "\nDescição: " + erro);
            //Abaixo está listando os header do conteudo que você requisitou, só para confirmar se você setou os header e dataType corretos
            alert("Informações da requisição: \n" + request.getAllResponseHeaders());
        },
    });
    return false;
});

//<button id="consultaPonto" value="' . $usuarios_sis->id . '">' . $usuarios_sis->nome_completo . '</button>