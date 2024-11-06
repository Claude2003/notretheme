document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const closeBtn = document.getElementById('closeBtn');

    menuToggle.addEventListener('click', () => {
        sidebar.classList.add('open');
    });

    closeBtn.addEventListener('click', () => {
        sidebar.classList.remove('open');
    });
});
