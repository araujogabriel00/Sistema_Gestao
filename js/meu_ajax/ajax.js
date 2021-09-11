// aqui o ajax do registro
$(document).ready(function () {
    $('#registro_form').submit(function () {
        var nome = $('#nome').val();
        var registroAcademico = $('#registroAcademico').val();
        var semestre = $('#opcaoSemestre').val();
        var sobrenome = $('#sobrenome').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirme_password = $('#confirme_password').val();
        var checked = $("input[name='opcao']:checked").val();

        // uma outra validaçãop para não ir dados vazio!
        if ($("#nome").val() === null || $("#sobrenome").val() === "" || $("#email").val() === "" || $("#password").val() === "" || $("#confirme_password").val() === "" || $('#registroAcademico').val() === "") {
            return false;
        }
        //batendo os passwords pra não ter erro
        if ($("#password").val() !== $("#confirme_password").val()) {
            Lobibox.notify('error', {
                tiltle: 'Erro',
                msg: 'Senhas não conferem!'
            });
            return false;
        }


        $.ajax({
            url: "cadastraUsuario.php", //Arquivo php
            type: "post", //Método de envio
            data: 
            "nome=" + nome +
            "&sobrenome=" + sobrenome + 
            "&email=" + email + 
            "&password=" + password +
            "&confirme_password=" + confirme_password +
            "&opcao=" + checked + 
            "&registroAcademico="+ registroAcademico +
            "&opcaoSemestre=" + semestre, //Dados
            success: function (data) {			//Sucesso no AJAX
                $('#registro_form')[0].reset();
                Lobibox.notify('success', {
                    tiltle: 'Sucesso',
                    msg: 'Usuario! ' + email + ' Cadastrado'
                });

            },
            error: function (request, status, erro) {
                alert("Problema ocorrido: " + status + "\nDescição: " + erro);
                //Abaixo está listando os header do conteudo que você requisitou, só para confirmar se você setou os header e dataType corretos
                alert("Informações da requisição: \n" + request.getAllResponseHeaders());
            },
        });
        return false;	//Evita que a página seja atualizada
    });




    



    

});
// fecha ajax do registro

/*
 * https://www.google.com/search?client=firefox-b-d&biw=1366&bih=666&ei=jqf7XqKEAomf5OUPmtSF2AI&q=bot%C3%A3o+jquery+vem+sem+formata%C3%A7%C3%A3o+de+classe&oq=bot%C3%A3o+jquery+vem+sem+formata%C3%A7%C3%A3o+de+classe&gs_lcp=CgZwc3ktYWIQAzoECAAQRzoCCAA6BQgAELEDOgUIABCDAToECAAQQzoHCAAQsQMQQzoGCAAQFhAeOgQIABATOgYIABAKEBM6CAgAEBYQHhATOgoIABAWEAoQHhATOgQIABANOgYIABANEB46BQghEKABOgcIIRAKEKABOgkIABBDEEYQ-QE6BAgAEAo6CAgAEBYQChAeOgcIABCDARBDOggIIRAWEB0QHlC0lHZY6pJ4YK2WeGgUcAN4AIABuAGIAYxSkgEEMC43M5gBAKABAaoBB2d3cy13aXqwAQA&sclient=psy-ab&ved=0ahUKEwiig7yLt6rqAhWJD7kGHRpqASsQ4dUDCAs&uact=5
 * https://pt.stackoverflow.com/questions/398565/jquery-mask-n%C3%A3o-funciona-em-elementos-criados-de-forma-din%C3%A2mica
 * https://webdevacademy.com.br/tutoriais/adicionar-linhas-tabela-jquery/
 * https://webdevacademy.com.br/tutoriais/remover-linhas-tabela-jquery/
 */