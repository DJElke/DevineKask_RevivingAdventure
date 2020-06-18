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
let tr = '';
if (container != null){
  //making the container
  stage = new Konva.Stage({
    container: 'cs',
    width: stageWidth,
    height: stageHeight,
  });
}
//photoeditor page: getting the options buttons
let editOptions = document.querySelector('.optionsContainer');
let stickersButton = document.querySelector('.stickersButton');
let textButton = document.querySelector('.textButton');
//optionsContainer --> content
let addTextButton = document.querySelector('.textItem');
let dragItems = document.querySelector('.dragItems');
//menu
let menuContainer = document.querySelector('.menuContainer');
let quitButton = document.querySelector('.quitButton');
let saveButton = document.querySelector('.saveButton');

// let characterImg = document.querySelectorAll(".characterCardForm__img");
// let itemImg = document.querySelectorAll(".itemCardForm__img");



const init = () => {
  // PHOTO EDITOR SETUP 
  //Make sure the konva stage and background image is scaled right.
  //then load the background of the stage
  loadBackground();
  window.addEventListener('load', () => {
    if(container != null){
      fitStageIntoParentContainer();
    }
    if(stage != ''){
      //put the stickers button on "checked"
      stickersButton.classList.add('editOption--checked');
      addTextButton.classList.add('hide');
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
  //   PHOTO EDITOR SAVE THE STAGE
  // saveStage();

  initLoadCharacterFile();
  initLoadItemFile();
  initLoadAdventureFile();

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

const loadBackground = () => {
  //making the background layer
  let background ='';
  background = new Konva.Layer();
  if(stage != ''){
    stage.add(background);
  }
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

    //add transformer to konvaItem
    addTransformer(sticker, stickerLayer);

    stickerLayer.draw();
  }); 
};

const addTextToCanvas = () => {
  //making the text layer
  let textLayer = new Konva.Layer();
  stage.add(textLayer);

  //make the node
  let textNode = '';
  let tr = '';
  let textArea = '';


  addTextButton.addEventListener('click', () => {
    textNode = new Konva.Text({
      text: 'Double click to edit',
      x: 250,
      y: 500,
      fontSize: 50,
      fontStyle: 'bold',
      stroke: 'white',
      strokeWidth: 3,
      fill: '#424A9F',
      draggable: true,
    });
    textLayer.add(textNode);

    //add transformer to konvaItem
    addTransformer(textNode, textLayer);
    
    textLayer.draw();

    textNode.addEventListener('dbltap', () => {
      //hide the menu and change the buttons
      quitButton.classList.add('hide');
      saveButton.classList.add('hide');
      let editButton = document.createElement('div');
      editButton.innerHTML = "CHANGE";
      editButton.classList.add('secondaryButton');
      menuContainer.appendChild(editButton);
      //hide text node and transformer
      textNode.hide();
      tr = getTransformer();
      tr.hide();
      textLayer.draw();
      //create the textarea and style it
      addTextButton.classList.add('hide');
      textArea = document.createElement('textarea');
      editOptions.appendChild(textArea);
      //apply many styles to match text on canvas as close as possible
      textArea.value = textNode.text();
      textArea.style.position = 'absolute';
      textArea.style.width = '100%';
      textArea.style.height = 'auto';
      textArea.style.fontSize = '20px';
      textArea.style.border = 'none';
      textArea.style.padding = '0px';
      textArea.style.margin = '0px';
      textArea.style.overflowX = 'hidden';
      textArea.style.overflowY = 'auto';
      textArea.style.background = 'none';
      textArea.style.outline = 'none';
      textArea.style.resize = 'none';
      textArea.style.lineHeight = textNode.lineHeight();
      textArea.style.fontFamily = textNode.fontFamily();
      textArea.style.transformOrigin = 'left top';
      textArea.style.textAlign = textNode.align();

      rotation = textNode.rotation();
      let transform = '';
      if(rotation){
        transform += 'rotateZ(' + rotation + 'deg)';
      }
      //slightly move the textarea on firefox
      let px = 0;
      let isFireFox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
      if(isFireFox){
        px += 2 + Math.round(textNode.fontSize() / 20);
      }
      transform += 'translateY(-' + px + 'px)';
      textArea.style.transform = transform;

      //reset height
      textArea.style.height = 'auto';
      //after browsers resized it we can set the actual value
      textArea.style.height = textArea.scrollHeight + 3 + 'px';

      textArea.focus();

      const removeTextArea = () => {
        textArea.parentNode.removeChild(textArea);
        window.removeEventListener('click', handleOutsideClick);
        textNode.show();
        //tr.show();
        tr.forceUpdate();
        textLayer.draw();
      };

      editButton.addEventListener('click', () => {
        textNode.text(textArea.value);
        removeTextArea();
        addTransformer(textNode, textLayer);
        addTextButton.classList.remove('hide');
        quitButton.classList.remove('hide');
        saveButton.classList.remove('hide');
        menuContainer.removeChild(editButton);
      });

      const handleOutsideClick = (e) => {
        if (e.target !== textArea){
          textNode.text(textArea.value);
          removeTextArea();
          addTransformer(textNode, textLayer);
        }
      }
      setTimeout(() => {
        window.addEventListener('click', handleOutsideClick);
      });

    });
  });
};

const getTransformer = () => {
  return tr;
};

const addTransformer = (konvaItem, layer) => {
  tr = new Konva.Transformer({
    nodes: [konvaItem],
    keepRatio: true,
    borderDash: [4, 3],
    anchorCornerRadius: 5,
    anchorStrokeWidth: 15,
    borderStrokeWidth: 1,
    padding:16,
    opacity:1,
    enabledAnchors: ['top-left', 'bottom-right'],
    anchorFill: 'black',
    anchorStroke: 'black',
    borderStroke: 'black',
    rotationSnaps:[0, 90, 180, 270],
  });
  layer.add(tr);

  let deleteButton = new Konva.Circle({
    x: tr.getWidth(),
    y: 0,
    radius: 10,
    fill: 'black',
  });
  deleteButton.x(-15);
  deleteButton.y(-15);
  tr.add(deleteButton);
  
  let deleteIcon = new Konva.Path({
    data: '<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><title>box-configurator-delete</title><circle cx="8" cy="8" r="8" style="fill:#fff"/><path d="M10.24,1.08v.66a.39.39,0,0,1-.36.36H1.12a.39.39,0,0,1-.36-.36V1.08A.39.39,0,0,1,1.12.72H3.64L3.82.3A.52.52,0,0,1,4.24,0h2.4a.61.61,0,0,1,.48.3L7.3.72H9.82C10.06.78,10.24.9,10.24,1.08ZM1.42,2.82h8.1V9.91a1.05,1.05,0,0,1-1,1H2.44a1.05,1.05,0,0,1-1-1ZM3.1,9.19a.39.39,0,0,0,.36.36.39.39,0,0,0,.36-.36V4.44a.39.39,0,0,0-.36-.36.39.39,0,0,0-.36.36Zm2,0a.36.36,0,0,0,.72,0V4.44a.36.36,0,1,0-.72,0Zm2,0a.36.36,0,0,0,.72,0V4.44a.36.36,0,0,0-.72,0Z"/></svg>',
    fill: 'white',
  });
  deleteIcon.x(-22);
  deleteIcon.y(-22);
  tr.add(deleteIcon);
  
  tr.on('transform', () => {
    deleteButton.x(-15);
    deleteButton.y(-15);
    deleteIcon.x(-22);
    deleteIcon.y(-22);
  });

  deleteIcon.addEventListener('tap', () => {
    tr.destroy();
    konvaItem.destroy();
    layer.draw();
    tr.hide();
  });

  layer.draw();
};

// const saveStage = () => {
//   saveButton.addEventListener('click', () => {
//     let dataURL = stage.toDataURL({pixelRatio: 3});
//     console.log(dataURL);
//   });
// };

//// SECTION SELECT PICTURE
const loadFile = e => {
  var image = document.querySelectorAll(".output");
  image[currentTab-1].src = URL.createObjectURL(e.target.files[0]);
}

const initLoadCharacterFile = () => {
  document.querySelectorAll(".characterCardForm__img").forEach($img => {$img.addEventListener('change', loadFile)});
}

const initLoadItemFile = () => {
  document.querySelectorAll(".itemCardForm__img").forEach($img => {$img.addEventListener('change', loadFile)});
}

const initLoadAdventureFile = () => {
  document.querySelectorAll(".adventureCardForm__img").forEach($img => {$img.addEventListener('change', loadFile)});
}

////SECTION TABS
const showTab = n =>{
  //Display the right tab
  var x = document.querySelectorAll(".tab");
  if (x.length != 0){
    x[n].style.display = "block";
  
    //Handle buttons:
    if (n == 1) {
      document.querySelector(".prevBtn").style.display = "none";
    } else {
      document.querySelector(".prevBtn").style.display = "inline";
    }
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