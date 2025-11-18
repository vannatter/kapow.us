/**
 * Main JavaScript entry point for Webpack
 *
 * This file serves as the entry point for bundling JavaScript assets
 * with Webpack. Import your dependencies and application code here.
 */

// Import jQuery (if using npm version instead of CDN)
// import $ from 'jquery';
// window.$ = window.jQuery = $;

// Import Bootstrap
import 'bootstrap';

// Import custom application styles
// import '../css/main.scss';

// Example: Import page-specific modules
// import './page/items';
// import './page/creators';
// import './page/shops';

console.log('Kapow.us - Modern build system initialized');

// You can add global initialization code here
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM ready');

    // Initialize Bootstrap tooltips if present
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize Bootstrap popovers if present
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});
