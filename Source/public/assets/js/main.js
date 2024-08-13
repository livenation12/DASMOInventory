const dasmoBaseUrl = 'http://localhost/DASMOInventory/Source/public/';
const handleSignout = () => {
          Swal.fire({
                    title: 'Are you sure you want to logout?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Logout!'
          }).then((result) => {
                    if (result.isConfirmed) {
                              window.location.href = dasmoBaseUrl + 'logout';
                    }
          })
};

const Toast = Swal.mixin({
          toast: true,
          position: "bottom-start",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
          }
});



const useFetch = async (url, request) => {
          const defaultRequest = {
                    method: 'POST',
                    body: JSON.stringify({}),
          }
          const finalRequest = { ...defaultRequest, ...request }
          try {
                    const response = await fetch(dasmoBaseUrl + url, finalRequest);
                    if (!response.ok) {
                              // If the response status is not OK, throw an error to be caught in the catch block
                              const errorData = await response.json();
                              throw new Error(errorData.message || 'An error occurred');
                    }
                    const data = await response.json();
                    return data;
          } catch (error) {
                    throw error;
          }
};

const useFormFetch = (event, url) => {
          event.preventDefault();
          return new Promise((resolve, reject) => {
                    try {
                              const response = useFetch(url, {
                                        method: 'POST',
                                        body: new FormData(event.target),
                              })
                              if (response) {
                                        resolve(response)
                              } else {
                                        reject(response)
                              }
                    } catch (error) {
                              reject(error)
                    }
          })
}

window.addEventListener("offline", function(){
          Toast.fire({
                    icon: "info",
                    title: "Connection lost",
          })
})

window.addEventListener("online", function(){
          Toast.fire({
                    icon: "info",
                    title: "Connection restored",
          })
})
