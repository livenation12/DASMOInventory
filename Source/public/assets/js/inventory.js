$(document).ready(function () {
  $('#inventoryTable').DataTable({
    select: true,
    responsive: true,
    info: false,
    stateSave: true,
    ajax: {
      url: `${dasmoBaseUrl}inventory/fetch`,
      dataSrc: "payload"
    },
    dom: 'Bfrtip', // Ensure buttons are included in the DOM
    buttons: [
      {
        extend: 'copy',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6] // Include all columns in export
        }
      },
      {
        extend: 'csv',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6] // Include all columns in export
        }
      },
      {
        extend: 'excel',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6] // Include all columns in export
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6] // Include all columns in export
        }
      },
      {
        extend: 'print',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6] // Include all columns in export
        }
      }
    ],
    columns: [
    {
      data: 'quantity',
    },
    {
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
      data: 'designation'
    },
    {
      data: 'endUser',
      visible: false,
      render: function (data, type, row) {  
        return `<p class="hidden">${data ? data : ''}</p>`
      }
    },
    {
      orderable: false,
      data: 'itemId',
      render: function (data, type, row) {
        return `<a href="${dasmoBaseUrl}inventory/items/${data}">
                    <button
                      class="focus:ring-1 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-1 focus:outline-none"
                      type="button">
                      <i class="fa-solid fa-arrow-right"></i>
                    </button>
                  </a>`;
      }
    }
  ]
  });
});
