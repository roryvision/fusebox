const displayProject = (projectData, isSaved) => {
  const projectContainer = document.getElementById('cards-container');
  const project = document.createElement('card-project');
  const data = { ...projectData, isSaved };
  project.setProjectData(data);
  projectContainer.appendChild(project);
};

const displayEditProject = (projectData, isSaved) => {
  const projectContainer = document.getElementById('cards-container');
  const project = document.createElement('card-project');
  const data = { ...projectData, isSaved };
  project.setProjectData(data);
  projectContainer.appendChild(project);

  const cardElement = document.createElement('div');
  cardElement.className = 'project-card';

  const circle = document.createElement('div');
  circle.className = 'circle';

  // Add a click event listener to the circle element
  circle.addEventListener('click', () => {
    // Extract the project ID from projectData (replace 'project_id' with the actual property)
    const projectId = projectData.project_id;

    // Construct the URL for the edit project page
    const editProjectURL = `editproject.php?id=${projectId}`;

    // Navigate to the edit project page
    window.location.href = editProjectURL;
  });

  cardElement.appendChild(circle);
  projectContainer.appendChild(cardElement);
};


const displayPerson = (personData) => {
  const projectContainer = document.getElementById('cards-container');
  const person = document.createElement('card-person');
  person.setPersonData(personData);
  projectContainer.appendChild(person);
};

export { displayProject, displayPerson, displayEditProject };