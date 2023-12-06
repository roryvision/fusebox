const displayProject = (projectData, cardType, isSaved) => {
  const projectContainer = document.getElementById('cards-container');
  const project = document.createElement('card-project');
  const data = { ...projectData, cardType, isSaved };
  project.setProjectData(data);
  projectContainer.appendChild(project);
};
let projectId;
const displayEditProject = (projectData, cardType, isSaved) => {
  const projectContainer = document.getElementById('cards-container');
  const project = document.createElement('card-project');
  const data = { ...projectData, cardType, isSaved };
  project.setProjectData(data);
  projectContainer.appendChild(project);

  const cardElement = document.createElement('div');
  cardElement.className = 'project-card';

  const circle = document.createElement('div');
  circle.className = 'circle';

  circle.addEventListener('click', () => {
    projectId = projectData.project_id;

    window.location.href = `editproject.php?id=${projectId}`;
  });

// Append the circle element to your document or another container
// Replace 'container' with the ID or class of the container where you want to append the circle
  document.getElementById('container').appendChild(circle);

  cardElement.appendChild(circle);
  projectContainer.appendChild(cardElement);
};

const displayPerson = (personData) => {
  const projectContainer = document.getElementById('cards-container');
  const person = document.createElement('card-person');
  person.setPersonData(personData);
  projectContainer.appendChild(person);
};

const displayEditPerson = (personData, isSaved) => {
  const personContainer = document.getElementById('cards-container');
  const person = document.createElement('card-person');
  const data = { ...personData, isSaved };
  person.setPersonData(data);
  personContainer.appendChild(person);

  const cardElement = document.createElement('div');
  cardElement.className = 'person-card';

  const circle = document.createElement('div');
  circle.className = 'circle2';
  circle.innerHTML = '...';

  // Add a click event listener to the circle element
  circle.addEventListener('click', () => {
    // Replace 'person_id' with the actual property from personData
    const personId = personData.profile_id;

  });

  // Append the circle element to your document or another container
  // Replace 'container' with the ID or class of the container where you want to append the circle
  document.getElementById('container').appendChild(circle);

  cardElement.appendChild(circle);
  personContainer.appendChild(cardElement);
};

export { displayProject, displayPerson, displayEditProject, displayEditPerson };
