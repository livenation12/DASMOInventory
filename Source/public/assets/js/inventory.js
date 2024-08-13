$(document).ready(function () {
          $('#inventoryTable').DataTable({
                    info: false,
                    stateSave: true,
                    ajax: {
                              url: `${dasmoBaseUrl}inventory/fetch`,
                              dataSrc: "payload"
                    },
                    columns: [
                              {
                                        data: 'quantity'
                              },
                              {
                                        data: 'assetType', orderable: true,
                                        render: function (data, type, row) {
                                                  const assetType = data ? data : ''
                                                  const brand = row.brand ? row.brand : ''
                                                  return `${assetType} ${brand}`
                                        }
                              },
                              { data: 'propNumber', orderable: false },
                              { data: 'serialNumber', orderable: false },
                              {
                                        data: 'designation',
                                        orderable: true,
                                        render: function (data, type, row) {
                                                  return row.currentLocation ? `${data} / ${row.currentLocation}` : data
                                        },
                              },
                              {
                                        orderable: false,
                                        data: 'itemId',
                                        render: function (data) {
                                                  return `<a href="${dasmoBaseUrl}inventory/items/${data}">
                                                                      <button
                                                                      class=" focus:ring-1 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-1 focus:outline-none"
                                                                      type="button">
                                                                      <i class="fa-solid fa-arrow-right"></i>
                                                                      </button>
                                                            </a>`;
                                        }
                              }
                    ]
          });
});
