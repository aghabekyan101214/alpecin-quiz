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
                    targets: 5,
                    render: function(data, type, full, meta) {
                        var status = {
                            Order: {'title': 'Order', 'class': 'kt-badge--warning'},
                            Delivered: {'title': 'Delivered', 'class': ' kt-badge--success'},
                            Canceled: {'title': 'Canceled', 'class': ' kt-badge--danger'},
                            Paid: {'title': 'Paid', 'class': ' kt-badge--info'},
                            Production: {'title': 'Production', 'class': ' kt-badge--metal'},
                            Sent: {'title': 'Sent', 'class': ' kt-badge--primary'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
                    },
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
