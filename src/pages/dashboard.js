import { displayProject, displayPerson } from '../helpers/CardHelper.js';
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

  projects.forEach((p) => {
    if (savedProjects.some((s) => s.project_id === p.project_id)) {
      displayProject(p, 'save', true);
    } else {
      displayProject(p, 'save', false);
    }
  });

  numResults = projects.length;
  $('#numResults').text(numResults);

  $('#select-menu li').click(function () {
    $('#select-menu li').removeClass('selected');
    $(this).addClass('selected');

    $('#cards-container').empty();

    if ($(this).attr('value') == 'projects') {
      displayAllProjects();
    } else if ($(this).attr('value') == 'people') {
      people.forEach((p) => displayPerson(p));
    }
  });
});

// Update Display
function updateTypesArrayOutput() {
  let outputDiv = document.getElementById('appliedTypeFilters');
  let outputText = typesArray.map((item) => item.label).join(', ');
  outputDiv.innerHTML = `<strong>Types:</strong> ${outputText}`;
}
function updateRolesArrayOutput() {
  let outputDiv = document.getElementById('appliedRoleFilters');
  let outputText = rolesArray.map((item) => item.label).join(', ');
  outputDiv.innerHTML = `<strong>Roles:</strong> ${outputText}`;
}

function check(thisCheckbox, dataArray, updateFunction) {
  // when checked/unchecked, adds or removes it from list of applied filters
  let label = thisCheckbox.nextElementSibling.textContent.trim();
  let value = thisCheckbox.value;
  let existingIndex = dataArray.findIndex((item) => item.value === value);
  if (thisCheckbox.checked == true) {
    if (existingIndex === -1) {
      dataArray.push({ label, value });
    }
  } else {
    let index = dataArray.findIndex((item) => item.value === value);
    if (existingIndex !== -1) {
      dataArray.splice(existingIndex, 1);
    }
    $(thisCheckbox).parent().parent().parent().children('input').prop('checked', false);
  }
  updateFunction();
}

function checkAll(thisCheckbox) {
  let checkboxesInList = thisCheckbox.parentElement.querySelectorAll(
    "input[type='checkbox']"
  );
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
        displayProject(p, 'save', true);
      } else {
        displayProject(p, 'save', false);
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

async function displayAllProjects() {
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

  $('#cards-container').empty();
  projects.forEach((p) => {
    if (savedProjects.some((s) => s.project_id === p.project_id)) {
      displayProject(p, 'save', true);
    } else {
      displayProject(p, 'save', false);
    }
  });
}