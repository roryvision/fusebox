import {displayEditPerson, displayEditProject } from '../helpers/CardHelper.js';
let projects = [];
let people = [];
let savedProjects = [];
let typesArray = [];
let rolesArray = [];
let numResults = 0;

$(document).ready(async () => {
    projects = await fetch('../api/projects')
        .then((res) => {
            if (!res.ok) {
                throw new Error('Error fetching projects');
            }

            return res.json();
        })
        .catch((error) => {
            console.error(error);
        });

    people = await fetch('../api/people')
        .then((res) => {
            if (!res.ok) {
                throw new Error('Error fetching people');
            }

            return res.json();
        })
        .catch((error) => {
            console.error(error);
        });

    savedProjects = await fetch('../api/projects/save.php')
        .then((res) => {
            if (!res.ok) {
                throw new Error('Error fetching saved');
            }

            return res.json();
        })
        .catch((error) => {
            console.error(error);
        });

    displayAllProjects();


    numResults = projects.length;
    $('#numResults').text(numResults);

    $('#select-menu li').click(function () {
        $('#select-menu li').removeClass('selected');
        $(this).addClass('selected');

        $('#cards-container').empty();

        if ($(this).attr('value') == 'projects') {
            displayAllProjects();
        } else if ($(this).attr('value') == 'people') {
            people.forEach((p) => displayEditPerson(p));
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // event listener for all checkbox changes
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    let noCheckboxSelected = true;
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            if (
                this.id === 'role-tech' ||
                this.id === 'role-visual' ||
                this.id === 'role-business' ||
                this.id === 'role-film' ||
                this.id === 'role-performing'
            ) {
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
    if (rolesArray.length !== 0 || typesArray.length !== 0) {
        let filteredProjects = projects.filter(function (p) {
            // Check if at least one selected role is in p's roles
            const roleMatch =
                rolesArray.length === 0 ||
                rolesArray.some(function (selectedRole) {
                    return p.roles.includes(selectedRole.label);
                });

            // Check if at least one selected type is in p's category
            const typeMatch =
                typesArray.length === 0 ||
                typesArray.some(function (selectedType) {
                    return p.category_name.includes(selectedType.label);
                });
            return roleMatch && typeMatch;
        });

        $('#cards-container').empty();

        filteredProjects.forEach((p) => {
            if (savedProjects.some((s) => s.project_id === p.project_id)) {
                displayEditProject(p, true);
            } else {
                displayEditProject(p, false);
            }
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

const displayAllProjects = () => {
    projects.forEach((p) => {
        if (savedProjects.some((s) => s.project_id === p.project_id)) {
            displayEditProject(p, true);
        } else {
            displayEditProject(p, false);
        }
    });
}