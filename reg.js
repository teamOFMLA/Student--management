document.addEventListener('DOMContentLoaded', function () {

    // Function to validate form fields
    function validateForm(formId) {
        console.log(`Validating form with ID: ${formId}`);
        const form = document.getElementById(formId);
        if (!form) {
            console.error(`Form with ID "${formId}" not found.`);
            return false;
        }
        if (!form.checkValidity()) {
            console.log(`Form with ID "${formId}" is invalid.`);
            form.classList.add('was-validated');
            return false;
        }
        form.classList.remove('was-validated');
        console.log(`Form with ID "${formId}" is valid.`);
        return true;
    }
  
    // Function to validate phone number
    function validatePhoneNumber(phoneNumber) {
        const phoneRegex = /^\+?\d{1,4}(\s?\d{1,4}){2,4}$/;
        const isValid = phoneRegex.test(phoneNumber);
        console.log(`Phone number "${phoneNumber}" is valid: ${isValid}`);
        return isValid;
    }
  
    // Function to show loading indicator
    function showLoading(button) {
        const span = button.querySelector('span');
        const icon = button.querySelector('i');
        if (span && icon) {
            button.disabled = true;
            span.textContent = 'جاري الارسال...';
            icon.classList.remove('bxs-check', 'bxs-chevrons-right');
            icon.classList.add('bx-loader', 'bx-spin');
            console.log("Loading indicator shown.");
        }
    }
  
    // Function to hide loading indicator
    function hideLoading(button, originalText, iconClass) {
        const span = button.querySelector('span');
        const icon = button.querySelector('i');
        if (span && icon) {
            button.disabled = false;
            span.textContent = originalText;
            icon.classList.add(iconClass);
            icon.classList.remove('bx-loader', 'bx-spin');
            console.log("Loading indicator hidden.");
        }
    }
  
    // Function to show toast notification
    function showToast(message, isSuccess) {
        console.log(`Showing toast: ${message}, Success: ${isSuccess}`);
  
        let liveToast = document.getElementById("liveToast");
        let toastMessage = document.getElementById('toast-alert-message');
  
        if (!liveToast || !toastMessage) {
            console.error("Toast elements not found.");
            return;
        }
  
        // Ensure the toast appears above everything
        liveToast.style.position = "fixed";
        liveToast.style.top = "20px";
        liveToast.style.right = "20px";
        liveToast.style.zIndex = "9999999"; // Ensure it's above other elements
        liveToast.style.display = "block"; // Ensure visibility
  
        // Set styles based on success or failure
        if (isSuccess) {
            liveToast.style.backgroundColor = "#BBF7D0";
            liveToast.style.color = 'green';
        } else {
            liveToast.style.backgroundColor = "#FECDD3";
            liveToast.style.color = 'red';
        }
  
        // Set the message text
        toastMessage.innerHTML = message;
  
        // Initialize and show Bootstrap Toast
        try {
            let myToast = new bootstrap.Toast(liveToast);
            myToast.show();
  
            // Auto-hide the toast after 3 seconds
            setTimeout(() => {
                myToast.hide();
            }, 3000);
        } catch (error) {
            console.error("Bootstrap Toast initialization failed:", error);
  
            // Fallback to manual hide
            setTimeout(() => {
                liveToast.style.display = "none";
            }, 3000);
        }
    }
  
    // Send data to the server
    function sendDataToServer(formData, saveButton) {
        var phpScript = "addStudent.php";
        const originalText = saveButton.querySelector('span').textContent;
        const iconClass = saveButton.querySelector('i').classList[1];
        console.log("Sending data to server...");
        showLoading(saveButton);
  
        const formDataObject = {};
        formData.forEach((value, key) => {
            formDataObject[key] = value;
        });
  
        console.log("Form data:", formDataObject);
  
        fetch(phpScript, {
            method: 'POST',
            body: formData,
        })
            .then(response => {
                if (!response.ok) {
                    hideLoading(saveButton, originalText, 'bxs-check');
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                hideLoading(saveButton, originalText, 'bxs-check');
                console.log("Response data:", data);
                if (data.indexOf("success") !== -1) {
                    showToast("تم التسجيل انتقل الى صفحة الطالب", true);
                    cleanForm();
                    $("#addTeacherModal").modal("hide");
                    $("#personalInformationModal").modal("hide");
              
                    window.location.href = 'student_panel/index.php';
                } else {
                    showToast(data, false);
                }
             
            })
            .catch(error => {
                hideLoading(saveButton, originalText, 'bxs-check');
                console.error("Fetch error:", error);
                showToast("حدث خطأ أثناء الإرسال، يرجى المحاولة مرة أخرى", false);
            });
    }
  
    // Clean form data
    function cleanForm() {
        // Get the forms
        const personalInfoForm = document.getElementById('personal-info-form');
        const addressInfoForm = document.getElementById('address-info-form');
  
        // Clear form data and reset validation state for each form
        [personalInfoForm, addressInfoForm].forEach(form => {
            if (form) {
                Array.from(form.elements).forEach(element => {
                    if (element.type !== 'button') {
                        element.value = '';
                        element.classList.remove('is-valid', 'is-invalid');
                    }
                });
                form.classList.remove('was-validated');
            }
        });
        console.log("Forms cleaned.");
    }
  
    // Handle "Next" button click for personal info modal
    const nextBtn = document.getElementById('next-btn');
    if (nextBtn) {
        nextBtn.addEventListener('click', function (event) {
            event.preventDefault();
            const addTeacherModal = document.getElementById('addTeacherModal');
            const personalInformationModal = document.getElementById('personalInformationModal');
            console.log("Next button clicked.");
            if (validateForm('personal-info-form')) {
                const modal1 = bootstrap.Modal.getInstance(addTeacherModal);
                modal1.hide();
                const modal2 = new bootstrap.Modal(personalInformationModal);
                modal2.show();
                console.log("Navigating to personal information modal.");
            }
        });
    }
  
    // Handle "Save" button click for personal address modal
    const personalInfoBtn = document.getElementById('personal-info-btn');
    if (personalInfoBtn) {
        personalInfoBtn.addEventListener('click', function (event) {
            event.preventDefault();
            const phoneNumberInput = document.getElementById('whatsapp_number');
            const phoneNumber = phoneNumberInput.value;
            const phoneError = document.getElementById('phone-error');
            console.log("Save button clicked.");
            if (validateForm('address-info-form')) {
                if (!validatePhoneNumber(phoneNumber)) {
                    phoneNumberInput.classList.add('is-invalid');
                    if (phoneError)
                        phoneError.style.display = 'block';
                } else {
                    phoneNumberInput.classList.remove('is-invalid');
                    if (phoneError)
                        phoneError.style.display = 'none';
  
                    const form = document.getElementById('address-info-form');
                    const formData = new FormData(form);
                    const personalInfoForm = document.getElementById('personal-info-form');
                    const personalFormData = new FormData(personalInfoForm);
                    for (const pair of personalFormData.entries()) {
                        formData.append(pair[0], pair[1]);
                    }
                    sendDataToServer(formData, personalInfoBtn);
                }
            }
        });
    }
  
    // Handle "Back" button click for personal info modal
    const backBtn = document.getElementById('back-btn');
    if (backBtn) {
        backBtn.addEventListener('click', function (event) {
            event.preventDefault();
            const addTeacherModal = document.getElementById('addTeacherModal');
            const personalInformationModal = document.getElementById('personalInformationModal');
            console.log("Back button clicked.");
            // Close the current modal and show the previous one
            const modal2 = bootstrap.Modal.getInstance(personalInformationModal);
            modal2.hide();
            const modal1 = new bootstrap.Modal(addTeacherModal);
            modal1.show();
            console.log("Navigating back to the previous modal.");
        });
    }
  
  });
  