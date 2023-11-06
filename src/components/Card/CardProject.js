const cardTemplate = document.createElement('template');

cardTemplate.innerHTML = `
  <link rel='stylesheet' href='../styles/global.css'>
  <link rel='stylesheet' href='../components/Card/card.css'>
  <div class='card card-project'>
    <p class='category'>Tech</p>
    <h2>LPL: Rocket Innovation</h2>
    <p>We are developing this, this, and this. We are looking for this.</p>
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
    const shadow = this.attachShadow({ mode: 'closed' });
    shadow.appendChild(cardTemplate.content);
  }
}

customElements.define('card-project', CardProject);