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

document.getElementById('signout').addEventListener('click', handleSignout)
