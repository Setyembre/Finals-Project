// script.js
// Add event listeners to buttons and form submission

document.addEventListener('DOMContentLoaded', () => {
    const learnMoreButton = document.querySelector('#hero button');
    learnMoreButton.addEventListener('click', () => {
        // Add functionality to learn more button
    });
        
    const contactForm = document.querySelector('#contact form');
    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Add functionality to form submission
    });
});
const dropdownToggle = document.getElementById('navbarDropdown');
const dropdownMenu = document.querySelector('.dropdown-menu');

dropdownToggle.addEventListener('click', () => {
  dropdownMenu.classList.toggle('show');
  // Open Services Sidebar
document.querySelector('.services-btn').addEventListener('click', function() {
    document.getElementById("servicesSidebar").style.display = "block";
    document.getElementById('contact-btn').addEventListener('click', function() {
        document.getElementById('contact-sidebar').classList.add('show');
      });
  
      function closeContactSidebar() {
        document.getElementById('contact-sidebar').classList.remove('show');
      }
});
  
});
