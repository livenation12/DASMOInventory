const handleSignup = async (event) => {
    event.preventDefault()
    try {

        const response = await useFetch("signup/register", {
            method: "POST",
            body: new FormData(event.target)
        })
        if (response.success) {
            Toast.fire({
                icon: "success",
                title: "Signed up! Redirecting you to login..."
            })
            event.target.reset();
            window.location.href = dasmoBaseUrl + "login";
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

const signupForm = document.getElementById('signupForm');
signupForm.addEventListener('submit', handleSignup)