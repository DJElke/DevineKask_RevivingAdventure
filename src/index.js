require('./style.css');
require('konva');
import { tns } from 'tiny-slider/src/tiny-slider.module.js';

// ----VARIABLES
let currentTab = 0;
let currentGuideTab = 1;
let currentRulesTab = 1;
let currentTutorialTab = 1;

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
let photoEditorGrid = document.querySelector('.photoEditor__grid');
let editOptions = document.querySelector('.optionsContainer');
let stickersButton = document.querySelector('.stickersButton');
let textButton = document.querySelector('.textButton');
let drawButton = document.querySelector('.drawButton');
//optionsContainer --> content
let addTextButton = document.querySelector('.textItem');
let dragItems = document.querySelector('.dragItems');
let drawItems = document.querySelector('.drawItems');
let brush = document.querySelector('.brush');
let eraser = document.querySelector('.eraser');
//menu
let menuContainer = document.querySelector('.menuContainer');
let quitButton = document.querySelector('.quitButton');
let saveButton = document.querySelector('.saveButton');
//edited image --> add title and description
let imgEditContainer = document.querySelector('.imgEditContainer');
let descriptionContainer = document.querySelector('.descriptionContainer');
let submitContainer = document.querySelector('.submitContainer');

let titleSlider;
let imgSlider;
let descriptionSlider;

let stationOneImage = document.querySelectorAll(".output");
let stationImage = document.querySelectorAll(".output--small");
const init = () => {
  startUpDashboard();
  // PHOTO EDITOR SETUP 
  //Make sure the konva stage and background image is scaled right.
  //then load the background of the stage
  window.addEventListener('load', () => {
    if(container != null){
      fitStageIntoParentContainer();
    }
    if(stage != ''){
      //put the stickers button on "checked"
      stickersButton.classList.add('editOption--checked');
      addTextButton.classList.add('hide');
      drawItems.classList.add('hide');
      brush.classList.add('hide');
      eraser.classList.add('hide');
    }
  });
  if(stage != ''){
    loadBackground();
  }
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
  if((brush != null) && (eraser != null)){
    //add eventlistener to the draw button so they can draw on the canvas
    //blokkeert de andere editor opties, dus daarom laten we deze weg
    //startDrawing();
  }
  //   PHOTO EDITOR SAVE THE STAGE
  if(stage != ''){
    saveStage();
  }

  if(document.querySelector(".characterCardForm__img") != null) {
    initLoadCharacterFile();
  }
  if(document.querySelector(".itemCardForm__img") != null) {
    initLoadItemFile();
  }
  if(document.querySelector(".itemCardForm__img") != null) {
    initLoadAdventureFile();
  }
  initTabButtons();
  showTab(currentTab);
  initCharacteristics();
  initReviewer();
  initOnboarding();
  initRegister();
  initCreateAdventure();
  initOnboarding();
  initOrder();
  initGuide();
  initRules();
  initProfile();
  initTutorial();
};
 
const startUpDashboard = () => {
  let owned = document.getElementById('owned');
  let involved = document.getElementById('involved');
  let ownedVac = document.querySelector('.ownedVac');
  let involvedVac = document.querySelector('.involvedVac');
  if((owned != null) && (involved != null) && (ownedVac != null) && (involvedVac != null)){
    involvedVac.classList.add('hide');
    owned.classList.add('dashboardTab--selected');
  
    owned.addEventListener('click', () => {
      involvedVac.classList.add('hide');
      involved.classList.remove('dashboardTab--selected');
      owned.classList.add('dashboardTab--selected');
      ownedVac.classList.remove('hide');
    });
  
    involved.addEventListener('click', () => {
      ownedVac.classList.add('hide');
      owned.classList.remove('dashboardTab--selected');
      involved.classList.add('dashboardTab--selected');
      involvedVac.classList.remove('hide');
    });
  }
};
 
