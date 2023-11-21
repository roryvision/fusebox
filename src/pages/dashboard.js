let typesArray = [];
let rolesArray = [];

// Update Display
function updateTypesArrayOutput() {
    let outputDiv = document.getElementById('appliedTypeFilters');
    let outputText = typesArray.map(item => item.label).join(', ');
    outputDiv.innerHTML = `<strong>Types:</strong> ${outputText}`;
}
function updateRolesArrayOutput() {
    let outputDiv = document.getElementById('appliedRoleFilters');
    let outputText = rolesArray.map(item => item.label).join(', ');
    outputDiv.innerHTML = `<strong>Roles:</strong> ${outputText}`;
}


function check(thisCheckbox, dataArray, updateFunction){ // when checked/unchecked, adds or removes it from list of applied filters
    let label = thisCheckbox.nextElementSibling.textContent.trim();
    let value = thisCheckbox.value;
    console.log(label);
    if (thisCheckbox.checked == true){
        dataArray.push({ label, value });
    }
    else{
        let index = dataArray.findIndex(item => item.value === value);
        if (index !== -1) {
            dataArray.splice(index, 1);
        }
    }
    console.log(dataArray);

    updateFunction();
}

function checkAll(thisCheckbox) {
    let checkboxesInList = thisCheckbox.parentElement.querySelectorAll("input[type='checkbox']");
    if (thisCheckbox.checked == true) {
        checkboxesInList.forEach(function (checkbox) {
            checkbox.checked = true;
            check(checkbox, rolesArray, updateRolesArrayOutput);

        });
    } else {
        checkboxesInList.forEach(function (checkbox) {
            checkbox.checked = false;
            check(checkbox, rolesArray, updateRolesArrayOutput);
        });
    }

    updateRolesArrayOutput();
}

document.addEventListener('DOMContentLoaded', function () { // event listener for all checkbox changes
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    console.log(checkboxes);
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (this.id === 'role-tech' || this.id === 'role-visual' || this.id === 'role-business' || this.id === 'role-film' || this.id === 'role-performing') {
                checkAll(this);
            } else if (this.id.startsWith('role-')) {
                check(this, rolesArray, updateRolesArrayOutput);

            } else if (this.id.startsWith('type-')) {
                check(this, typesArray, updateTypesArrayOutput);
            }
        });
    });
});
