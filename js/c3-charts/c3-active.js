(function ($) {

 "use strict";
            var valorBotao = $('#btHora').val();
            c3.generate({
                bindto: '#pie',
                data:{
                    columns: [

                        ['HorasTrabalhadas',1],
                        ['Faltam', 10]

                    ],

                    colors:{

                        HorasTrabalhadas: '#03a9f4',

                        Faltam: '#303030'

                    },

                    type : 'pie'

                }

            });

})(jQuery); 

