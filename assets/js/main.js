"use strict";


const titles = document.querySelectorAll(".sidebar_title");
const contents = document.querySelectorAll(".sidebar_content");
const tim = document.querySelector(".tim");
const isup = document.querySelector(".isup");
const footerLinks = document.querySelectorAll(".footer_nav-link");
titles[0].classList.add("active");
contents[0].classList.add("active");

titles.forEach((title) => {
  title.addEventListener("click", () => {
    for (let elem of contents) {
      elem.classList.remove("active");
    }
    for (let title of titles) {
      title.classList.remove("active");
    }
    const content = document.querySelector("#" + title.dataset.tab);
    if (content != null) {
      content.classList.add("active");
    } else {
      contents[0].classList.add("active");
      title.classList.remove("active");
    }
    title.classList.add("active");
  });
});

const accTitles = document.querySelectorAll(".accordion__title");
const accContents = document.querySelectorAll(".accordion__content");

accTitles.forEach((item) =>
  item.addEventListener("click", () => {
    const activeContent = document.querySelector("#" + item.dataset.acc);

    if (activeContent.classList.contains("active")) {
      activeContent.classList.remove("active");
      item.classList.remove("active");
      activeContent.style.maxHeight = 0;
    } else {
      accContents.forEach((element) => {
        element.classList.remove("active");
        element.style.maxHeight = 0;
      });

      accTitles.forEach((element) => element.classList.remove("active"));

      item.classList.add("active");
      activeContent.classList.add("active");
      activeContent.style.maxHeight = activeContent.scrollHeight + "px";
    }
  })
);
const eventsAll = document.querySelector('.tim_wrapper-all'); 
const events = document.querySelector('.tim_wrapper'); 
const showEvent = document.querySelector('.tim_btn.btn');
const closeEvent = document.querySelector('.tim_wrapper-close');

showEvent.addEventListener('click', () => {
  events.classList.add('hidden');
  eventsAll.classList.add('opened');
});
closeEvent.addEventListener('click', () => {
  events.classList.remove('hidden');
  eventsAll.classList.remove('opened');

});

const burgerBtn = document.querySelector('.burger_btn');

if(burgerBtn){
  const burgerMenu = document.querySelector('.burger_body');

  burgerBtn.addEventListener('click', () => {
    document.body.classList.toggle('lock');
    burgerMenu.classList.toggle('active');
    burgerBtn.classList.atoggle('active');
  });
}

