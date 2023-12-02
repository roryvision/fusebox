import { displayProject, displayPerson } from '../helpers/CardHelper.js';
let projects = [];
let typesArray = [];
let rolesArray = [];
let numResults = 0;
$(document).ready(async () => {
    projects = await fetch('../api/projects.php')
        .then(res => {
            if (!res.ok) {
                throw new Error('Error fetching projects');
            }

            return res.json();
        }).catch(error => {
            console.error(error);
        });

    if (projectSearch) {
        console.log("i'm here");
        projects = projects.filter(function (p){
            return p.project_name.includes(projectSearch) || p.category_name.includes(projectSearch);
        });
        $('#cards-container').empty();

        projects.forEach((p) => displayProject(p));
        numResults = projects.length;
    }
    else{
        projects.forEach((p) => displayProject(p));
        numResults = projects.length;
    }
    $('#numResults').text(numResults);

});
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
    if (thisCheckbox.checked == true){
        dataArray.push({ label, value });
    }
    else{
        let index = dataArray.findIndex(item => item.value === value);
        if (index !== -1) {
            dataArray.splice(index, 1);
        }
    }
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
    let noCheckboxSelected = true;
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (this.id === 'role-tech' || this.id === 'role-visual' || this.id === 'role-business' || this.id === 'role-film' || this.id === 'role-performing') {
                checkAll(this);
            } else if (this.id.startsWith('role-')) {
                check(this, rolesArray, updateRolesArrayOutput);

            } else if (this.id.startsWith('type-')) {
                check(this, typesArray, updateTypesArrayOutput);
            }
            performSearch();
        });

    });

});

function performSearch() {
    console.log("performsearch");

    if (rolesArray.length !== 0 || typesArray.length !== 0) {
        let filteredProjects = projects.filter(function (p) {
            // Check if at least one selected role is in p's roles
            const roleMatch = rolesArray.length === 0 || rolesArray.some(function (selectedRole) {
                return p.roles.includes(selectedRole.label);
            });

            // Check if at least one selected type is in p's category
            const typeMatch = typesArray.length === 0 || typesArray.some(function (selectedType) {
                return p.category_name.includes(selectedType.label);
            });
            return roleMatch && typeMatch;
        });

        $('#cards-container').empty();

        console.log(filteredProjects);
        filteredProjects.forEach(function (p) {
            displayProject(p);
        });

        numResults = filteredProjects.length;

        // If none match
        if (numResults === 0) {
            $('#cards-container').html('<p>No matching projects found.</p>');
        }

    } else {
        // If no filters, display all
        displayAllProjects();
        numResults = projects.length;
    }
    $('#numResults').text(numResults);
}

function displayAllProjects() {
    $('#cards-container').empty();
    projects.forEach(p => displayProject(p));
    console.log("displayall");
}

