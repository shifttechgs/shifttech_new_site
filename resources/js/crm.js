import './bootstrap';

// CRM-specific JS utilities
window.crmSidebar = function () {
    return {
        open: false,
        toggle() { this.open = !this.open; },
        close() { this.open = false; },
    };
};

window.crmDropdown = function () {
    return {
        open: false,
        toggle() { this.open = !this.open; },
        close() { this.open = false; },
    };
};
