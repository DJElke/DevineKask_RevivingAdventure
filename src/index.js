require('./style.css');
{
console.log('ja dat werkt hier dus wel hé');


var currentTab = 0;

const init = () => {
  initLoadFile();
  initTabButtons();
  showTab(currentTab);
};

//// SECTION SELECT PICTURE
const loadFile = e => {
  var image = document.querySelectorAll(".output");
  image[currentTab-1].src = URL.createObjectURL(e.target.files[0]);
}

const initLoadFile = () => {
  document.querySelectorAll(".characterCardForm__img").forEach($img => {$img.addEventListener('change', loadFile)});
}

////SECTION TABS
const showTab = n =>{
  //Display the right tab
  var x = document.querySelectorAll(".tab");
  x[n].style.display = "block";

  //Handle buttons:
  if (n == 1) {
    document.querySelector(".prevBtn").style.display = "none";
  } else {
    document.querySelector(".prevBtn").style.display = "inline";
  }
}

//initionalise the buttons used to navigate between the tabs
const initTabButtons = () => {
  document.querySelectorAll(".nextBtn").forEach($nbtn => {$nbtn.addEventListener('click', next)});
  document.querySelectorAll(".prevBtn").forEach($pbtn => {$pbtn.addEventListener('click', prev)});
}

//Show the next tab
const next = () => {
  var x = document.querySelectorAll(".tab");

  // Hide the current tab:
  x[currentTab].style.display = "none";

  currentTab = currentTab + 1;

  // Display the correct tab
  showTab(currentTab);
}

//Show previous tab
const prev = () => {
  var x = document.querySelectorAll(".tab");

  // Hide the current tab:
  x[currentTab].style.display = "none";

  currentTab = currentTab -1;
  
  // Display the correct tab
  showTab(currentTab);
}

init();

}