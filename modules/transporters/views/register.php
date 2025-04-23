<div class="content-wrapper">
    <div class="container-fluid">
        <div class="animal-form-name mb-5">
            <h5 class="h3 mb-0 ml-4">Livestock Transporter</h5>
            <p class="pl-4 mt-1">Apply to Become a Verified Livestock Transporter</p>
        </div>    

        <div class="register-animal-form my-4 px-4">
            <?php echo form_open_upload($location, ['id' => 'regForm']);?>
                <div class="tab">
                    <?php require_once 'step_1.php';?>
                </div>
                <div class="tab">
                    <?php require_once 'step_2.php';?>
                </div>
                <div class="tab">
                    <?php require_once 'step_3.php';?>
                </div>
                <hr>
                <div class="form-footer d-flex justify-content-between"> 
                    <div>
                        <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-outline-dark">Back</button>
                    </div>
                    <div> 
                        <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-success">Next</button>
                        <?php
                            $btn_submit_application_attr = [
                                'class' => 'btn btn-success',
                                'id' => 'submitBtn'
                            ];
                            echo form_submit('submit', 'Submit Application', $btn_submit_application_attr);
                        ?>
                    </div>

                </div>
            <?php echo form_close();?>
        </div>
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </div>
</div>

<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form ...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        // ... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("submitBtn").style.display = "inline";
            // document.getElementById("nextBtn").innerHTML = "Submit Application";
        } else {
            document.getElementById("nextBtn").style.display = "inline";
            document.getElementById("submitBtn").style.display = "none";
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        // ... and run a function that displays the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        console.log(n);
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        console.log('no of tabs=' + x.length);
        // Exit the function if any field in the current tab is invalid:
        if (!validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false:
                valid = false;
            }else{
                y[i].className = y[i].className.replace(" invalid", "");
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
    }    
</script>

<style>


/* Style the input fields */

    input.invalid {
        background-color: #ffdddd;
    }
    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    /* Mark the active step: */
    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #04AA6D;
    }
    .tab {
        display: none;
    }

    .validation-error-alert {
        display: block;
    }
</style>