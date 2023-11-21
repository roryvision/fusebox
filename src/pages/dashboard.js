let typesArray = [];
let rolesArray = [];

//i started adding stuff here

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

function filterProjects() {
    // Assuming projects is an array of your project data
    let filteredProjects = projects.filter(project => {
        // Check if project matches selected types
        let typesMatch = typesArray.length === 0 || typesArray.some(type => project.types.includes(type.value));

        // Check if project matches selected roles
        let rolesMatch = rolesArray.length === 0 || rolesArray.some(role => project.roles.includes(role.value));

        return typesMatch && rolesMatch;
    });

    // Call a function to update the displayed projects
    updateProjectCards(filteredProjects);
}

function updateProjectCards(filteredProjects) {
    // Assuming projectsDiv is the container for your project cards
    let projectsDiv = document.getElementById('projectCards');

    // Clear the existing content
    projectsDiv.innerHTML = '';

    // Add the filtered projects to the container
    filteredProjects.forEach(project => {
        // Create and append project card elements to projectsDiv
        // You need to implement this part based on your project card structure
        // Example:
        let projectCard = document.createElement('div');
        projectCard.textContent = project.name; // Assuming your project has a 'name' property
        projectsDiv.appendChild(projectCard);
    });
}

//and finished adding stuff here




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

// Add this line at the end of your 'check' and 'checkAll' functions to trigger the filtering
// i also added this
updateProjectCards();

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
