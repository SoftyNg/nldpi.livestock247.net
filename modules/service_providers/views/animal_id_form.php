<style>
        /* Green navigation bar styling */
        .accordion-header {
            flex-grow: 1; /* Make the buttons stretch equally across the bar */
            text-align: center;
        }

        .accordion-button {
            background-color: #28a745; /* Green background */
            color: white;             /* White text */
            border: none;
            text-transform: uppercase;
            padding: 15px;
            width: 100%;              /* Stretch full width */
        }

        .accordion-button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .accordion-button.collapsed {
            background-color: #28a745; /* Ensure inactive buttons remain green */
        }

        .accordion-button:focus {
            box-shadow: none; /* Remove Bootstrap focus outline */
        }

        /* Underline the active page */
        .accordion-button:not(.collapsed) {
            border-bottom: 3px solid white; /* White underline for active page */
        }
           /* Green Navigation Bar Styling */
           .nav {
            background-color: #005229; /* Dark green background for the nav bar */
            padding: 10px 0;
        }

        .nav-link-a {
            color: white;                /* White text for nav links */
           /* Uppercase text */
            font-weight: bold;           /* Bold links */
            padding: 10px 20px;
        }

        .nav-link-a:hover {
            text-decoration: underline;  /* Underline on hover */
        }

        .nav-link-a.active {
            text-decoration: underline;  /* Underline active link */
        }

        /* Accordion Body Section Styling */
        .accordion-body {
            padding: 20px;
            background-color: #F5FCF9;   /* Light background for content */
            border-top: 2px solid #005229; /* Green border at the top */
        }


        .custom-file-input-mine {
    position: relative;
    display: inline-block;
    width: 100%;
}

.custom-file-input-mine input[type="file"] {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}
    </style>
 <div class="container-fluid mb-4 pt-5">
   <h1>.</h1>

    <!-- Horizontal Navigation Bar with Row and Column -->
    <div class="row" style="background-color:#005229;">
        <div class="col-md-12">
            <ul class="nav">
                <li class="nav-item" style="color:#FFF">
                    <a class="nav-link-a active"  href="#" onclick="showStep(1); return false;">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-a" href="#" onclick="showStep(2); return false;">Management Team</a>
                </li>
              
            </ul>
        </div>
    </div>

    <!-- Accordion Content Sections (Displayed when clicked) -->
    <div id="step1" class="accordion-body">
    <?php require_once("_step_one_form.php"); ?> 
    </div>

    <div id="step2" class="accordion-body" style="display:none;">
    <?php require_once("_step_two_form.php"); ?>  
    </div>

</div>

<script>
    function showStep(stepNumber) {
        // Hide all sections first
        document.querySelectorAll('.accordion-body').forEach(function(section) {
            section.style.display = 'none';
        });

        // Remove active class from all links
        document.querySelectorAll('.nav-link').forEach(function(link) {
            link.classList.remove('active');
        });

        // Show the selected section and set active class
        document.getElementById('step' + stepNumber).style.display = 'block';
        document.querySelectorAll('.nav-link')[stepNumber - 1].classList.add('active');
    }

      // Function to handle form cancellation
      function cancelForm() {
            if(confirm('Are you sure you want to cancel? All data will be lost.')) {
                // Reset all forms
                document.querySelectorAll('form').forEach(form => form.reset());
                // Go back to first step
                showStep(1);
            }
        }

        // Function to toggle password visibility
function togglePassword(passwordId) {
    const passwordInput = document.getElementById(passwordId);
    const toggleIcon = passwordInput.nextElementSibling;
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.textContent = '🔒';
    } else {
        passwordInput.type = 'password';
        toggleIcon.textContent = '👁️';
    }
}



document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const passwordError = document.getElementById("passwordError");
    const confirmPasswordError = document.getElementById("confirmPasswordError");
    const submitButton = document.querySelector("form button[type='submit']");

    function validatePassword() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        // Password validation criteria
        const minLength = 8;
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumber = /\d/.test(password);
        const hasSpecialChar = /[\W_]/.test(password);
        let isValid = true;

        if (password.length < minLength || !hasUpperCase || !hasLowerCase || !hasNumber || !hasSpecialChar) {
            passwordError.innerHTML = "Password must be at least 8 characters, include uppercase, lowercase, a number, and a special character.";
            isValid = false;
        } else {
            passwordError.innerHTML = "";
        }

        if (password !== confirmPassword) {
            confirmPasswordError.innerHTML = "Passwords do not match.";
            isValid = false;
        } else {
            confirmPasswordError.innerHTML = "";
        }

        return isValid;
    }

    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === "password" ? "text" : "password";
    }

    // Validate on input
    passwordInput.addEventListener("input", validatePassword);
    confirmPasswordInput.addEventListener("input", validatePassword);

    // Prevent form submission if validation fails
    document.querySelector("form").addEventListener("submit", function (event) {
        if (!validatePassword()) {
            event.preventDefault();
        }
    });
});
function validateAndProceed() {
    const requiredFields = [
        'companyName',
        'companyEmail',
        'years',
        'cac',
        'address',
        'phone',
        'website',
        'state'
    ];

    let isValid = true;

    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        const value = field.value.trim(); // Trim whitespace to avoid empty-looking spaces
        
        if (!value) {
            isValid = false; // Mark as invalid if any field is empty
            field.style.border = '2px solid red'; // Highlight empty field
        } else {
            field.style.border = ''; // Reset border if field is filled
        }
    });

    if (isValid) {
        //saveFormProgress();  // Save form progress
        showStep(2);         // Proceed to the next step only if all fields are valid
    } else {
        alert('Please fill out all required fields before proceeding.');
    }
}


</script>