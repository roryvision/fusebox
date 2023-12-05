import { displayProject } from '../helpers/CardHelper.js';
let createdProjects = [];
let savedProjects = [];
let appliedProjects = [];

$(document).ready(async () => {
  createdProjects = await fetch('../api/projects/create.php')
    .then((res) => {
      if (!res.ok) {
        throw new Error('Error fetching created');
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

  appliedProjects = await fetch('../api/projects/apply.php')
    .then((res) => {
      if (!res.ok) {
        throw new Error('Error fetching applied');
      }

      return res.json();
    })
    .catch((error) => {
      console.error(error);
    });
  
  createdProjects.forEach((p) => displayProject(p, 'default', null));

  $('#select-menu li').click(async function () {
    $('#select-menu li').removeClass('selected');
    $(this).addClass('selected');

    $('#cards-container').empty();

    switch ($(this).attr('value')) {
      case 'created':
        createdProjects.forEach((p) => displayProject(p, 'default', null));
        break;
      case 'saved':
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
        savedProjects.forEach((p) => displayProject(p, 'save', true));
        break;
      case 'applied':
        appliedProjects.forEach((p) => displayProject(p, 'edit', null));
        break;
    }
  });


});