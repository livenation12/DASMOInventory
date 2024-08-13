
const handleReturnItem = async (event) => {
          try {
                    const response = await useFormFetch(event, 'inventory/returnItem')
                    if (response) {

                              Swal.fire({
                                        icon: 'success',
                                        title: 'Returned',
                                        text: 'Successfully returned item!',
                                        showConfirmButton: false,
                                        timer: 1000
                              }).then(() => {
                                        returnItemForm.reset();
                                        window.location.reload();
                              }
                              )
                    }
          } catch (error) {
                    Toast.fire({
                              icon: "error",
                              title: "Server error"
                    });
          }
};

const returnItemForm = document.getElementById('returnItemForm');
returnItemForm.addEventListener('submit', handleReturnItem);
