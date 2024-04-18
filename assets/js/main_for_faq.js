'use strict';

const accordeonItems = document.querySelectorAll('.accordeon__item');

accordeonItems.forEach(item => {
    item.addEventListener('click', function () {
        const text = item.querySelector('.accordeon__text');
        item.classList.toggle('opened');

        if (item.classList.contains('opened')) {
            text.style.height = text.scrollHeight + 'px';
        } else {
            text.style.height = '';
        }
    });
});