const cardPersonTemplate = document.createElement('template');

cardPersonTemplate.innerHTML = `
  <link rel='stylesheet' href='../styles/global.css'>
  <link rel='stylesheet' href='../components/Card/card.css'>  
    <div class='card card-person flex-btwn'>
    <div style='width: 172px; flex-direction: column; align-items: center; height: 250px;'>
      <div class='img-container'>
        <img src='../assets/images/chuubear.jpeg' alt='Profile photo'>
      </div>
      
      <div class='role' style='color: black; text-align: center; background-color: #93D695; width: 125px; font-size: 10pt; line-height: 15px; border-radius: 20px; padding: 5px 4px; margin: auto;'>
        Role
       </div>
       
    </div>
    <div style='margin-left: 16px; height: 250px; '>
      <div style= 'height: 215px; width: 225px'>
        <h1 class='name'></h1>
        <hr />
        <p class='pronouns' style='color: #878787; font-style: italic; font-weight: 275; font-size: 13px;'></p>
        <p class='major' style='font-weight: 700; margin-top: 4px; margin-bottom: 6px; line-height: 18px;'></p>
        <p class='major2' style='font-weight: 700; margin-top: 4px; margin-bottom: 6px; line-height: 18px;'>Computer Science</p>
        <p class='website1'></p>
        <p class='website2'></p>
        
      </div>
      <div style= 'margin-left: 150px; margin-top: 4px; text-align: left; display: flex; flex-direction: row; gap: 8px;'>
        <div>
            <a href="https://www.instagram.com/"><img src='../assets/icons/instagram.png' alt='instagram' id="icon"/></a>
        </div>
        <div>
            <a href="https://www.linkedin.com/"><img src='../assets/icons/linkedin.png' alt='linkedin ' id="icon"/><a href="https://www.linkedin.com/">
        </div>
      </div>
      
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
      shadow.querySelector('.name').innerText = (p.fname && p.lname) ? p.fname + ' ' + p.lname : '';
      shadow.querySelector('.pronouns').innerText = p.pronouns || '';
      shadow.querySelector('.major').innerText = p.major || '';
      shadow.querySelector('.major2').innerText = p.major2 || '';
      shadow.querySelector('.role').innerText = p.role_name || '';

      // Set the link only if the value is not null
      shadow.querySelector('.website1').innerHTML = p.website1 ? '<a href="' + p.website1 + '" target="_blank">' + p.website1 + '</a>' : '';

      shadow.querySelector('.website2').innerHTML = p.website2 ? '<a href="' + p.website2 + '" target="_blank">' + p.website2 + '</a>' : '';
    }
  }

}

customElements.define('card-person', CardPerson);