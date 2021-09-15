
// Deklarering av variabler for henting av elementer i DOM-treet
const navbarButton = document.querySelector(".navbar-button");
const navbarList = document.querySelector(".navbar-list");
const navbarMenuBackground = document.querySelector(".navbar-menu-background");
const navbarLinks = document.querySelectorAll(".navbar-link");
const navbarRight = document.querySelector(".navbar-right");

//form elements
const firstName = document.querySelector("#fornavn");
const lastName = document.querySelector("#etternavn");
const company = document.querySelector("#firma");
const address = document.querySelector("#adresse");
const post = document.querySelector("#postnr");
const city = document.querySelector("#by");
const phone = document.querySelector("#mobil");
const email = document.querySelector("#mailkunde");
const orderNumber = document.querySelector("#ordrenummer");
const apmtNumber = document.querySelector("leilnummer");
const customerId = document.querySelector("#kundenummer");
const selectShop = document.querySelector("#butikk");
const description = document.querySelector("#beskrivelse");
const registeredOn = document.querySelector("#annenkjop");

//montor only
const kundenavn = document.querySelector("#kundenavn");

// Registrering av event listeners på variablene
if (navbarButton && navbarList && navbarMenuBackground) { // Sørg for å kun legge til event listeners om variabelet ikke er undefined
  navbarButton.addEventListener("click", () => {
    navbarList.classList.toggle("navbar-list-open");
    navbarMenuBackground.classList.toggle("background-open");
  });
  navbarMenuBackground.addEventListener("click", () => {
    navbarList.classList.remove("navbar-list-open");
    navbarMenuBackground.classList.toggle("background-open");
  })
}

if(kundenavn){
  kundenavn.addEventListener("focusout", () => {
    if(kundenavn.value.match("^[a-zA-ZæøåÆØÅ  -]+$") && kundenavn.value != ""){
      firstName.style.border="2px solid #00FF00";
    } else if(kundenavn.value != ""){
      kundenavn.style.border="2px solid red";
    } else{
      kundenavn.style.border="none";
    }
  });
}

if(firstName){
  firstName.addEventListener("focusout", () => {
    if(firstName.value.match("^[a-zA-ZæøåÆØÅ  -]+$") && firstName.value != ""){
      firstName.style.border="2px solid #00FF00";
    } else if(firstName.value != "") {
      firstName.style.border="2px solid red";
    } else{
      firstName.style.border="none";
    }
  });

  firstName.addEventListener("input", () => {
    if(firstName.value == ""){
      firstName.style.border="none";
    }
  });
}

if(lastName){
  lastName.addEventListener("focusout", () => {
    if(lastName.value.match("^[a-zA-ZæøåÆØÅ  -]+$") && lastName.value != ""){
      lastName.style.border="2px solid #00FF00";
    } else if(lastName.value != "") {
      lastName.style.border="2px solid red";
    } else{
      lastName.style.border="none";
    }
  });

  lastName.addEventListener("input", () => {
    if(lastName.value == ""){
      lastName.style.border="none";
    }
  });
}

if(company){
  company.addEventListener("focusout", () => {
    if(company.value.match("^[a-zA-ZæøåÆØÅ]+$") && company.value != ""){
      company.style.border="2px solid #00FF00";
    } else if(company.value != "") {
      company.style.border="2px solid red";
    } else{
      company.style.border="none";
    }
  });

  company.addEventListener("input", () => {
    if(company.value == ""){
      company.style.border="none";
    }
  });
}

if(address){
  address.addEventListener("focusout", () => {
    if(address.value.match("[a-zA-ZæøåÆØÅ][0-9]{0,3}") && address.value != ""){
      address.style.border="2px solid #00FF00";
    } else if(address.value != "") {
      address.style.border="2px solid red";
    } else{
      address.style.border="none";
    }
  });

  address.addEventListener("input", () => {
    if(address.value == ""){
      address.style.border="none";
    }
  });
}

if(post){
  post.addEventListener("focusout", () => {
    if(post.value.match("[0-9]{4}") && post.value != ""){
      post.style.border="2px solid #00FF00";
    } else if(post.value != "") {
      post.style.border="2px solid red";
    } else{
      post.style.border="none";
    }
  });

  post.addEventListener("input", () => {
    if(post.value == ""){
      post.style.border="none";
    }
  });
}

if(city){
  city.addEventListener("focusout", () => {
    if(city.value.match("^[a-zA-ZæøåÆØÅ]+$") && city.value != ""){
      city.style.border="2px solid #00FF00";
    } else if(city.value != "") {
      city.style.border="2px solid red";
    } else{
      city.style.border="none";
    }
  });

  city.addEventListener("input", () => {
    if(city.value == ""){
      city.style.border="none";
    }
  });
}

