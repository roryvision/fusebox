const cardProjectTemplate = document.createElement('template');

cardProjectTemplate.innerHTML = `
  <link rel='stylesheet' href='../styles/global.css'>
  <link rel='stylesheet' href='../components/Card/card.css'>
  <div class='card card-project'>
    <img src='../assets/icons/save_overlay.png' alt='Save project' class='card-save'>
    <p class='category'></p>
    <h2></h2>
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
      tagsContainer.innerHTML = ""; // Clear existing content

      // Iterate over the roles and create div elements
      p.roles.forEach(role => {
        const tagElement = document.createElement('div');
        tagElement.className = 'tag w-fit';
        tagElement.innerText = role;
        tagsContainer.appendChild(tagElement);
      });
    }
  }
}

customElements.define('card-project', CardProject);