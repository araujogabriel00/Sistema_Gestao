function mostrarHora() {

    let dia = new Date();
    let hora = dia.getHours();
    let minutos = dia.getMinutes();
    let segundos = dia.getSeconds();
    let formatoHora = convertaFormato(hora);
    let hoje = String(dia.getDate()).padStart(2, '0');
    let mes = String(dia.getMonth() + 1).padStart(2, '0');
    hora = verificaHora(hora);

    hora = addZero(hora);
    minutos = addZero(minutos);
    segundos = addZero(segundos);


    document.getElementById('clock').innerHTML = `${hora}:${minutos}-${formatoHora}`;

    document.getElementById('data').innerHTML = `${hoje}/${mes}/${dia.getFullYear()}`;

    return hora + ':' + minutos + ':' + formatoHora;
}

function convertaFormato(time) {
    let formato = "AM";
    if (time >= 12) {
        formato = "PM";
    }
    return formato;
}

function verificaHora(time) {
    if (time > 12) {
        time = time - 12;
    }
    if (time === 0) {
        time = 12;
    }
    return time;
}

function addZero(time) {
    if (time < 10) {
        time = "0" + time;
    }
    return time;
}

mostrarHora()
setInterval(mostrarHora, 1000);


$('#botaoponto').click(function () {
    let hora = mostrarHora();
    $.ajax({
        url: "cadastraPonto.php", //Arquivo php
        type: "post",
        data: "mostrarHora=" + hora,

        success: function (data) {			//Sucesso no AJAX
            Lobibox.notify('success', {
                title: 'Ponto cadastrado',
                msg: mostrarHora(),
            });
            window.location.href = "cadastraPonto.php";
        },
        error: function (request, status, erro) {
            alert("Problema ocorrido: " + status + "\nDescição: " + erro);
            //Abaixo está listando os header do conteudo que você requisitou, só para confirmar se você setou os header e dataType corretos
            alert("Informações da requisição: \n" + request.getAllResponseHeaders());
        },
    });
    return false;
});
