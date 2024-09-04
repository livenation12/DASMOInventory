const dasmoBaseUrl = 'http://localhost/DASMOInventory/Source/public/';


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
    try {
        const response = await fetch(dasmoBaseUrl + url, request);
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

const useFormFetch = async (event, url) => {
    event.preventDefault();
    try {
        const response = await useFetch(url, {
            method: 'POST',
            body: new FormData(event.target),
        });

        // Assuming `response` has a `success` field to determine the success
        if (response.success) {
            return response; // Resolve the Promise with response
        } else {
            console.error(response);
            Toast.fire({
                icon: "error",
                title: response.error || "There's something wrong"
            });
        }
    } catch (error) {
        throw error; // Reject the Promise with the error
    }
}

window.addEventListener("offline", function () {
    Toast.fire({
        icon: "info",
        title: "Connection lost",

    })
})

window.addEventListener("online", function () {
    Toast.fire({
        icon: "info",
        title: "Connection restored",
    })
})
