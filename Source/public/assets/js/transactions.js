
$(document).ready(function () {
    const toExportTransactionColumns = [2, 3, 4, 5, 6, 7, 8, 9];
    $('#transactionsTable').DataTable({
        select: true,
        responsive: true,
        info: false,
        stateSave: true,
        ajax: {
            url: `${dasmoBaseUrl}transactions/fetch`,
            dataSrc: 'payload'
        },
        dom: 'Bfrtip', // Ensure buttons are included in the DOM
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: toExportTransactionColumns
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: toExportTransactionColumns
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: toExportTransactionColumns
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: toExportTransactionColumns
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: toExportTransactionColumns
                }
            }
        ],
        columns: [
            {

                data: 'status',
                orderable: false,
                render: function (data, type, row) {
                    return `<i class='fa-solid fa-circle-dot animate-pulse ${data > 0 ? 'text-yellow-500' : 'text-blue-500'} '></i>
                    <a title='Full details' href='${dasmoBaseUrl}inventory/items/${row.itemId}'>
                      <button
                        class='py-2 px-4 w-10'
                        type='button'>
                        <i class='fa-solid fa-ellipsis'></i>
                      </button>
                    </a>
                    `
                }
            },
            {
                data: 'quantity',
            },
            {
                //description column
                data: 'assetType',
                orderable: true,
                render: function (data, type, row) {
                    const assetType = data ? data : '';
                    const brand = row.brand ? row.brand : '';
                    return `${assetType} ${brand}`;
                }
            },
            { data: 'propNumber', orderable: false },
            { data: 'serialNumber', orderable: false },
            {
                orderable: true,
                data: 'fromLocation'
            },
            {
                orderable: true,
                data: 'toLocation'
            },
            {
                data: 'endUser',
                render: function (data) {
                    return `<p>${data ? data : ''}</p>`
                }
            },
            {
                data: 'pullOutType',
            },
            {
                orderable: true,
                data: 'pullOutDate',
            },
            {
                data: 'returnedDate',
                render: function(data){
                    return data ? data : '---'
                }
            },
        ]
    });
});
