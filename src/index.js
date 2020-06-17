require('./style.css');
require('konva');
{
// ----VARIABLES
let currentTab = 0;
//konva stage
let stageWidth = 1000;
let stageHeight = 1000;
//getting the canvas elements
let container = document.querySelector('.cs');
let stage ='';
let background ='';
if (container != null){
  //making the container
  stage = new Konva.Stage({
    container: 'cs',
    width: stageWidth,
    height: stageHeight,
  });
}
//photoeditor page: getting the options buttons
let stickersButton = document.querySelector('.stickersButton');
let textButton = document.querySelector('.textButton');
//optionsContainer --> content
let addTextButton = document.querySelector('.textItem');
let dragItems = document.querySelector('.dragItems');

// let characterImg = document.querySelectorAll(".characterCardForm__img");
// let itemImg = document.querySelectorAll(".itemCardForm__img");


const init = () => {
  // PHOTO EDITOR SETUP 
  //Make sure the konva stage and background image is scaled right.
  window.addEventListener('load', () => {
    if(container != null){
      fitStageIntoParentContainer();
    }
    if(stage != ''){
    //put the stickers button on "checked"
    stickersButton.classList.add('editOption--checked');
    addTextButton.classList.add('hide');
    //then load the container
    addBackground();
    }
  });
  //after that you want to "listen" if the window resizes or not
  window.addEventListener('resize', () => {
    if(container != null){
      fitStageIntoParentContainer();
    }
  });

  //PHOTO EDITOR OPTIONS
  if(stickersButton != null){
    optionsMenuClicked();
    //add eventlistener to the stickers so they can be added to the canvas
    addStickerToCanvas();
  }
  if(textButton != null){
  //add eventlistener to the text button so they can add text to the canvas
  addTextToCanvas();
  }

  initLoadCharacterFile();
  // initLoadItemFile();
  initTabButtons();
  showTab(currentTab);
};

const optionsMenuClicked = () => {
  //stickersbutton clicked
  stickersButton.addEventListener('click', () => {
    //show right edit options
    addTextButton.classList.add('hide');
    dragItems.classList.remove('hide');

    //change the edit options menu
    textButton.classList.remove('editOption--checked');
    stickersButton.classList.add('editOption--checked');
  });

  //textButton clicked
  textButton.addEventListener('click', () => {
    //show right edit options
    dragItems.classList.add('hide');
    addTextButton.classList.remove('hide');

    //change the edit options menu 
    stickersButton.classList.remove('editOption--checked');
    textButton.classList.add('editOption--checked');

  });
}

const addBackground = () => {
  //making the background layer
  background = new Konva.Layer();
  stage.add(background);

  //add the background to the background layer and resize it so it fits
  let bgImageURL = 'assets/img/bg.png';
  Konva.Image.fromURL(bgImageURL, image => {
    image.attrs.image.width = 1000;
    image.attrs.image.height = 1000;
    background.add(image);
    background.draw();
  });
};

//method to fit the stage into the size of the parent container (make it responsive)
const fitStageIntoParentContainer = () => {
  //fit the stage into the parent
  let containerWidth = container.offsetWidth;
  //scale the stage
  let scale = containerWidth / stageWidth;
  stage.width(stageWidth * scale);
  stage.height(stageHeight * scale);
  stage.scale({x: scale, y: scale});
  stage.draw();
};

const addStickerToCanvas = () => {
  //making the sticker layer
  let stickerLayer = new Konva.Layer();
  stage.add(stickerLayer);
  //When you click on a sticker, add it to the stickerlayer and make it possible to resize
  dragItems.addEventListener('click', e => {
    let itemURL = '';
    itemURL = e.target.src;
    let imgObj = new Image();
    imgObj.src = itemURL;
    let sticker = new Konva.Image({
      x: 500,
      y: 500,
      image: imgObj,
      draggable: true,
    });
    stickerLayer.add(sticker);
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
    stickerLayer.add(tr);
    stickerLayer.draw();
  }); 
};

const addTextToCanvas = () => {
  //making the text layer
  let textLayer = new Konva.Layer();
  stage.add(textLayer);
  addTextButton.addEventListener('click', () => {
    let textNode = new Konva.Text({
      text: 'Double click to edit',
      x: 500,
      y: 500,
      fontSize: 50,
      fontStyle: 'bold',
      stroke: 'white',
      strokeWidth: 3,
      fill: '#424A9F',
      draggable: true,
      width: 'auto',
    });
    textLayer.add(textNode);
    let tr = new Konva.Transformer({
      node: textNode,
      enabledAnchors: [
        'middle-left',
        'middle-right'
      ],
      //set minimum width of text
      boundBoxFunc: (oldBox, newBox) => {
        newBox.width = Math.max(30, newBox.width);
        return newBox;
      },
    });
    textNode.on('transform', () => {
      //reset scale, so only the width is changing by transformer
      textNode.setAttrs({
        width: textNode.width() * textNode.scaleX(),
        scaleX: 1,
      });
    });
    textLayer.add(tr);
    textLayer.draw();
  });
};


//// SECTION SELECT PICTURE
const loadFile = e => {
  var image = document.querySelectorAll(".output");
  image[currentTab-1].src = URL.createObjectURL(e.target.files[0]);
}

const initLoadCharacterFile = () => {
  document.querySelectorAll(".characterCardForm__img").forEach($img => {$img.addEventListener('change', loadFile)});
}

// const initLoadItemFile = () => {
//   document.querySelectorAll(".itemCardForm__img").forEach($img => {$img.addEventListener('change', loadFile)});
// }

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

init();

}