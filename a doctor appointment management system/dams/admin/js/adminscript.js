const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle"),
      sidebar = body.querySelector("nav"),
      sidebarToggle = body.querySelector(".sidebar-toggle");

// Load saved settings
let getMode = localStorage.getItem("mode");
if(getMode && getMode === "dark"){
    body.classList.add("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus === "close"){
    sidebar.classList.add("close");
}

// Mode toggle
modeToggle.addEventListener("click", () => {
    body.classList.toggle("dark");
    localStorage.setItem("mode", body.classList.contains("dark") ? "dark" : "light");
});

// Sidebar toggle
sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");

    // Close all submenus and reset dropdown icons when sidebar is closed
    if(sidebar.classList.contains("close")){
        document.querySelectorAll('.submenu').forEach(submenu => submenu.classList.remove('active'));
        document.querySelectorAll('.dropdown-icon').forEach(icon => icon.classList.remove('rotate'));
    }

    localStorage.setItem("status", sidebar.classList.contains("close") ? "close" : "open");
});

// Dropdown menu
document.addEventListener('DOMContentLoaded', function() {
    const submenuToggles = document.querySelectorAll('.submenu-toggle');
    const submenus = document.querySelectorAll('.submenu');
    const dropdownIcons = document.querySelectorAll('.dropdown-icon');

    submenuToggles.forEach((toggle, index) => {
        toggle.addEventListener('click', function(event) {
            event.preventDefault();

            // Check if sidebar is closed; if so, open it before showing submenu
            if (sidebar.classList.contains('close')) {
                sidebar.classList.remove('close');
                localStorage.setItem("status", "open");
            }

            // Close all other submenus
            submenus.forEach((submenu, submenuIndex) => {
                if (submenuIndex !== index) {
                    submenu.classList.remove('active');
                    dropdownIcons[submenuIndex].classList.remove('rotate');
                }
            });

            // Toggle the clicked submenu
            const submenu = this.nextElementSibling;
            const dropdownIcon = this.querySelector('.dropdown-icon');
            submenu.classList.toggle('active');
            dropdownIcon.classList.toggle('rotate');
        });
    });
});