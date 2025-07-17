function addSelection(selectElement, containerId) {
    const container = document.getElementById(containerId);
    const selectedValue = selectElement.value;

    if (selectedValue && !document.getElementById(containerId + '-' + selectedValue)) {
        const badge = document.createElement('span');
        badge.className = "badge bg-primary m-1";
        badge.id = containerId + '-' + selectedValue;
        badge.textContent = selectedValue + " ×";
        badge.style.cursor = "pointer";
        badge.onclick = function () { this.remove(); };
        container.appendChild(badge);
    }

    selectElement.selectedIndex = 0;
}


document.addEventListener("DOMContentLoaded", function () {
    const collapseButtons = document.querySelectorAll(".btn-link");

    collapseButtons.forEach(button => {
        button.addEventListener("click", function () {
            const icon = this.querySelector("i");
            if (icon) {
                icon.classList.toggle("bi-chevron-down");
                icon.classList.toggle("bi-chevron-right");
            }
        });
    });
});

function addSelection(selectElement, containerId) {
    const container = document.getElementById(containerId);
    const selectedValue = selectElement.value;

    if (selectedValue && !document.getElementById(containerId + '-' + selectedValue)) {
        const badge = document.createElement('span');
        badge.className = "badge bg-primary m-1";
        badge.id = containerId + '-' + selectedValue;
        badge.textContent = selectedValue + " ×";
        badge.style.cursor = "pointer";
        badge.onclick = function () { this.remove(); };
        container.appendChild(badge);
    }

    selectElement.selectedIndex = 0;
}

function addContactField() {
            let container = document.getElementById('additional-contacts');
            let select = document.createElement('select');
            select.className = "form-select mb-2";
            select.innerHTML = '<option value="">Select Contact Type</option>' +
                               '<option value="home">Home Phone</option>' +
                               '<option value="work">Work Phone</option>';
            select.onchange = function() {
                let type = this.value;
                if (type && !document.getElementById(type + '_phone')) {
                    let inputWrapper = document.createElement('div');
                    inputWrapper.className = "mb-2";
                    let input = document.createElement('input');
                    input.type = "text";
                    input.className = "form-control";
                    input.id = type + '_phone';
                    input.name = type + '_phone';
                    input.placeholder = type.charAt(0).toUpperCase() + type.slice(1) + " Phone";
                    inputWrapper.appendChild(input);
                    container.appendChild(inputWrapper);
                }
                this.remove();
            };
            container.appendChild(select);
}
//Add Service Proivider (3. PREVIOUS SERVICE PROVIDERS)
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("addSupport").addEventListener("click", function () {
        let supportSections = document.getElementById("supportSections");
        let newSection = document.createElement("div");
        newSection.classList.add("support-section", "mt-4");
        newSection.innerHTML = `
            <h5>TYPE OF SUPPORT</h5>
            <button type="button" class="btn btn-danger btn-sm mb-2 removeSupport">Remove</button>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Provider:</label>
                    <input type="text" class="form-control" name="provider[]">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contact Details:</label>
                    <input type="text" class="form-control" name="contact_details[]">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Length of Support Provider:</label>
                    <input type="text" class="form-control" name="length_support[]">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Reason for Leaving or Cease of Service:</label>
                    <input type="text" class="form-control" name="reason_leaving[]">
                </div>
            </div>
        `;
        supportSections.appendChild(newSection);
    });

    document.getElementById("supportSections").addEventListener("click", function (event) {
        if (event.target.classList.contains("removeSupport")) {
            event.target.closest(".support-section").remove();
        }
    });
});

