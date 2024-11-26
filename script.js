document.addEventListener('DOMContentLoaded', function() {
    // Get all Facebook buttons
    var fbButtons = document.querySelectorAll('.fb-button');
    
    // Add click event listener to each button
    fbButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            console.log('Navigating to: ' + this.getAttribute('href'));
        });
    });

    function openSidebar() {
        console.log("Sidebar opened");
        document.getElementById("supportSidebar").style.width = "300px";
    }
    
    
    function closeSidebar() {
        document.getElementById("supportSidebar").style.width = "0";
    }
    
    function openEmail() {
        window.location.href = "mailto:support@example.com";
    }
    
    function startLiveChat() {
        alert("Live Chat is starting..."); // Replace this with your live chat service integration
    }
    
    
    
    
    // Show the dropdown on page load
    document.getElementById("welcomeDropdown").classList.add("show");
});

// Function to display more details about the team member
function showDetails(name, studentId, age, address, email) {
    alert(`Details:\nName: ${name}\nStudent ID: ${studentId}\nAge: ${age}\nAddress: ${address}\nEmail: ${email}`);
}

// Function to close the dropdown
function closeDropdown() {
    document.getElementById("welcomeDropdown").classList.remove("show");
}
