const headerTemplate = document.createElement('template');

headerTemplate.innerHTML = `
  <link rel='stylesheet' href='../styles/global.css'>
  <link rel='stylesheet' href='../components/Header/header.css'>
  <header id='header' class='w-100'>
    <ul class='flex-btwn'>
      <li><a href='../pages/dashboard.php'><img src='../assets/images/masthead.png' alt='Fusebox masthead' class='cursor-pointer' style='height: 50px;' /></a></li>
      <div class='flex-btwn'>
        <li><button class='button-basic cursor-pointer'>Create a Post</button></li>
        <li><img src='../assets/icons/icon_inbox.svg' alt='Inbox' class='button-nav cursor-pointer' /></li>
        <li class='search'><img src='../assets/icons/icon_search.svg' alt='Search' class='button-nav cursor-pointer' />
            <form action="results.php"><input type = 'text' class='searchbox' name="projectsearch"></input></form></li>
        <li><img src='../assets/icons/icon_profile.svg' alt='Profile' class='button-nav cursor-pointer' /></li>
      </div>
    </ul>
  </header>
`;


class HeaderNav extends HTMLElement {
  constructor() {
    super();
    const shadow = this.attachShadow({ mode: 'closed' });
    shadow.appendChild(headerTemplate.content);

    const searchIcon = shadow.querySelector('.button-nav[alt="Search"]');
    const searchBox = shadow.querySelector('.searchbox');

    searchIcon.addEventListener('click', () => {
      console.log("hi");

      searchBox.classList.toggle('show-searchbox');
      if (searchBox.classList.contains('show-searchbox')) {
        searchBox.classList.remove('searchbox');
      } else {
        searchBox.classList.add('searchbox');
      }
    });
  }
}

customElements.define('header-nav', HeaderNav);