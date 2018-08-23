$(document).ready(function() {

    var menu = false;

    $("#menu li").each(function(e) { 

        if ($(this).attr('id') == controller) {
            menu = true;
            $(this).addClass('active');
        } else {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
        }
    });

    if (!menu) {
        $("#principal").addClass('active');
    }

    $(".componenteData").each(function(e) { 

        var date = $(this).val();

        if (date.length > 0) { 
           
            var dateSplit = date.split("-");
            
            var dateConvert = dateSplit[2] + '/' + dateSplit[1] + '/' + dateSplit[0];

            $(this).val(dateConvert);
        }

    });
    
    $('.componenteData').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR'
    });

    $(".componenteDataHora").each(function(e) {

        var date = $(this).val();

        if (date.length > 0) { 
           
            var dataHora = date.split(" ");

            var dateSplit = dataHora[0].split("-");
            
            var dateConvert = dateSplit[2] + '/' + dateSplit[1] + '/' + dateSplit[0];

            $(this).val(dateConvert + " " + dataHora[1].substr(0, 5));
        }

    });

    $(".multiple_remove").click(function() {
        $(this).closest('.multiple').remove();
    });

    $(".multiple_add").click(function() {

        var e = $(this).parent().parent();

        var content = $(e).clone().find("i").remove().end().html();

        $( "<div class='col-md-12'>" + content + "</div>" ).insertBefore( e );
    });

    $(function() {
        $('.componenteDataHora').datetimepicker({
            format: 'dd/mm/yyyy hh:ii',
            autoclose: true
        });
    });

    $("form").submit(function(){
        
        $(".componenteData").each(function(e) { 

            var date = $(this).val();

            if (date.length > 0) { 
               
                var dateSplit = date.split("/");

                var dateConvert = dateSplit[2] + '-' + dateSplit[1] + '-' + dateSplit[0];

                $(this).val(dateConvert);
            }
        });

        $(".componenteDataHora").each(function(e) {

            var date = $(this).val();

            if (date.length > 0) { 
               
                var dataHora = date.split(" ");

                var dateSplit = dataHora[0].split("/");
                
                var dateConvert = dateSplit[2] + '-' + dateSplit[1] + '-' + dateSplit[0];

                $(this).val(dateConvert + " " + dataHora[1] + ":00");
            }

        });
    });

    $(".money").maskMoney();

    $('.cep').mask('99999-999');

    $('.data').mask('99/99/9999');

    $('.dataehora').mask('99/99/9999 99:99');

    $('.cpf').mask('999.999.999-99');

    $('.cnpj').mask('99.999.999/9999-99');

    $('.telefone').focusout(function(){
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    }).trigger('focusout');

    $(".fancybox").fancybox({
        openEffect  : 'none',
        closeEffect : 'none'
    });

    tinymce.init({
        selector: "textarea.tinymce",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste "
        ],
        plugin_preview_width : "900",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });

    var table = $('#datatable').DataTable( {
        "scrollX": true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": base + '/swf/copy_csv_xls_pdf.swf',
            "aButtons": [
                {
                    "sExtends":       "collection",
                    "sButtonText": "Exportar",
                    "aButtons":    [ "xls", "pdf" ]
                }
            ]
        },
        "oLanguage": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    } );

} );