const $$ = document.querySelectorAll.bind(document);
const $ = document.querySelector.bind(document);

function showNavbarClick() {
  const jsIconAdds = $$(".js-navbar-add");
  const jsIconRemoves = $$(".js-navbar-remove");
  const jsNavbarLink = $$(".js-navbar-wrap");
  const jsNavbarItems = $$(".js-navbar-item");

  jsNavbarItems.forEach((c, index) => {
    c.onclick = (e) => {
      const navbarActive = $(".js-navbar-item.active");
      if (navbarActive) {
        c.classList.remove("active");
        jsIconAdds[index].classList.add("active");
        jsIconRemoves[index].classList.remove("active");
        jsNavbarLink[index].classList.remove("active");
      } else {
        c.classList.add("active");
        jsIconAdds[index].classList.remove("active");
        jsIconRemoves[index].classList.add("active");
        jsNavbarLink[index].classList.add("active");
      }
    };
  });
}

function start() {
  showNavbarClick();
}

start();
