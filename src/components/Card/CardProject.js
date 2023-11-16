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
    <div class='tags'>
      <div class='tag w-fit'>Business</div>
      <div class='tag w-fit'>Visual</div>
      <div class='tag w-fit'>Tech</div>
      <div class='tag w-fit'>Film</div>
    </div>
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
    }
  }
}

customElements.define('card-project', CardProject);