function toggleSubMenu() {
    var submenu = document.getElementById('submenu');
    submenu.style.display = (submenu.style.display === 'none' || submenu.style.display === '') ? 'block' : 'none';
}

function toggleDropdown(dropdownId) {
    var dropdown = document.getElementById(dropdownId);
    dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
}
function toggleSubMenu() {
    var submenu = document.getElementById('submenu');
    submenu.classList.toggle('show');
}

function toggleDropdown(dropdownId) {
    var dropdown = document.getElementById(dropdownId);
    dropdown.classList.toggle('show');
}
