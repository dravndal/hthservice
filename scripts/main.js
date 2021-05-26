/* main.js laget av Kevin André Torgrimsen Nordli. Sist endret 16.10.2020 av Kevin André Torgrimsen Nordli. */


// Deklarering av variabler for henting av elementer i DOM-treet
const navbarButton = document.querySelector(".navbar-button");
const navbarList = document.querySelector(".navbar-list");
const navbarMenuBackground = document.querySelector(".navbar-menu-background");
const navbarLinks = document.querySelectorAll(".navbar-link");

const notificationButton = document.querySelector(".notification-button");
const notificationList = document.querySelector(".notification-list");
const notificationWrapper = document.querySelector(".notification-wrapper");
const notificationContainer = document.querySelector(".notification-container");
const navbarRight = document.querySelector(".navbar-right");


const mq = window.matchMedia("(min-width: 1200px)");

// Registrering av event listeners på variablene
if (navbarButton && navbarList && navbarMenuBackground) { // Sørg for å kun legge til event listeners om variabelet ikke er undefined
  navbarButton.addEventListener("click", () => {
    if (notificationList.classList.contains("notification-list-open")) {
      notificationList.classList.remove("notification-list-open");
    }
    navbarList.classList.toggle("navbar-list-open");
    navbarMenuBackground.classList.toggle("background-open");
  });
  navbarMenuBackground.addEventListener("click", () => {
    navbarList.classList.remove("navbar-list-open");
    navbarMenuBackground.classList.toggle("background-open");
  })
}
