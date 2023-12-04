import { displayPerson } from '../../../helpers/CardHelper.js';
let people = [];
let rolesArray = [];

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
  
  people.forEach((p) => displayPerson(p));
});

function updateRolesArrayOutput() {
  let outputDiv = document.getElementById('appliedRoleFilters');
  let outputText = rolesArray.map((item) => item.label).join(', ');
  outputDiv.innerHTML = `<strong>Roles:</strong> ${outputText}`;
}

function check(thisCheckbox, dataArray, updateFunction) {
  // when checked/unchecked, adds or removes it from list of applied filters
  let label = thisCheckbox.nextElementSibling.textContent.trim();
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
    });
  });
});