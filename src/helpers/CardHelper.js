const displayProjects = () => {
  $.ajax({
    url: '../api/projects.php',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
      const projectContainer = document.getElementById('cards-container');

      response.forEach(projectData => {
        const project = document.createElement('card-project');
        project.setProjectData(projectData);
        projectContainer.appendChild(project);
      });
    }
  })
}

const displayPeople = () => {
  $.ajax({
    url: '../api/people.php',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
      const projectContainer = document.getElementById('cards-container');

      response.forEach(personData => {
        const person = document.createElement('card-person');
        person.setPersonData(personData);
        projectContainer.appendChild(person);
      });
    },
    error: function(error) {
      console.error('Error fetching');
    }
  })
}

export { displayProjects, displayPeople };