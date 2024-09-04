const handleUpdateItem = async (event) => {
    event.preventDefault();
    try {
        const response = await useFormFetch(event, 'inventory/update')
        if (response) {
            Toast.fire({
                icon: "success",
                title: "Item updated successfully, synching your data"
            }).then(() => {
                window.location.reload();
            })
        }
    } catch (error) {
        console.log(error);

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
    updateSubmitBtn.disabled = !isFormChanged;
}
//listen to every input changes
updateItemForm.querySelectorAll('input').forEach(input => {
    input.addEventListener('input', checkFormChangesDisableSubmitButton);
});
checkFormChangesDisableSubmitButton();

