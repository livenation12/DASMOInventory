
const handlePullOut = async (event) => {
          try {
                    const response = await useFormFetch(event, 'inventory/pullout')
                    if (response) {
                              Swal.fire({
                                        icon: 'success',
                                        title: 'Pulled out',
                                        text: 'Successfully pulled out item!',
                                        showConfirmButton: false,
                                        timer: 1000
                              }).then(() => {
                                        window.location.reload();
                              })
                    }
          } catch (error) {
                    Toast.fire({
                              icon: 'error',
                              title: error.message || 'An unexpected error occurred.',
                    })
          }
};


const temporaryPullOutForm = document.getElementById('temporaryPullOutForm');
const permanentPullOutForm = document.getElementById('permanentPullOutForm');

temporaryPullOutForm.addEventListener('submit', handlePullOut);
permanentPullOutForm.addEventListener('submit', handlePullOut);