if(phone){
  phone.addEventListener("focusout", () => {
    if(phone.value.match("^[0-9]+$") && phone.value != ""){
      phone.style.border="2px solid #00FF00";
      document.getElementById("mobil-label").style.color = "#333";
      document.getElementById("mobil-label").innerHTML = "Mobil:*";
    } else if(phone.value != "") {
      phone.style.border="2px solid red";
      document.getElementById("mobil-label").style.color = "red";
      document.getElementById("mobil-label").innerHTML += " ingen mellomrom i telefonnummeret";
    } else{
      phone.style.border="none";
    }
  });

  phone.addEventListener("input", () => {
    if(phone.value == ""){
      phone.style.border="none";
    }
  });
}

if(email){
  email.addEventListener("focusout", () => {
    if(email.value.indexOf("@") > 0 && email.value != ""){
      email.style.border="2px solid #00FF00";
      document.getElementById("epost-label").style.color = "#333";
      document.getElementById("epost-label").innerHTML = " E-post:*";
    } else if(email.value != "") {
      email.style.border="2px solid red";
      document.getElementById("epost-label").style.color = "red";
      document.getElementById("epost-label").innerHTML += "Skriv gyldig E-post";
    } else{
      email.style.border="none";
    }
  });

  email.addEventListener("input", () => {
    if(email.value == ""){
      email.style.border="none";
    }
  });
}

if(orderNumber){
  orderNumber.addEventListener("focusout", () => {
    if(orderNumber.value.match("^[0-9]+$") && orderNumber.value != ""){
      orderNumber.style.border="2px solid #00FF00";
      document.getElementById("ordrenummer-label").style.color = "#333";
      document.getElementById("ordrenummer-label").innerHTML = " Ordrenummer:";
    } else if(orderNumber.value != "") {
      orderNumber.style.border="2px solid red";
      document.getElementById("ordrenummer-label").style.color = "red";
      document.getElementById("ordrenummer-label").innerHTML += " Ordrenummer består av kun siffer";
    } else{
      orderNumber.style.border="none";
    }
  });

  orderNumber.addEventListener("input", () => {
    if(orderNumber.value == ""){
      orderNumber.style.border="none";
    }
  });
}

if(customerId){
  customerId.addEventListener("focusout", () => {
    if(customerId.value.match("^[0-9]+$") && customerId.value != ""){
      customerId.style.border="2px solid #00FF00";
      document.getElementById("ordrenummer-label").style.color = "#333";
      document.getElementById("ordrenummer-label").innerHTML = " Kundenummer:";
    } else if(customerId.value != "") {
      customerId.style.border="2px solid red";
      document.getElementById("ordrenummer-label").style.color = "red";
      document.getElementById("ordrenummer-label").innerHTML += " kundenummer består av kun siffer";
    } else{
      customerId.style.border="none";
    }
  });

  customerId.addEventListener("input", () => {
    if(customerId.value == ""){
      customerId.style.border="none";
    }
  });
}

if(apmtNumber){
  apmtNumber.addEventListener("focusout", () => {
    if(apmtNumber.value.match("^[0-9]$") && apmtNumber.value != ""){
      apmtNumber.style.border="2px solid #00FF00";
    } else if(apmtNumber.value != "") {
      apmtNumber.style.border="2px solid red";
    } else{
      apmtNumber.style.border="none";
    }
  });

  apmtNumber.addEventListener("input", () => {
    if(apmtNumber.value == ""){
      apmtNumber.style.border="none";
    }
  });
}

if(selectShop){
  selectShop.addEventListener("change", () => {
    if(selectShop.value != ""){
      selectShop.style.border="2px solid #00FF00";
    }
  });

  selectShop.addEventListener("input", () => {
    if(selectShop.value == ""){
      selectShop.style.border="none";
    }
  });
}

if(description){
  description.addEventListener("focusout", () => {
    if(description.value != ""){
      description.style.border="2px solid #00FF00";
    }
  });

  description.addEventListener("input", () => {
    if(description.value == ""){
      description.style.border="none";
    }
  });
}

if(registeredOn){
  registeredOn.addEventListener("focusout", () => {
    if(registeredOn.value.match("^[a-zA-ZæøåÆØÅ_ ]+$") && registeredOn.value != ""){
      registeredOn.style.border="2px solid #00FF00";
    } else if(registeredOn.value != "") {
      registeredOn.style.border="2px solid red";
    } else{
      registeredOn.style.border="none";
    }
  });

  registeredOn.addEventListener("input", () => {
    if(registeredOn.value == ""){
      registeredOn.style.border="none";
    }
  });
}
