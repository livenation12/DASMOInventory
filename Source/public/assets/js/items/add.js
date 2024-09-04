const handleAddItem = async (event) => {
    try {
        const response = await useFormFetch(event, 'inventory/add')
        if (response) {
            Toast.fire({
                icon: "success",
                title: "Item added successfully"
            });
            event.target.reset();
            $('#inventoryTable').DataTable().ajax.reload();
        }
    } catch (error) {
        Toast.fire({
            icon: "error",
            title: "Server error"
        });
    }
}

const addItemForm = document.getElementById('addItemForm');
addItemForm.addEventListener('submit', handleAddItem)
