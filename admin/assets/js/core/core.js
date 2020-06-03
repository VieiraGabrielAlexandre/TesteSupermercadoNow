function triggerResize(){
	setTimeout(function(){
		$(window).trigger('resize');
	},1);
}

function changeSidebar(){
	setTimeout(function(){
		createCookie('sidebar-open',$('body').is('.sidebar-xs')+0,999);
	},500);
}

function createCookie(name,value,days){
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name){
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function removeCookie(name){
    createCookie(name,"",-1);
}

function checkCookie(name){
    return readCookie(name) != null;
}

function loadMasks(){
    $('.data:input, .data :input').formatter({
        pattern: '{{99}}/{{99}}/{{9999}}'
    });

    $('.cpf:input, .cpf :input').each(function(i,e){
        $(this).formatter({
            pattern: '{{999}}.{{999}}.{{999}}-{{99}}'
            // persistent: true
        });
    });

    $('.cnpj:input, .cnpj :input').each(function(i,e){
        $(this).formatter({
            pattern: '{{99}}.{{999}}.{{999}}/{{9999}}-{{99}}'
            // persistent: true
        });
    });

    $('.cep:input, .cep :input').each(function(i,e){
        $(this).formatter({
            pattern: '{{99999}}-{{999}}'
            // persistent: true
        });
    });

    $('.telefone_brasil:input, .telefone_brasil :input').each(function(i,e){
        $(this).formatter({
            pattern: '({{99}}) {{9999}}-{{99999}}'
            // persistent: true
        });
    });

    $('.data:input, .data :input').each(function(i,e){
        $(this).formatter({
            pattern: '{{99}}/{{99}}/{{9999}}'
            // persistent: true
        });
    });
}

$(document).ready(function(){

    if(readCookie('sidebar-open')=='1')
        $('body').addClass('sidebar-xs');

    $('[data-modal]').click(function(){

        var $modal = $('#modal-'+$(this).attr('data-modal'));
        console.log("CLICK",$modal,'#modal-'+$(this).attr('data-modal'));
        var modal_link = false;
        if($(this).attr('href') && $(this).attr('href') != '#')
            modal_link = $(this).attr('href');

        if(modal_link){
            setTimeout(function(){
                $modal.find('iframe').attr("src",modal_link);
            },1000);
        }else{
            $modal.find('iframe').remove();
        }

        $modal.on('hidden.bs.modal', function(e){
            if($modal.find('iframe').length)
                $modal.find('iframe').attr('src','');
        });

        $modal.modal('toggle');

        return false;
    });

    loadMasks();

    $(".upload-single,.upload-multiple").each(function(){
        $(this).uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    });
    
    // $('.daterange-single').daterangepicker({ 
    //     singleDatePicker: true,
    //     locale: {
    //       format: 'DD/MM/YYYY'
    //     },
    //     // autoUpdateInput: false,
    // });

    jQuery.extend( jQuery.fn.pickadate.defaults, {
        monthsFull: [ 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro' ],
        monthsShort: [ 'jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez' ],
        weekdaysFull: [ 'domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado' ],
        weekdaysShort: [ 'dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab' ],
        today: 'hoje',
        clear: 'limpar',
        close: 'fechar',
        format: 'dd/mm/yyyy',
        formatSubmit: 'dd/mm/yy'
    });

    jQuery.extend( jQuery.fn.pickatime.defaults, {
        clear: 'limpar'
    });

    $('.daterange-single').pickadate();


    // DATATABLE
    if(typeof no_grid != "undefined" && no_grid){
        $('.datatable-button-init-basic').parent().remove();
        return false;
    }

    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            lengthMenu: '<span>Mostrar:</span> _MENU_',
            paginate: { 'first': 'Primeira', 'last': 'Última', 'next': '&rarr;', 'previous': '&larr;' }
        }
    });

    // Basic initialization
    if (!$('.datatable-button-init-basic').length)
      return false;

    var settings = {
        bLengthChange: show_pagination?show_pagination:false,
        pageLength: pagination_default?pagination_default:50,
        bSort: no_order?false:true,
        dom: (no_header?'':'<"datatable-header"fBl>')+'<"datatable-scroll-wrap"t>'+(no_footer?'':'<"datatable-footer"ip>'),
        order: [[ order_colum?order_colum:0, ( order_by?order_by.toLowerCase():'asc' )]],
        buttons: {
            dom: {
                button: {
                    className: 'btn btn-default'
                }
            },
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel'},
                {extend: 'pdf'},
                {extend: 'print'}
            ]
        },
        initComplete: function () {
            if(!show_search)
                $('#DataTables_Table_0_filter').hide();
            if(typeof no_filter != 'undefined' && no_filter){
                $('#DataTables_Table_0 tfoot').remove()
                return false;
            }
            if(typeof no_save != "undefined" && no_save){
                $('#DataTables_Table_0_wrapper .dt-buttons').hide();

            }
            if(typeof no_save != "undefined" && no_save && !show_search){
                $('#DataTables_Table_0_wrapper .datatable-header').hide();
            }
            if(typeof no_dropdown !== "undefined" && no_dropdown){

            }else{
                this.api().columns().every( function() {
                    var column = this;
                    var select = $('<select class="filter-select" data-placeholder="Filtro"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        });

                    column.data().unique().sort().each( function (d, j) {
                        var doc = new DOMParser().parseFromString(d, "text/html");
                        text = $('body',doc).text();
                        select.append('<option value="'+text+'">'+text+'</option>')
                    });
                });
            }
        }
    }
    if($('.datatable-button-init-basic thead th:last').text() == 'Ação'){
        settings.columnDefs = [
           { orderable: false, targets: -1 }
        ];
    }

    $('.datatable-button-init-basic').DataTable(settings);

    $('.filter-select').select2({
        allowClear: true
    });

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Digite para buscar...');


    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });

    if($('[data-popup="lightbox"]').length){
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
    }

    $('[data-alert="remover"],[data-alert="remove"],[data-alerta="remover"],[data-alerta="remove"]').on('click', function(){
        var url = $(this).attr('href');
        swal({
            title: "Você tem certeza?",
            text: "Você não poderá desfazer esta ação!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FF7043",
            confirmButtonText: "Continuar",
            cancelButtonText: "Cancelar",
        },
        function(isConfirm){
            if(isConfirm)
                window.location.href = url;
        });
        return false;
    });

});