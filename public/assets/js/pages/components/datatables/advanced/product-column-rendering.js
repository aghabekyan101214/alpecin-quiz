"use strict";
var KTDatatablesAdvancedColumnRendering = function() {

    var initTable1 = function() {
        var table = $('#kt_table_1');

        // begin first table
        table.DataTable({
            responsive: true,
            paging: true,
            ordering: false,
            columnDefs: [
                {

                },
            ],
        });
    };

    return {

        //main function to initiate the module
        init: function() {
            initTable1();
        }
    };
}();

jQuery(document).ready(function() {
    KTDatatablesAdvancedColumnRendering.init();
});