const optionsMenuClicked = () => {
  //stickersbutton clicked
  stickersButton.addEventListener('click', () => {
    //show right edit options
    addTextButton.classList.add('hide');
    brush.classList.add('hide');
    eraser.classList.add('hide');
    drawItems.classList.add('hide');
    dragItems.classList.remove('hide');
 
    //change the edit options menu
    textButton.classList.remove('editOption--checked');
    drawButton.classList.remove('editOption--checked');
    stickersButton.classList.add('editOption--checked');
  });
 
  //textButton clicked
  textButton.addEventListener('click', () => {
    //show right edit options
    dragItems.classList.add('hide');
    brush.classList.add('hide');
    eraser.classList.add('hide');
    drawItems.classList.add('hide');
    addTextButton.classList.remove('hide');
 
    //change the edit options menu
    stickersButton.classList.remove('editOption--checked');
    drawButton.classList.remove('editOption--checked');
    textButton.classList.add('editOption--checked');
  });

    //drawButton clicked
    drawButton.addEventListener('click', () => {
      //show right edit options
      dragItems.classList.add('hide');
      addTextButton.classList.add('hide');
      drawItems.classList.remove('hide');
      brush.classList.remove('hide');
      eraser.classList.remove('hide');
  
      //change the edit options menu
      stickersButton.classList.remove('editOption--checked');
      textButton.classList.remove('editOption--checked');
      drawButton.classList.add('editOption--checked');
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
  let bgImageURL = document.querySelector('.editBgImg').src;
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
      drawItems.classList.add('drawItems--height');
      brush.classList.add('hide');
      eraser.classList.add('hide');
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
      let rotation = textNode.rotation();
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
        drawItems.classList.remove('drawItems--height');
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

const startDrawing = () => {
  let drawLayer = new Konva.Layer();
  stage.add(drawLayer);

  let drawCanvas = document.createElement('canvas');
  drawCanvas.width = stage.width();
  drawCanvas.height = stage.height();

  let drawImage = new Konva.Image({
    image: drawCanvas,
    x: 0,
    y: 0
  });
  drawLayer.add(drawImage);
  stage.draw();

  let drawContext = drawCanvas.getContext('2d');
  drawContext.strokeStyle = '#424A9F';
  drawContext.lineJoin = 'round';
  drawContext.lineWidth = 20;

  let isPaint = false;
  let lastPointerPosition;
  let mode = 'brush';

  if((brush != null) && (eraser != null)){
    stage.addEventListener('touchstart', () => {
      isPaint = true;
      lastPointerPosition = stage.getPointerPosition();
    });
    stage.addEventListener('touchend', () => {
      isPaint = false;
    });

    stage.addEventListener('touchmove', () => {
      if(!isPaint){
        return;
      }
      if(mode === 'brush'){
        drawContext.globalCompositeOperation = 'source-over';
      }
      if(mode === 'eraser'){
        drawContext.globalCompositeOperation = 'destination-out';
      }
      drawContext.beginPath();

      let localPos = {
        x: lastPointerPosition.x - drawImage.x(),
        y: lastPointerPosition.y - drawImage.y()
      }
      drawContext.moveTo(localPos.x, localPos.y);
      let pos = stage.getPointerPosition();
      localPos = {
        x: pos.x - drawImage.x(),
        y: pos.y - drawImage.y()
      }
      drawContext.lineTo(localPos.x, localPos.y);
      drawContext.closePath();
      drawContext.stroke();

      lastPointerPosition = pos;
      drawLayer.batchDraw();
    });
  
    brush.addEventListener('click', () => {
      mode = 'brush';
    });
    eraser.addEventListener('click', () => {
      mode = 'eraser';
    });
  }

};

const saveStage = () => {
  saveButton.addEventListener('click', () => {
    let transformers = stage.find('Transformer');
    transformers.forEach(transform => {
      transform.destroy();
    });
    stage.toImage({
      callback(img){
      img.name = "imgEdit";
      imgEditContainer.appendChild(img);
      let imgInput = document.createElement('input');
      imgInput.type = "hidden";
      imgInput.name = "image";
      imgInput.value = img.src;
      imgEditContainer.appendChild(imgInput);
    }
    });
    //hide all items so we can show a "new" form
    photoEditorGrid.classList.add('hide');
    photoEditorGrid.classList.add('photoEditorPart2__grid');
    photoEditorGrid.classList.remove('photoEditor__grid');
    imgEditContainer.classList.remove('hide');
    container.classList.add('hide');
    editOptions.classList.add('hide');
    stickersButton.classList.add('hide');
    textButton.classList.add('hide');
    drawButton.classList.add('hide');
    drawItems.classList.add('hide');
    drawItems.classList.add('drawItems--height');
    brush.classList.add('hide');
    eraser.classList.add('hide');
    let photoContainer = document.querySelector('.photoContainer');
    photoContainer.classList.add('hide');
    quitButton.classList.add('hide');
    saveButton.classList.add('hide');
    let titleContainer = document.querySelector('.titleContainer');
    titleContainer.classList.remove('hide');
    descriptionContainer.classList.remove('hide');
    submitContainer.classList.remove('hide');
    let editCardForm = document.querySelector('.editCardForm');
    editCardForm.classList.remove('hide');
    disableNext();
  }, false);
};

//disable next button when title or description isn't filled in 
const disableNext = () => {
  let nextButton = document.querySelector('.nextPic');
  let titleArea = document.querySelector('.titleArea');
  let descArea = document.querySelector('.descArea');
    if(titleArea != null){
      if(titleArea.value === ""){
        nextButton.disabled = true;
        nextButton.classList.add('hide');
      }
      titleArea.addEventListener('input', () => {
        nextButton.disabled = false;
        nextButton.classList.remove('hide');
        if((titleArea.value === "") || (descArea.value === "")){
          nextButton.disabled = true;
          nextButton.classList.add('hide');
        }
      });
    }
      if(descArea.value === ""){
        nextButton.disabled = true;
        nextButton.classList.add('hide');
      }
      descArea.addEventListener('input', () => {
        nextButton.disabled = false;
        nextButton.classList.remove('hide');
        if(titleArea != null){
          if((titleArea.value === "") || (descArea.value === "")){
            nextButton.disabled = true;
            nextButton.classList.add('hide');
          }
        }else{
          if(descArea.value === ""){
            nextButton.disabled = true;
            nextButton.classList.add('hide');
          }
        }
      });
   }
 
//// SECTION SELECT PICTURE
const loadFile = file => {
  let customUploads =  document.querySelectorAll('.custom-file-upload');
  let uploadFor = 'ptImage' + [currentTab -1].toString();
  customUploads.forEach($customUpload => {
    if($customUpload.htmlFor === uploadFor){
      $customUpload.style.display = 'none';
    }
  });
  if(stationImage != null){
    stationImage[currentTab-1].classList.remove('hide');
    stationImage[currentTab-1].src = URL.createObjectURL(file);
  }else{
    if(stationOneImage != null){
      stationOneImage[currentTab-1].classList.remove('hide');
      stationOneImage[currentTab-1].src = URL.createObjectURL(file);
    }
  }
}
 
const initLoadCharacterFile = () => {
    document.querySelectorAll(".create-character--close").forEach($close => {$close.addEventListener('click', overlayOn)});
    let overlay = document.querySelector(".overlay");
    if(overlay != null){
      overlay.addEventListener('click', overlayOff);
    }
    document.querySelectorAll(".characterCardForm__img").forEach($img => {$img.addEventListener('change', () => {
      loadFile(event.target.files[0]);
    })});
}
 
const initLoadItemFile = () => {
  document.querySelectorAll(".itemCardForm__img").forEach($img => {$img.addEventListener('change', () => {
    loadFile(event.target.files[0])
  })});
  document.querySelectorAll(".create-item--close").forEach($close => {$close.addEventListener('click', overlayOn)});
  document.querySelector(".overlay").addEventListener('click', overlayOff);
}
 
const initLoadAdventureFile = () => {
  document.querySelectorAll(".adventureCardForm__img").forEach($img => {$img.addEventListener('change', loadFile)});
  document.querySelectorAll(".create-adventure--close").forEach($close => {$close.addEventListener('click', overlayOn)});
  document.querySelector(".overlay").addEventListener('click', overlayOff);
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
 
//Show the next tab if no fields are empty; else, show error message
const next = () => {
  var x = document.querySelectorAll(".tab");
 
  if(currentTab > 0){
    var images = document.querySelectorAll(".output");
    var descriptions = document.querySelectorAll(".characteristic--description");
    var errorMessages = document.querySelectorAll(".error");
    if(errorMessages != null){
      errorMessages[currentTab].innerHTML = "";
    }

    if(images[currentTab-1].src != "" && (descriptions.length == 0 || descriptions [currentTab-1].innerHTML!= " " )){
      errorMessages[currentTab-1].innerHTML = "";
      x[currentTab].style.display = "none";
      currentTab = currentTab + 1;
      showTab(currentTab);
    } else {
      errorMessages[currentTab-1].innerHTML = "Please complete the card first"
    }
  }
  else {
  x[currentTab].style.display = "none";
  currentTab = currentTab + 1;
  showTab(currentTab);
  }
}
 
//Show previous tab
const prev = () => {
  var x = document.querySelectorAll(".tab");
  x[currentTab].style.display = "none";
  currentTab = currentTab -1;
  showTab(currentTab);
}

const initCharacteristics = () => {
  document.querySelectorAll(".characteristic--option").forEach($characteristic => {
    $characteristic.addEventListener('click', handleClickCharacteristic);
  })
}

const handleClickCharacteristic = i => {
  var characteristicDescription = document.querySelectorAll(".characteristic--description");
  characteristicDescription[currentTab-1].innerHTML = i.target.value;
}

const initReviewer = () => {
  if(document.querySelector('.my-titles') != null) {
    titleSlider =  tns({
        container: '.my-titles',
        items: 1, 
        slideBy: 'page',
        controls: false,
        center: true,
        navPosition: "bottom",
        edgePadding: 50,
        mouseDrag: true,
        preventScrollOnTouch: 'force'
      });
  }

  if(document.querySelector('.my-images') != null) {
      imgSlider = tns({
        container: '.my-images',
        items: 1,
        controls: false,
        center: true,
        navPosition: "bottom",
        edgePadding: 50,
        mouseDrag: true,
        preventScrollOnTouch: 'force'
      });
  }

  if(document.querySelector('.my-descriptions') != null) {
      descriptionSlider = tns({
        container: '.my-descriptions',
        items: 1,
        controls: false,
        center: true,
        navPosition: "bottom",
        edgePadding: 50,
        mouseDrag: true,
        preventScrollOnTouch: 'force'
      });
  }

  // if(document.querySelector('.previewButton') != null){
  //   document.querySelector('.previewButton').addEventListener('click', showPreview);
  // }

  // if(document.querySelector('.reviewButton') != null){
  //   document.querySelector('.reviewButton').addEventListener('click', showReview);
  // }
};

// const showPreview = () => {
//   document.querySelector('.card--preview').style.display = "block";
//   document.querySelector('.card--review').style.display = "none";
//   document.querySelector('.card--type').style.display = "none";

//   var info = titleSlider.getCurrentSlide();
//   // document.querySelector('.title--preview').innerHTML = info.index;
// }

// const showReview = () => {
//   document.querySelector('.card--preview').style.display = "none";
//   document.querySelector('.card--review').style.display = "block";
//   document.querySelector('.card--type').style.display = "block";
// }


const initOnboarding = () => {
  if(document.querySelector(".onboarding1") != null) {
    document.querySelector(".onboarding1").addEventListener('click', goToOnboarding2)
    document.querySelector(".onboarding2").addEventListener('click', goToOnboarding3)
  }
}

const goToOnboarding2 = () => {
  document.querySelector(".onboarding1").style.display= "none";
  document.querySelector(".onboarding2").style.display= "block";
}

const goToOnboarding3 = () => {
  document.querySelector(".onboarding2").style.display= "none";
  document.querySelector(".onboarding3").style.display= "block";

}

const initRegister = () => {
  if(document.querySelector(".register--button") != null) {
    document.querySelectorAll(".register--button").forEach($btn => {$btn.addEventListener('click', goToPersonaliseAccount)});
    document.querySelector(".login--button").addEventListener('click', goToLogin)
    document.querySelector(".personaliseAccount--button").addEventListener('click', goToPersonalData)
  }
}

const goToPersonaliseAccount = () => {
  document.querySelector(".loginRegister").style.display= "none";
  document.querySelector(".login").style.display= "none";
  document.querySelector(".personaliseAccount").style.display= "block";
}

const goToPersonalData = () => {
  document.querySelector(".personaliseAccount").style.display= "none";
  document.querySelector(".personalData").style.display= "block";
}

const goToLogin = () => {
  document.querySelector(".loginRegister").style.display= "none";
  document.querySelector(".login").style.display= "block";
}

const initCreateAdventure= () => {
  if(document.querySelector(".takeOff--button") != null) {
    document.querySelector(".takeOff--button").addEventListener('click', goToPersonaliseVacation);
    document.querySelector(".invite--button").addEventListener('click', goToInviteFriends);
    document.querySelectorAll(".createAdventure--close").forEach($close => { $close.addEventListener('click', overlayOn)});
    document.querySelector(".overlay").addEventListener('click', overlayOff);
  }
}

const goToPersonaliseVacation = () => {
  document.querySelector(".emptyHomeScreen").style.display= "none";
  document.querySelector(".personalizeVacation").style.display= "block";
}

const goToInviteFriends = () => {
  document.querySelector(".personalizeVacation").style.display= "none";
  document.querySelector(".inviteFriends").style.display= "block";

}

const overlayOn = () => {
  document.querySelector(".overlay").style.display="block"
}

const overlayOff = () => {
  document.querySelector(".overlay").style.display="none"
}

const initOrder = () => {
  if(document.querySelector(".personalInfo--button") != null) {
    document.querySelector(".personalInfo--button").addEventListener('click', goToPersonalInfo)
    document.querySelector(".payment--button").addEventListener('click', goToPayment)
    document.querySelector(".takeOff-order--button").addEventListener('click', goToTakeOff)
    document.querySelector(".overview--button").addEventListener('click', goToOverview)

  }
}

const goToPersonalInfo = () => {
  document.querySelector(".selectPackage").style.display= "none";
  document.querySelector(".personalInformation").style.display= "block";
}

const goToPayment = () => {
  document.querySelector(".personalInformation").style.display= "none";
  document.querySelector(".payment").style.display= "block";

}

const goToTakeOff = () => {
  document.querySelector(".payment").style.display= "none";
  document.querySelector(".takeOff").style.display= "block";

}

const goToOverview = () => {
  document.querySelector(".takeOff").style.display= "none";
  document.querySelector(".overview").style.display= "block";

}

const initGuide = () => {
  currentGuideTab = 1;

  if(document.querySelector(".guide") != null) {
    document.querySelector(".guide").addEventListener('click', showNextGuideTab);
  }
}

const showNextGuideTab = () => {
currentGuideTab;
var nextGuideTab = currentGuideTab + 1;
var path = ".guide--tab--";
  if(nextGuideTab < 7){
    document.querySelector( path.concat(currentGuideTab.toString())).style.display= "none";
    document.querySelector(path.concat(nextGuideTab.toString())).style.display= "block";
    currentGuideTab = currentGuideTab + 1;
  } 
}

const initRules = () => {
  currentRulesTab = 1;
  if(document.querySelector(".rules") != null) {
    document.querySelector(".rules").addEventListener('click', showNextRulesTab);
  }
}

const showNextRulesTab = () => {
currentRulesTab;
var nextRulesTab = currentRulesTab + 1;
var path = ".rules--tab--";
  if(nextRulesTab < 7){
    document.querySelector( path.concat(currentRulesTab.toString())).style.display= "none";
    document.querySelector(path.concat(nextRulesTab.toString())).style.display= "block";
    currentRulesTab = currentRulesTab + 1;
  }
}

const initProfile = () => {
  if(document.querySelector(".profile--change-info--button") != null) {
    document.querySelector(".profile--change-info--button").addEventListener('click', goToChangePersonalInfo)
    document.querySelector(".profile--save").addEventListener('click', goToProfilePage)
  }
}

const goToChangePersonalInfo = () => {
  document.querySelector(".profile--custimize-info").style.display= "none";
  document.querySelector(".profile--personal-info").style.display= "block";
  document.querySelector(".profile--buttons").style.display= "none";

}

const goToProfilePage = () => {
  document.querySelector(".profile--personal-info").style.display= "none";
  document.querySelector(".profile--custimize-info").style.display= "block";
  document.querySelector(".profile--buttons").style.display= "block";
}

const initTutorial = () => {
  currentTutorialTab = 1;
  if(document.querySelector(".tutorial") != null) {
    document.querySelector(".tutorial").addEventListener('click', showNextTutorialTab);
  }
}

const showNextTutorialTab = () => {
currentTutorialTab;
var nextTutorialTab = currentTutorialTab + 1;
var path = ".tutorial--tab--";
  if(nextTutorialTab < 7){
    document.querySelector( path.concat(currentTutorialTab.toString())).style.display= "none";
    document.querySelector(path.concat(nextTutorialTab.toString())).style.display= "block";
    currentTutorialTab = currentTutorialTab + 1;
  }
}

init();
 