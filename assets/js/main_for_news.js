'use strict'

const newsItem = document.querySelectorAll('.news_allview_item');

newsItem.forEach(item =>{
    item.addEventListener('click', function() {
        const newsOpened = item.querySelector('.news_opened');
        newsOpened.classList.toggle('opened_news');
    })
})