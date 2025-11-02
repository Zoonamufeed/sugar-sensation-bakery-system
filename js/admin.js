document.addEventListener('DOMContentLoaded', function () {
    // Menu toggle functionality
    let menu = document.querySelector('#menu-btn');
    let navbar = document.querySelector('.head .navbar');

    if (menu && navbar) {
        menu.onclick = () => {
            menu.classList.toggle('fa-times');
            navbar.classList.toggle('active');
        };
    }

    // Cancel button functionality
    const cancelButton = document.getElementById('close-edit');
    
    if (cancelButton) {
        cancelButton.addEventListener('click', function () {
            document.querySelector('.edit-form-container').style.display = 'none';
        });
    } else {
        console.log('Cancel button not found');
    }
});

/*let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.head .navbar');

menu.onclick = () =>{
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');
};
document.addEventListener('DOMContentLoaded', function () {
    // Check if the cancel button exists before adding the event listener
    const cancelButton = document.getElementById('close-edit');
    
    if (cancelButton) {
        cancelButton.addEventListener('click', function () {
            document.querySelector('.edit-form-container').style.display = 'none';
        });
    } else {
        console.log('Cancel button not found');
    }
});*/