//Service Selection (4. SERVICES REQUIRED FROM BHC)
document.getElementById("addServiceBtn").addEventListener("click", function () {
    let select = document.getElementById("serviceSelect");
    let selectedValue = select.value;

    if (!selectedValue) return; // Prevent adding empty selection

    let servicesContainer = document.getElementById("services-container");

    // Create a new service entry div
    let serviceDiv = document.createElement("div");
    serviceDiv.classList.add("service-entry", "d-flex", "align-items-center", "mt-3");

    // Service wrapper for proper spacing
    let serviceWrapper = document.createElement("div");
    serviceWrapper.classList.add("w-100");

    // Label for service
    let serviceLabel = document.createElement("label");
    serviceLabel.textContent = selectedValue;
    serviceLabel.classList.add("form-label", "fw-bold", "d-block");

    // Details input field
    let detailsInput = document.createElement("input");
    detailsInput.type = "text";
    detailsInput.placeholder = "Enter details";
    detailsInput.classList.add("form-control");

    // Remove button
    let removeBtn = document.createElement("button");
    removeBtn.classList.add("btn-remove");
    removeBtn.innerHTML = '−'; // Unicode minus sign

    // Remove entry on click
    removeBtn.addEventListener("click", function () {
        servicesContainer.removeChild(serviceDiv);

        // Add back the removed service to dropdown
        let option = document.createElement("option");
        option.value = selectedValue;
        option.textContent = selectedValue;
        select.appendChild(option);
    });

    // Append elements
    serviceWrapper.appendChild(serviceLabel);
    serviceWrapper.appendChild(detailsInput);
    serviceDiv.appendChild(serviceWrapper);
    serviceDiv.appendChild(removeBtn);
    servicesContainer.appendChild(serviceDiv);

    // Remove selected option from dropdown
    select.remove(select.selectedIndex);
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".other-checkbox").forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            let inputField = this.closest(".form-check").querySelector(".other-input");
            if (this.checked) {
                inputField.style.display = "block";
            } else {
                inputField.style.display = "none";
                inputField.value = ""; // Clear input when unchecked
            }
        });
    });
});

//Add Goal
let goalCount = 1;

    function addGoal() {
        if (goalCount < 5) {
            goalCount++;
            const container = document.getElementById('goalsContainer');
            const newGoal = document.createElement('div');
            newGoal.classList.add('goal-entry', 'mb-3');
            newGoal.id = `goal-${goalCount}`;
            newGoal.innerHTML = `
                <label class="form-label fw-bold">Goal ${goalCount}</label>
                <input type="text" class="form-control mb-2" placeholder="Enter Goal">
                <label class="form-label fw-bold">Barriers & Solutions</label>
                <textarea class="form-control mb-2" rows="3" placeholder="Enter Barriers & Solutions"></textarea>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeGoal(${goalCount})">Remove</button>
            `;
            container.appendChild(newGoal);
        }
    }

    function removeGoal(goalId) {
        const goalElement = document.getElementById(`goal-${goalId}`);
        if (goalElement) {
            goalElement.remove();
            goalCount--;
        }
    }

    function toggleFurnitureDetails(show) {
        document.getElementById('furnitureDetails').style.display = show ? 'block' : 'none';
    }

    document.querySelectorAll('input[name="livingPreference"]').forEach((input) => {
        input.addEventListener('change', function() {
            document.getElementById('sharingPreferences').style.display = this.value === 'Share' ? 'block' : 'none';
        });
    });


    function copyToClipboard(id) {
        var copyText = document.getElementById(id);

        // Create a temporary input element
        var tempInput = document.createElement("input");
        document.body.appendChild(tempInput);
        tempInput.value = copyText.value;
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);

        // Provide user feedback
        alert("Copied: " + copyText.value);
    }


    //Form F 19

    function updateDate(id) {
        const dateField = document.getElementById(id + 'Date');
        if (document.getElementById(id).checked) {
            dateField.value = new Date().toLocaleDateString();
        } else {
            dateField.value = '';
        }
    }

    //FORM F18 SCHEDULE OF CARE
    document.getElementById('addCareEntry').addEventListener('click', function () {
        const container = document.getElementById('careScheduleContainer');
        const firstEntry = container.querySelector('.care-entry');
        const newEntry = firstEntry.cloneNode(true);

        // Clear all input values
        newEntry.querySelectorAll('input').forEach(input => input.value = '');

        // Show remove button
        const removeBtn = newEntry.querySelector('.remove-care-entry');
        removeBtn.classList.remove('d-none');
        removeBtn.addEventListener('click', function () {
            newEntry.remove();
        });

        container.appendChild(newEntry);
    });

    //FORM F18 NDIS GOALS
