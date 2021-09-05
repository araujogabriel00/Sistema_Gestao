(function ($) {

    "use strict";



        $('.row').on('click', '#deslogar', function () {

        var id = $(this).val();

        const element = this;

        $.ajax({//Função AJAX

            url: "deslogar.php",

            type: "post",

            data: "id=" + id,

            success: function (data) {

                $(element).closest('.author-permissio-wrap').remove();

                Lobibox.notify('info', {

                    msg: 'Usuário DESTRAVADO já pode logar na estação.'

                });

            },

            error: function (data) {

                Lobibox.notify('error', {

                    title: 'Erro',

                    msg: 'Deu pau!!! Corra pras Colinas'

                });

            }

        });

    });

})(jQuery);











