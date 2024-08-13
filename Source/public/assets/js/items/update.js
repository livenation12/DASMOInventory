const handleUpdateItem = async (event) => {
          event.preventDefault();
          const formData = new FormData(event.target)
          try {
                    const response = await useFetch('inventory/update', {
                              body: formData,
                    })
                    if (response.success) {
                              Swal.fire({
                                        icon: "success",
                                        title: "Item updated successfully",
                                        timer: 1000,
                                        showConfirmButton: false
                              }).then(() => {
                                        window.location.reload()
                              })
                    } else {
                              Toast.fire({
                                        icon: "error",
                                        title: response.error || "An error occurred"
                              });
                    }
          } catch (error) {
                    Toast.fire({
                              icon: "error",
                              title: "Server error"
                    });
          }
}

const updateItemForm = document.getElementById('updateItemForm');
const updateSubmitBtn = document.getElementById('updateSubmitBtn');
updateItemForm.addEventListener('submit', handleUpdateItem);


//get the initial values
const initialValues = {};
updateItemForm.querySelectorAll('input').forEach(input => {
          initialValues[input.name] = input.value;
})

// Add event listeners to inputs
const checkFormChangesDisableSubmitButton = () => {
          let isFormChanged = false;
          //check if form is changed by comparing with initial values tthen flag it
          updateItemForm.querySelectorAll('input').forEach(input => {
                    if (input.value !== initialValues[input.name]) {
                              isFormChanged = true;
                    }
          })

          //add disabled property to submit button if form is not changed base on the flag
          if (isFormChanged) {
                    updateSubmitBtn.disabled = false;
          } else {
                    updateSubmitBtn.disabled = true;

          }
}
//listen to every input changes
updateItemForm.querySelectorAll('input').forEach(input => {
          input.addEventListener('input', checkFormChangesDisableSubmitButton);
});
checkFormChangesDisableSubmitButton();

