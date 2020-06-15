require('./style.css');
require('konva');
{

  const init = () => {
    if (typeof window.orientation !== 'undefined') { 
      loadCanvasMobile();
    }else{
      loadCanvasDesktop();
    }
  };

  //deze mag dan op het einde weg ofso
  const loadCanvasDesktop = () => {
    let width = 540;
    let height = 960;

    //making the container
    let stage = new Konva.Stage({
        container: 'cs',
        width: width,
        height: height,
    });
    //making the background layer
    let background = new Konva.Layer();
    stage.add(background);
    //making the sticker layer
    let layer = new Konva.Layer();
    stage.add(layer);
      
    //getting the stickers
    let itemURL = '';
    let dragitems = document.getElementById('drag-items');
    dragitems.addEventListener('dragstart', e => {
      itemURL = e.target.src;
    });

    //add the background to the background layer and resize it so it fits
    let bgImageURL = 'assets/img/bg.PNG';
    Konva.Image.fromURL(bgImageURL, image => {
      image.attrs.image.width = width;
      image.attrs.image.height = height;
      background.add(image);
      background.draw();
    });

    //add sticker layer before background 
    background.zIndex(0);
    layer.zIndex(1);

    let con = stage.container();
    con.addEventListener('dragover', e => {
      e.preventDefault();
    });

    con.addEventListener('drop', e => {
      e.preventDefault();
      stage.setPointersPositions(e);
      Konva.Image.fromURL(itemURL, image => {
        //image.attrs.image.width = 60;
        //image.attrs.image.height = 50;
        layer.add(image);
        image.position(stage.getPointerPosition());
        image.draggable(true);
        layer.draw();
        });
    });
  };

  const loadCanvasMobile = () => {
    let width = 540;
    let height = 960;
  
    //making the container
    let stage = new Konva.Stage({
      container: 'cs',
      width: width,
      height: height,
    });

    //making the background layer
    let background = new Konva.Layer();
    stage.add(background);
    //making the sticker layer
    let layer = new Konva.Layer();
    stage.add(layer);

    //add the background to the background layer and resize it so it fits
    let bgImageURL = 'assets/img/bg.png';
    Konva.Image.fromURL(bgImageURL, image => {
      image.attrs.image.width = width;
      image.attrs.image.height = height;
      background.add(image);
      background.draw();
    });

    //getting the stickers from the stickerlane
    let itemURL = '';
    let dragitems = document.getElementById('drag-items');

    //When you click on a sticker, add it to the stickerlayer
    //Add the image to another Array which will be used to obtain all the stickers in the layer

    dragitems.addEventListener('click', e => {
      itemURL = e.target.src;
      let imgObj = new Image();
      imgObj.src = itemURL;
      let sticker = new Konva.Image({
          x: 270,
          y: 480,
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




  init();
}