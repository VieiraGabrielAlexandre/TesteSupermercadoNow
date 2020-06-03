/* ------------------------------------------------------------------------------
*
*  # Reorder Columns extension for Datatables
*
*  Specific JS code additions for datatable_extension_reorder.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {

    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 5 ]
        }],
        colReorder: true,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            lengthMenu: '<span>Mostrar:</span> _MENU_',
            paginate: { 'first': 'Primeira', 'last': 'Última', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            lengthMenu: '<span>Mostrar:</span> _MENU_',
            paginate: { 'first': 'Primeira', 'last': 'Última', 'next': '&rarr;', 'previous': '&larr;' }
        }
    });

    // Basic column reorder
    $('.datatable-reorder').DataTable();


    // Realtime updating
    $('.datatable-reorder-realtime').DataTable({
        colReorder: {
            realtime: true
        }
    });

    // Save state after reorder
    $('.datatable-reorder-state-saving').DataTable({
        // stateSave: true,
        // searching: false,
        // bLengthChange: false,
        // pageLength: pagination_default,
        // "order": [[ order_colum, order_by ]],
        // fnDrawCallback: function(table) {
        //     $(table.nTableWrapper).find('.datatable-header').remove();
        // },
        // columnDefs: [
        //    { orderable: false, targets: -1 }
        // ],

        // buttons: {
        //     dom: {
        //         button: {
        //             className: 'btn btn-default'
        //         }
        //     },
        //     buttons: [
        //         {extend: 'copy'},
        //         {extend: 'csv'},
        //         {extend: 'excel'},
        //         {extend: 'pdf'},
        //         {extend: 'print'}
        //     ]
        // },


        // processing: true,
        // serverSide: true,

        // serverSide: true,
        // ajax: {
        //     url: 'ajax-admin?grid='+document.location.pathname.match(/[^\/]+$/)[0],
        //     type: 'POST',
        //     dataSrc: 'columns'
        // }

        // ajax: {
        //     url: 'ajax-admin?grid='+document.location.pathname.match(/[^\/]+$/)[0],
        //     dataSrc: 'data'
        // },
        // "columns": [
        //     { "data": "data" },
        //     { "data": "nome" },
        //     { "data": "cpf" },
        //     { "data": "email" },
        //     { "data": "telefone" },
        //     { "data": "perfil" },
        //     { "data": "status" },
        //     { "data": "nome" }
        // ]

        // "ajax": {
        //     "url": 'ajax-admin?grid='+document.location.pathname.match(/[^\/]+$/)[0],
        //     "type": "POST",
            // dataSrc : function (json){
            //     // console.log(json.columns);
            //     return json.columns;
            // }
        // },
        // ajaxSource: 'ajax-admin?grid='+document.location.pathname.match(/[^\/]+$/)[0],
        // "columns": [
        //     { "data": "data" },
        //     { "data": "nome" },
        //     { "data": "cpf" },
        //     { "data": "email" },
        //     { "data": "telefone" },
        //     { "data": "perfil" },
        //     { "data": "status" },
        //     { "data": "nome" },
        //   ]
        // ajax: 'json',
        // dataSrc: 'ajax-admin?grid='+document.location.pathname.match(/[^\/]+$/)[0],
        // columns: [
        //     // { "data": "data" },
        //     { "nome": "nome" },
        //     { "nome": "nome" },
        //     { "nome": "nome" },
        //     { "nome": "nome" },
        //     { "nome": "nome" },
        //     { "nome": "nome" },
        //     { "nome": "nome" },
        //     { "nome": "nome" },
            // { "cpf": "cpf" },
            // { "email": "email" },
            // { "telefone": "telefone" },
            // { "perfil": "perfil" },
            // { "status": "status" },
            // { "data": null },
        // ]
    });


    // Predefined column ordering
    $('.datatable-reorder-predefined').DataTable({
        colReorder: {
            order: [1, 3, 2, 4, 0, 5]
        }
    });



    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Digite para buscar...');


    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
    
});