const cardProjectTemplate = document.createElement('template');

cardProjectTemplate.innerHTML = `
  <link rel='stylesheet' href='/acad276/fusebox/src/styles/global.css'>
  <link rel='stylesheet' href='/acad276/fusebox/src/components/Card/card.css'>
  <div class='card card-project'>
    <p class='category'></p>
    <h2 class='cursor-pointer'></h2>
    <p class='logline'></p>
    <br />
    <div class='tags'></div>
  </div>
`;

class CardProject extends HTMLElement {
  constructor() {
    super();
    const shadow = this.attachShadow({ mode: 'open' });
    shadow.appendChild(cardProjectTemplate.content.cloneNode(true));
  }

  setProjectData(p) {
    const shadow = this.shadowRoot;

    if (shadow) {
      shadow.querySelector('.category').innerText = p.category_name;
      shadow.querySelector('h2').innerText = p.project_name;
      shadow.querySelector('.logline').innerText = p.logline;
      const tagsContainer = shadow.querySelector('.tags');
      tagsContainer.innerHTML = ''; // Clear existing content

      // Iterate over the roles and create div elements
      p.roles.forEach((role) => {
        const tagElement = document.createElement('div');
        tagElement.className = 'tag w-fit';
        tagElement.innerText = role['role_name'];
        let roleType = role['role_type'];
        const selectedColor = roleColors[roleType.toLowerCase()];

        if (selectedColor) {
          tagElement.style.backgroundColor = selectedColor.backgroundColor;
          tagElement.style.color = selectedColor.color;
        }
        tagsContainer.appendChild(tagElement);
      });

      switch (p.cardType) {
        case 'save':
          if (p.isSaved) {
            const savedOverlay = document.createElement('div');
            savedOverlay.alt = 'Unsave project';
            savedOverlay.className = 'saved';
            shadow.querySelector('.card-project').appendChild(savedOverlay);

            savedOverlay.addEventListener('click', () => this.handleUnsave(p.project_id));
          } else {
            const saveOverlay = document.createElement('img');
            saveOverlay.src = '../assets/icons/save_overlay.svg';
            saveOverlay.alt = 'Save project';
            saveOverlay.className = 'card-save';
            shadow.querySelector('.card-project').appendChild(saveOverlay);

            saveOverlay.addEventListener('click', () => this.handleSave(p.project_id));
          }
          break;
        
        case 'edit':
          break;

        default:
          break;
      }

      let cardProject = shadow.querySelector('.card-project');

      shadow.querySelector('h2').addEventListener('click', () => {
        window.location.href = `project/${encodeURIComponent(p.project_id)}`;
      });
      shadow.querySelector('h2').addEventListener('mouseover', () => {
        cardProject.style.backgroundColor = '#E0D9CC';
      });

      shadow.querySelector('h2').addEventListener('mouseout', () => {
        cardProject.style.backgroundColor = '#F0EBE2';
      });
    }
  }

  async handleSave(projectId) {
    try {
      const response = await fetch('../api/projects/save.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ project_id: projectId }),
      });

      if (response.ok) {
        const savedOverlay = document.createElement('div');
        savedOverlay.alt = 'Unsave project';
        savedOverlay.className = 'saved';
        this.shadowRoot
          .querySelector('.card-project')
          .appendChild(savedOverlay);

        this.shadowRoot
          .querySelector('.card-project')
          .removeChild(this.shadowRoot.querySelector('.card-save'));

        savedOverlay.addEventListener('click', () => this.handleUnsave(projectId));
      } else {
        console.error('Failed to save project');
      }
    } catch (error) {
      console.error(error);
    }
  }

  async handleUnsave(projectId) {
    try {
      const response = await fetch('../api/projects/save.php', {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ project_id: projectId }),
      });

      if (response.ok) {
        const saveOverlay = document.createElement('img');
        saveOverlay.src = '../assets/icons/save_overlay.svg';
        saveOverlay.alt = 'Save project';
        saveOverlay.className = 'card-save';
        this.shadowRoot.querySelector('.card-project').appendChild(saveOverlay);

        this.shadowRoot
          .querySelector('.card-project')
          .removeChild(this.shadowRoot.querySelector('.saved'));

        saveOverlay.addEventListener('click', () => this.handleSave(projectId));
      } else {
        console.error('Failed to unsave project');
      }
    } catch (error) {
      console.error(error);
    }
  }
}

customElements.define('card-project', CardProject);