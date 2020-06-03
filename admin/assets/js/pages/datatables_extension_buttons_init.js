/* ------------------------------------------------------------------------------
*
*  # Buttons extension for Datatables. Init examples
*
*  Specific JS code additions for datatable_extension_buttons_init.html page
*
*  Version: 1.0
*  Latest update: Nov 9, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Table setup
    // ------------------------------

    // Setting datatable defaults
    // $.extend( $.fn.dataTable.defaults, {
    //     autoWidth: false,
    //     dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
    //     language: {
    //         search: '<span>Filtro:</span> _INPUT_',
    //         lengthMenu: '<span>Mostrar:</span> _MENU_',
    //         paginate: { 'first': 'Primeira', 'last': 'Última', 'next': '&rarr;', 'previous': '&larr;' }
    //     },
    //     // drawCallback: function () {
    //     //     $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
    //     // },
    //     // preDrawCallback: function() {
    //     //     $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
    //     // }
    // });

    // $('.datatable-button-init-basic tfoot td').not(':last-child').each(function () {
    //     var title = $('.datatable-button-init-basic thead th').eq($(this).index()).text();
    //     $(this).html('<input type="text" class="form-control input-sm" placeholder="Search '+title+'" />');
    // });
    // var table = $('.datatable-button-init-basic').DataTable();
    // table.columns().every( function () {
    //     var that = this;
    //     $('input', this.footer()).on('keyup change', function () {
    //         that.search(this.value).draw();
    //     });
    // });

    // Basic initialization
    // if(!$('.datatable-button-init-basic').length) return false;
    // $('.datatable-button-init-basic').DataTable({
    //     buttons: {
    //         dom: {
    //             button: {
    //                 className: 'btn btn-default'
    //             }
    //         },
    //         buttons: [
    //             {extend: 'copy'},
    //             {extend: 'csv'},
    //             {extend: 'excel'},
    //             {extend: 'pdf'},
    //             {extend: 'print'}
    //         ]
    //     },

    // });


    // Custom button
    $('.datatable-button-init-custom').DataTable({
        buttons: [
            {
                text: 'Custom button',
                className: 'btn bg-teal-400',
                action: function(e, dt, node, config) {
                    swal({
                        title: "Good job!",
                        text: "Custom button activated",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    });
                }
            }
        ]
    });


    // Buttons collection
    $('.datatable-button-init-collection').DataTable({
        buttons: [
            {
                extend: 'collection',
                text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                className: 'btn bg-blue btn-icon',
                buttons: [
                    {
                        text: 'Toggle first name',
                        action: function ( e, dt, node, config ) {
                            dt.column( 0 ).visible( ! dt.column( 0 ).visible() );
                        }
                    },
                    {
                        text: 'Toggle status',
                        action: function ( e, dt, node, config ) {
                            dt.column( -2 ).visible( ! dt.column( -2 ).visible() );
                        }
                    }
                ]
            }
        ]
    });


    // Page length
    $('.datatable-button-init-length').DataTable({
        dom: '<"datatable-header"fB><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            {
                extend: 'pageLength',
                className: 'btn bg-slate-600'
            }
        ]
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
