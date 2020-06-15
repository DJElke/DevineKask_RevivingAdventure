require('./style.css');
require('konva');
{
let currentTab = 0;
//konva stage
let stageWidth = 1000;
let stageHeight = 1000;
//making the container
let stage = new Konva.Stage({
  container: 'cs',
  width: stageWidth,
  height: stageHeight,
});

const init = () => {
  // PHOTO EDITOR 
  //Make sure the konva stage and background image is scaled right.
  window.addEventListener('load', () => {
    fitStageIntoParentContainer();
  });
  //then load the container
  if (typeof window.orientation !== 'undefined') { 
    loadCanvasMobile();
  }else{
    loadCanvasDesktop();
  }
  //after that you want to "listen" if the window resizes or not
  window.addEventListener('resize', () => {
    fitStageIntoParentContainer();
  })
  
  initLoadFile();
  initTabButtons();
  showTab(currentTab);
};

//deze mag dan op het einde weg ofso
// const loadCanvasDesktop = () => {
//   let width = 540;
//   let height = 960;

//   //making the container
//   let stage = new Konva.Stage({
//       container: 'cs',
//       width: width,
//       height: height,
//   });
//   //making the background layer
//   let background = new Konva.Layer();
//   stage.add(background);
//   //making the sticker layer
//   let layer = new Konva.Layer();
//   stage.add(layer);
    
//   //getting the stickers
//   let itemURL = '';
//   let dragitems = document.getElementById('drag-items');
//   dragitems.addEventListener('dragstart', e => {
//     itemURL = e.target.src;
//   });

//   //add the background to the background layer and resize it so it fits
//   let bgImageURL = 'assets/img/bg.PNG';
//   Konva.Image.fromURL(bgImageURL, image => {
//     image.attrs.image.width = width;
//     image.attrs.image.height = height;
//     background.add(image);
//     background.draw();
//   });

//   //add sticker layer before background 
//   background.zIndex(0);
//   layer.zIndex(1);

//   let con = stage.container();
//   con.addEventListener('dragover', e => {
//     e.preventDefault();
//   });

//   con.addEventListener('drop', e => {
//     e.preventDefault();
//     stage.setPointersPositions(e);
//     Konva.Image.fromURL(itemURL, image => {
//       //image.attrs.image.width = 60;
//       //image.attrs.image.height = 50;
//       layer.add(image);
//       image.position(stage.getPointerPosition());
//       image.draggable(true);
//       layer.draw();
//       });
//   });
// };

const loadCanvasMobile = () => {
  //making the background layer
  let background = new Konva.Layer();
  stage.add(background);
  //making the sticker layer
  let layer = new Konva.Layer();
  stage.add(layer);

  //add the background to the background layer and resize it so it fits
  let bgImageURL = 'assets/img/bg.png';
  Konva.Image.fromURL(bgImageURL, image => {
    image.attrs.image.width = 1000;
    image.attrs.image.height = 1000;
    console.log(image);
    background.add(image);
    background.draw();
  });

  //getting the stickers from the stickerlane
  let itemURL = '';
  let dragitems = document.getElementById('drag-items');

  //When you click on a sticker, add it to the stickerlayer and make it possible to resize
  dragitems.addEventListener('click', e => {
    itemURL = e.target.src;
    let imgObj = new Image();
    imgObj.src = itemURL;
    let sticker = new Konva.Image({
        x: 500,
        y: 500,
        image: imgObj,
        draggable: true,
      });
    layer.add(sticker);
    let tr = new Konva.Transformer({
      nodes: [sticker],
      keepRatio: true,
      enabledAnchors: [
        'top-left',
        'top-right',
        'bottom-left',
        'bottom-right',
        ],
      });
    layer.add(tr);
    layer.draw();
  }); 
};

const fitStageIntoParentContainer = () => {
  let container = document.querySelector('.cs');
  //fit the stage into the parent
  let containerWidth = container.offsetWidth;
  //scale the stage
  let scale = containerWidth / stageWidth;
  stage.width(stageWidth * scale);
  stage.height(stageHeight * scale);
  stage.scale({x: scale, y: scale});
  stage.draw();
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