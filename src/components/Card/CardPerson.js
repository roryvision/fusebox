const cardPersonTemplate = document.createElement('template');

cardPersonTemplate.innerHTML = `
  <link rel='stylesheet' href='/acad276/fusebox/src/styles/global.css'>
  <link rel='stylesheet' href='/acad276/fusebox/src/components/Card/card.css'>  
    <div class='card card-person flex-btwn'>
    <div style='width: 172px; flex-direction: column; align-items: center; height: 250px;'>
      <div class='img-container'>
        <img src='/acad276/fusebox/src/assets/images/chuubear.jpeg' alt='Profile photo'>
      </div>
      
      <div class='role' style='color: black; text-align: center; background-color: #93D695; width: 125px; font-size: 10pt; line-height: 15px; border-radius: 20px; padding: 7px 4px; margin: auto; margin-top: 0px;'>
        Role
       </div>
     
      <div class='skills'></div>
       
    </div>
    <div style='margin-left: 16px; height: 250px; '>
      <div style= 'height: 215px; width: 225px'>
        <h1 class='name'></h1>
        <hr />
        <p class='pronouns' style='color: #878787; font-style: italic; font-weight: 275; font-size: 13px;'></p>
        <p class='major' style='font-weight: 700; margin-top: 4px; margin-bottom: 6px; line-height: 18px;'></p>
        <p class='major2' style='font-weight: 700; margin-top: 4px; margin-bottom: 6px; line-height: 18px;'></p>
        <div style='margin-top: 10px'>
         <p class='website1' style="font-size:9pt; width: 225px; line-height: 15px; overflow-wrap: break-word;"></p>
         <p class='website2' style="font-size:9pt; width: 225px; margin-top: 5px; line-height: 15px; overflow-wrap: break-word;"></p>
        </div>    
      </div>
      <div style= 'margin-top: 4px; text-align: left; display: flex; flex-direction: row; justify-content:flex-end; gap: 6px;'>
        <div class="instagram">
        </div>
        <div class="linkedin">
            <a href="https://www.linkedin.com/"><img src='/acad276/fusebox/src/assets/icons/linkedin.png' alt='linkedin ' id="icon"/><a href="https://www.linkedin.com/">
        </div>
      </div>
      
    </div>
  </div>
`;

const roleColors = {
  'tech': { backgroundColor: '#1F479B', color: 'white' },
  'business': { backgroundColor: '#8D43A7', color: 'white' },
  'visual': { backgroundColor: '#F8625A', color: 'white' },
  'film': { backgroundColor: '#FFBF4A', color: 'black' },
  'performing': { backgroundColor: '#93D695', color: 'black' },
  'general': { backgroundColor: '#D9D9D9', color: 'black' },
};

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

      const profilePic = shadow.querySelector('.img-container img');
      if (p.profile_pic) {
        profilePic.src = p.profile_pic;
        profilePic.alt = 'Profile photo';
      }

      const roleElement = shadow.querySelector('.role');
      if (p.role_type) {
        const selectedColor = roleColors[p.role_type.toLowerCase()];

        if (selectedColor) {
          const roleElement = shadow.querySelector('.role');
          roleElement.style.backgroundColor = selectedColor.backgroundColor;
          roleElement.style.color = selectedColor.color;
        }
      }

      const tagsContainer = shadow.querySelector('.skills');
      tagsContainer.innerHTML = ''; // Clear existing content
      p.skills.forEach((skill) => {
        const tagElement = document.createElement('div');
        tagElement.className = 'skill w-fit';
        tagElement.innerText = skill;
        tagsContainer.appendChild(tagElement);
      });

      shadow.querySelector('.website1').innerHTML = p.website1 ? '<a href="' + p.website1 + '" target="_blank">' + p.website1 + '</a>' : '';
      shadow.querySelector('.website2').innerHTML = p.website2 ? '<a href="' + p.website2 + '" target="_blank">' + p.website2 + '</a>' : '';
      shadow.querySelector('.instagram').innerHTML = p.instagram ? '<a href="https://www.instagram.com/' + p.instagram + '" target="_blank"><img src=\'/acad276/fusebox/src/assets/icons/instagram.png\' alt=\'instagram\' id="icon"/></a>' : '';
      shadow.querySelector('.linkedin').innerHTML = p.linkedin ? '<a href="' + p.linkedin + '" target="_blank"><img src=\'/acad276/fusebox/src/assets/icons/linkedin.png\' alt=\'linkedin \' id="icon"/></a>' : '';
    }
  }
}

customElements.define('card-person', CardPerson);