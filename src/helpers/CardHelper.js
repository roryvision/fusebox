const displayProject = (projectData, isSaved) => {
  const projectContainer = document.getElementById('cards-container');
  const project = document.createElement('card-project');
  const data = { ...projectData, isSaved };
  project.setProjectData(data);
  projectContainer.appendChild(project);
};

const displayPerson = (personData) => {
  const projectContainer = document.getElementById('cards-container');
  const person = document.createElement('card-person');
  person.setPersonData(personData);
  projectContainer.appendChild(person);
};

export { displayProject, displayPerson };