import { displayPerson } from '../../../helpers/CardHelper.js';
let people = [];
let rolesArray = [];
let numResults = 0;

$(document).ready(async () => {
  people = await fetch('../../../api/people')
    .then((res) => {
      if (!res.ok) {
        throw new Error('Error fetching people');
      }

      return res.json();
    })
    .catch((error) => {
      console.error(error);
    });

  numResults = people.length;
  
  people.forEach((p) => displayPerson(p));
});

function updateRolesArrayOutput() {
  let outputDiv = document.getElementById('appliedRoleFilters');
  let outputText = rolesArray.map((item) => item.label).join(', ');
  outputDiv.innerHTML = `<strong>Roles:</strong> ${outputText}`;
}

function check(thisCheckbox, dataArray, updateFunction) {
  // when checked/unchecked, adds or removes it from list of applied filters
  let label = thisCheckbox.name;
  let value = thisCheckbox.value;
  if (thisCheckbox.checked == true) {
    dataArray.push({ label, value });
  } else {
    let index = dataArray.findIndex((item) => item.value === value);
    if (index !== -1) {
      dataArray.splice(index, 1);
    }
  }
  updateFunction();
}

document.addEventListener('DOMContentLoaded', function () {
  // event listener for all checkbox changes
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', function () {
      check(this, rolesArray, updateRolesArrayOutput);
      performSearch();
    });
  });
});

function performSearch() {
  if (rolesArray.length !== 0) {
    let filteredPeople = people.filter(function (p) {
      // Check if at least one selected role is in p's roles
      const roleMatch =
        rolesArray.length === 0 ||
        rolesArray.some(function (selectedRole) {
          return p.role_name === selectedRole.label;
        });

      return roleMatch;
    });

    $('#cards-container').empty();

    filteredPeople.forEach((p) => displayPerson(p));

    numResults = filteredPeople.length;

    // If none match
    if (numResults === 0) {
      $('#cards-container').html('<p>No matching applicants found.</p>');
    }
  } else {
    // If no filters, display all
    people.forEach((p) => displayPerson(p));
  }
}