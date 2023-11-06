const cardTemplate = document.createElement('template');

cardTemplate.innerHTML = `
  <link rel='stylesheet' href='../styles/global.css'>
  <link rel='stylesheet' href='../components/Card/card.css'>
  <div class='card card-person flex-btwn'>
    <div style='width: 172px;'>
      <div class='img-container'>
        <img src='../../assets/images/chuubear.jpeg' alt='Profile photo'>
      </div>
      <p style='color: #878787; text-align: center;'>Joined Oct 1st, 2023</p>
    </div>
    <div style='margin-left: 16px;'>
      <h1>RORY AN</h1>
      <hr />
      <p style='color: #878787; margin-bottom: 4px;'>she/her</p>
      <p><strong>B.S. of Arts, Technology, and the Business of Innovation</strong></p>
    </div>
  </div>
`;

class CardPerson extends HTMLElement {
  constructor() {
    super();
    const shadow = this.attachShadow({ mode: 'closed' });
    shadow.appendChild(cardTemplate.content);
  }
}

customElements.define('card-person', CardPerson);