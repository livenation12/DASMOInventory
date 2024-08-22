const handleLogin = async (event) => {
    event.preventDefault()
    try {

        const response = await useFetch("login/verify", {
            method: "POST",
            body: new FormData(event.target)
        })
        if (response.success) {
            Toast.fire({
                icon: "success",
                title: "Logging in! Redirecting you to home...",
                timer: 800
            }).then(() => {
                event.target.reset();
                window.location.href = dasmoBaseUrl + "home";
            })

        } else {
            Toast.fire({
                icon: "error",
                title: response.error || "Error has occured"
            });
        }

    } catch (error) {
        Toast.fire({
            icon: "error",
            title: "Server error"
        });
    }
}

const loginForm = document.getElementById('loginForm');
loginForm.addEventListener('submit', handleLogin)