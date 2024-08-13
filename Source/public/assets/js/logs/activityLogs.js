
function getClassByAction(actionType) {
          // Map the colorCode to Tailwind CSS classes or use a default class
          const classMap = {
                    ADDED: 'text-green-400 ',    // Tailwind class for green
                    UPDATED: 'text-blue-400',      // Tailwind class for blue
                    DELETED: 'text-white-red-400' // Tailwind class for destructive
          };
          return classMap[actionType] || ''; // Default class
}


$(document).ready(function () {
          $('#activityLogsTable').DataTable({
                    info: false,
                    stateSave: true,
                    searching: false,
                    ordering: false,
                    paging: false,
                    ajax: {
                              url: `${dasmoBaseUrl}activitylogs`,
                              dataSrc: "payload"
                    },
                    columns: [
                              {
                                        orderable: true,
                                        render: function (data, type, row) {
                                                  console.log(row);

                                                  const colorClass = getClassByAction(row.action);
                                                  return `
                                                            <div class=" flex flex-col rounded py-2 text-sm">
                                                                  <p>
                                                                     <i class="fa fa-circle-dot ${colorClass} animate-pulse me-2"></i> 
                                                                                ${row.providerName}
                                                                                <span class="lowercase ">${row.action}</span>
                                                                                an item
                                                                      </p>
                                                                      <p class="text-[10px] self-end italic">${row.activityDate}</p>
                                                            </div>
                                                  `;
                                        }
                              }
                    ]
          });
});
