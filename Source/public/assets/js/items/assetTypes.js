
const assetTypeField = document.getElementById('assetType')

const fetchAssetTypeOptions = async () => {
          try {
                    const { payload } = await useFetch('itemassets');
                    assetTypeField.innerHTML = '<option value="">Select an asset type</option>'; // Clear existing options
                    if (payload) {
                              payload.forEach(option => {
                                        const optionElement = document.createElement('option')
                                        optionElement.value = option.asset
                                        optionElement.textContent = option.asset
                                        assetTypeField.appendChild(optionElement)
                              });

                    }
          } catch (error) {
                    console.error(error)
          }
}

fetchAssetTypeOptions()