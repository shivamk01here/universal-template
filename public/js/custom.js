document.addEventListener('DOMContentLoaded', function () {
    // Accordion functionality for filters
    const accordionToggles = document.querySelectorAll('.sidebar-accordion-li > a');
    accordionToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            const menu = this.nextElementSibling;
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
                this.querySelector('i').classList.remove('fa-chevron-up');
                this.querySelector('i').classList.add('fa-chevron-down');
            } else {
                menu.style.display = 'block';
                this.querySelector('i').classList.remove('fa-chevron-down');
                this.querySelector('i').classList.add('fa-chevron-up');
            }
        });
    });
});




function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    if (!container) return;
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    const headerIcon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    const headerTitle = type === 'success' ? 'Success!' : 'Attention!';
    toast.innerHTML = `
        <div class="toast-header">
            <i class="fas ${headerIcon} mr-2"></i>
            <strong class="me-auto">${headerTitle}</strong>
            <button type="button" class="btn-close" onclick="this.parentElement.parentElement.remove()">×</button>
        </div>
        <div class="toast-body">${message}</div>
    `;
    container.appendChild(toast);
    setTimeout(() => toast.classList.add('showing'), 10);
    setTimeout(() => {
        toast.classList.remove('showing');
        toast.classList.add('hiding');
        toast.addEventListener('transitionend', () => toast.remove());
    }, 4000);
}