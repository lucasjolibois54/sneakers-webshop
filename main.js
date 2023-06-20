const menuItems = document.querySelectorAll('.menu a');

menuItems.forEach(item => {
  item.addEventListener('click', event => {
    const subMenu = item.nextElementSibling;
    if (subMenu) {
      event.preventDefault();
      subMenu.classList.toggle('show');
    }
  });
});
