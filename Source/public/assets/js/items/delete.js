const deleteItemBtn = document.getElementById('deleteItem')
const itemId = deleteItemBtn.getAttribute('data-item-id')
const deleteItem = async () => {
          const response = useFetch(`inventory/delete/${itemId}`, {
                    method: "POST"
          })
          if (response) {
                    Toast.fire({
                              icon: "success",
                              title: "Item deleted successfully, synching your data"
                    }).then(() => {
                              window.location.href= dasmoBaseUrl + "inventory";
                    })
          }

}
deleteItemBtn.addEventListener('click', () => deleteItem())