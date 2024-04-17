const dropdownBtns: NodeList = document.querySelectorAll('.dropdown-btn');
const dropdownMenus: NodeList = document.querySelectorAll('.dropdown-menu');

// Open dropdown menu on click.
dropdownBtns.forEach(btn => {
    btn.addEventListener('click', e => {
        const menu = document.querySelector(`.dropdown-menu[data-dropdown-menu=${(btn as Element).getAttribute('data-dropdown-menu')}]`);

        menu?.classList.toggle('hide');
    });
});

// Click outside of menu? Hide it.
document.addEventListener('click', e => {
    dropdownMenus.forEach(menu => {
        if (!menu.contains(e.target as Node)) {
            if ((e.target as Element).classList.contains('dropdown-btn')) return;

            (menu as Element).classList.add('hide');
        }
    });
});