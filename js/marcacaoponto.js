///RESPOSAVEL POR MOSTRAR
function mostrarHora() {

    let dia = new Date();
    let hora = dia.getHours();
    let minutos = dia.getMinutes();
    let segundos = dia.getSeconds();
    //let formatoHora = convertaFormato(hora);
    let hoje = String(dia.getDate()).padStart(2, '0');
    let mes = String(dia.getMonth() + 1).padStart(2, '0');
    /* hora = verificaHora(hora);

    hora = addZero(hora); */
    minutos = addZero(minutos);
    segundos = addZero(segundos);


    document.getElementById('clock').innerHTML = `${hora}:${minutos}:${segundos}`;

    document.getElementById('data').innerHTML = `${hoje}/${mes}/${dia.getFullYear()}`;
    
    
    
}
function addZero(time) {
    if (time < 10) {
        time = "0" + time;
    }
    return time;
}

mostrarHora();
setInterval(mostrarHora, 1000);

function teste(){
    $('#aprova').hide();
    $('#reprova').hide();
    $('#motivoRejeicao').show();

    $('#confirmar').click(function () {
        
        var motivo = $('#motivo').val();
        var confirmar = $('#confirmar').val();

        if ($('#motivo').val() == "" || confirmar == "") {
            return alert('Preencha o campo com o motivo');
        }else{
       $.ajax({
            url: "motivoReprovacao.php", //Arquivo php
            type: "post", //Método de envio
            data: "motivo=" + motivo +
            "&confirmar=" + confirmar,
            success: function (data) {			
                Lobibox.notify('success', {
                    title: ' Motivo cadastrado',
                    msg: 'Folha de ponto\r'+
                    'Reprovada com Sucesso'
                });
    
            },
            error: function (request, status, erro) {
                alert("Problema ocorrido: " + status + "\nDescição: " + erro);
                //Abaixo está listando os header do conteudo que você requisitou, só para confirmar se você setou os header e dataType corretos
                alert("Informações da requisição: \n" + request.getAllResponseHeaders());
            },
        });
    }
        return false;
    });

}

//ENVIA INFORMAÇÕES DO PONTO PARA cadastraPonto.php POR MEIO DE POST
$('#botaoponto').click(function () {
    var tempo = $('#botaoponto').val();
    
   $.ajax({
        url: "cadastraPonto.php", //Arquivo php
        type: "post", //Método de envio
        data: "valorBotao=" + tempo,
        success: function (data) {			
            Lobibox.notify('success', {
                title: 'Ponto cadastrado',
                msg: tempo,
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

//Envia o id do user para a pagina de gestão para carregar as info de pontos do funcionarios

var qnt_result_pg = 3; //quantidade de registro por página
var pagina = 1; //página inicial

$(document).ready(function () {
    listar_usuario(pagina, qnt_result_pg); //Chamar a função para listar os registros
});

function listar_usuario(pagina, qnt_result_pg){
    var dados = {
        pagina: pagina,
        qnt_result_pg: qnt_result_pg
    }
    $.post('paginacao.php', dados , function(retorna){
        //Subtitui o valor no seletor id="conteudo"
        $("#conteudo").html(retorna);
    });
}


