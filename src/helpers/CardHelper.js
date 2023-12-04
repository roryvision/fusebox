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
    // Replace 'project_id' with the actual property from projectData
    const projectId = projectData.project_id;

    // Assuming 'myModal' is the ID of your modal
    const modal = document.getElementById('myModal');

    // Set the display style to block
    modal.style.display = 'block';

    // Assuming 'closeModalBtn' is the ID of the close button (x) inside your modal
    const closeModalBtn = document.getElementById('closeModalBtn');

// Add a click event listener to the close button
    closeModalBtn.addEventListener('click', () => {
      // Assuming 'myModal' is the ID of your modal
      const modal = document.getElementById('myModal');

      // Set the display style to none to hide the modal
      modal.style.display = 'none';
    });

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

export { displayProject, displayPerson, displayEditProject };