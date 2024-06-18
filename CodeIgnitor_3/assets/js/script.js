document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    
    // Check if the image input element exists
    if (imageInput) {
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
            
            if (file && !validImageTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Image File',
                    text: 'Please upload a valid image file (gif, jpg, jpeg, png).',
                    confirmButtonText: 'OK'
                });
                event.target.value = '';  // Clear the input value to reset the file input
            }
        });
    } else {
        console.error("Element with ID 'image' not found.");
    }
});
