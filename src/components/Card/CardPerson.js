const cardPersonTemplate = document.createElement('template');

cardPersonTemplate.innerHTML = `
  <link rel='stylesheet' href='../styles/global.css'>
  <link rel='stylesheet' href='../components/Card/card.css'>
  <div class='card card-person flex-btwn'>
    <div style='width: 172px;'>
      <div class='img-container'>
        <img src='../assets/images/chuubear.jpeg' alt='Profile photo'>
      </div>
      <p class='role' style='color: #878787; text-align: center;'>Role??</p>
    </div>
    <div style='margin-left: 16px;'>
      <h1 class='name'></h1>
      <hr />
      <p class='pronouns' style='color: #878787; margin-bottom: 4px;'></p>
      <p class='major'></p>
    </div>
  </div>
`;

class CardPerson extends HTMLElement {
  constructor() {
    super();
    const shadow = this.attachShadow({ mode: 'open' });
    shadow.appendChild(cardPersonTemplate.content.cloneNode(true));
  }

  setPersonData(p) {
    const shadow = this.shadowRoot;

    if (shadow) {
      shadow.querySelector('.name').innerText = p.fname + ' ' + p.lname;
      shadow.querySelector('.pronouns').innerText = p.pronouns;
      shadow.querySelector('.major').innerText = p.major;
    }
  }
}

customElements.define('card-person', CardPerson);