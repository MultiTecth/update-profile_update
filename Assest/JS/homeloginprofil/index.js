function browseTab() {
    // Function to handle browse tab
    alert('Browse tab clicked');
    // You can add your logic here to navigate to the browse tab
}

function userTab() {
    // Function to handle user tab
    alert('User tab clicked');
    // You can add your logic here to navigate to the user tab
}

const searchInput = document.querySelector('.search-input');
const searchDropdown = document.querySelector('.search-dropdown');

searchInput.addEventListener('focus', function() {
    // Show the dropdown when search input is focused
    searchDropdown.style.display = 'block';
});

searchInput.addEventListener('blur', function() {
    // Hide the dropdown when search input is blurred
    searchDropdown.style.display = 'none';
});s