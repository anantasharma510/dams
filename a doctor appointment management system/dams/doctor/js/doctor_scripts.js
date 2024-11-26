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
            // Get the link name text
            const linkName = this.querySelector('.link-name').textContent.trim();

            // Only prevent default behavior for links other than "Set Availability"
            if (linkName !== "Set Availability") {
                event.preventDefault();
            }

            // Check if sidebar is closed; if so, open it before showing submenu
            if (sidebar.classList.contains('close')) {
                sidebar.classList.remove('close');
                localStorage.setItem("status", "open");
            }

            // Toggle the clicked submenu
            const submenu = this.nextElementSibling;
            const dropdownIcon = this.querySelector('.dropdown-icon');
            if (submenu) {
                submenu.classList.toggle('active');
                if (dropdownIcon) {
                    dropdownIcon.classList.toggle('rotate');
                }

                // Optional: Close other submenus if only one should be open at a time
                submenus.forEach((otherSubmenu, otherIndex) => {
                    if (otherSubmenu !== submenu && otherSubmenu.classList.contains('active')) {
                        otherSubmenu.classList.remove('active');
                        dropdownIcons[otherIndex].classList.remove('rotate');
                    }
                });
            }
        });
    });
});
