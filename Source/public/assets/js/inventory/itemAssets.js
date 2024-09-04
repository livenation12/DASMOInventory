$(document).ready(function () {
    $('#assetTypeTable').DataTable({
        info: false,
        stateSave: true,
        searching: false,
        ordering: false,
        paging: false,
        ajax: {
            url: `${dasmoBaseUrl}itemassets`,
            dataSrc: 'payload'
        },
        columns: [
            { data: 'asset' }
        ]
    })
})

const handleNewAsset = async (event) => {
    try {
        const response = useFormFetch(event, 'itemassets/create');
        if (response) {
            Toast.fire({
                icon: "success",
                title: "Asset type added successfully"
            });
            $('#assetTypeTable').DataTable().ajax.reload();
            newAssetForm.reset();
            fetchAssetTypeOptions();
        }
    } catch (error) {
        console.log(error);
    }
}

// Function to enable or disable the submit button based on input field value
const isBtnDisabled = () => {
    newAssetSubmitBtn.disabled = assetField.value.length === 0;
};

// Selecting DOM elements
const newAssetForm = document.getElementById('newAssetForm');
const newAssetSubmitBtn = document.getElementById('newAssetSubmitBtn');
const assetField = document.getElementById('assetField');

// Adding event listeners
newAssetForm.addEventListener('submit', handleNewAsset);
assetField.addEventListener('input', isBtnDisabled);
