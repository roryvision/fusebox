const headerTemplate = document.createElement('template');

headerTemplate.innerHTML = `
  <link rel='stylesheet' href='/acad276/fusebox/src/styles/global.css'>
  <link rel='stylesheet' href='/acad276/fusebox/src/components/Header/header.css'>
  <link rel='stylesheet' href='/acad276/fusebox/src/styles/global.css'>
  <link rel='stylesheet' href='/acad276/fusebox/src/components/Header/header.css'>
  <header id='header' class='w-100'>
    <ul class='flex-btwn'>
      <li><a href='/acad276/fusebox/src/pages/dashboard.php'><img src='/acad276/fusebox/src/assets/images/masthead.svg' alt='Fusebox masthead' class='cursor-pointer' id='header-logo' style='height: 30px;' /></a></li>
      <li id='search'>
        <img src='/acad276/fusebox/src/assets/icons/icon_search.svg' alt='Search' id='search-icon' />
        <img src='/acad276/fusebox/src/assets/icons/icon_search.svg' alt='Search' id='search-icon' />
        <form id="search-form" action="results.php"><input type='text' id='search-box' name='projectsearch' placeholder='Search' /></form>
      </li>
      <div class='flex-btwn'>
        <li><a href='/acad276/fusebox/src/pages/createProject.html'><button class='button-basic cursor-pointer' id='button-create'>Create a Project</button></a></li>
        <li><a href='/acad276/fusebox/src/pages/profile.php'><img src='/acad276/fusebox/src/assets/icons/icon_profile.svg' alt='Profile' class='button-nav cursor-pointer' /></a></li>
      </div>
    </ul>
  </header>
`;


class HeaderNav extends HTMLElement {
  constructor() {
    super();
    const shadow = this.attachShadow({ mode: 'closed' });
    shadow.appendChild(headerTemplate.content);

    const logo = shadow.getElementById('header-logo');
    const buttonCreate = shadow.getElementById('button-create');

    const handleWindowSize = () => {
      var viewportWidth = window.innerWidth || document.documentElement.clientWidth;

      if (viewportWidth <= 1200) {
        buttonCreate.innerText = '+';
        logo.src = '/acad276/fusebox/src/assets/images/logo.svg';
      } else {
        buttonCreate.innerText = 'Create a Project';
        logo.src = '/acad276/fusebox/src/assets/images/masthead.svg';
      }
    };

    handleWindowSize();

    window.addEventListener('resize', handleWindowSize);
  }
}

customElements.define('header-nav', HeaderNav);