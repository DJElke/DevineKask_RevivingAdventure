
<div class="photoEditor__grid">
  <div class="menuContainer">
    <div class="containerItem--left quitButton"><a href="index.php?page=involvedVacation&amp;id=<?php echo $vacation['id'];?>" class="secondaryButton">QUIT</a></div>
    <div class="containerItem--right saveButton"><a class="primaryButton">NEXT</a></div>
  </div>

  <div class="photoContainer">
    <div class="cs" id="cs">Your browser does not support the html5 canvas</div>
  </div>


  <div class="editOption editOption--left stickersButton">STICKERS</div>
  <div class="editOption editOption--middle textButton">TEXT</div>
  <div class="editOption editOption--right drawButton">DRAW</div>


  <div class="optionsContainer">
    <!-- sticker items -->
    <div class="dragItems">
      <div class="stickerContainer">
          <img id="sticker1" class="sticker" src="assets/stickers/svg/citrus.svg" alt="sticker" draggable="true"/>
      </div>
      <div class="stickerContainer">
          <img id="sticker2" class="sticker" src="assets/stickers/svg/koi-red.svg" alt="sticker" draggable="true"/>
      </div>
      <div class="stickerContainer">
          <img id="sticker3" class="sticker" src="assets/stickers/svg/bottle-blue.svg" alt="sticker" draggable="true"/>
      </div>
      <div class="stickerContainer">
          <img id="sticker4" class="sticker" src="assets/stickers/svg/glass-purple.svg" alt="sticker" draggable="true"/>
      </div>
      <div class="stickerContainer">
          <img id="sticker5" class="sticker" src="assets/stickers/svg/koi-blue.svg" alt="sticker" draggable="true"/>
      </div>
      <div class="stickerContainer">
          <img id="sticker6" class="sticker" src="assets/stickers/svg/bottle-red.svg" alt="sticker" draggable="true"/>
      </div>
    </div>


    <!-- text items -->
    <div class="textItem">
      <span class="text--big">+</span> </br> add some text
    </div>
  </div>

  <form class="hide editCardForm" action="index.php?page=photoEditor&amp;id=<?php echo $vacation['id'];?>&amp;cardCount=<?php echo $cardCount;?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="cardId" value="<?php echo $card['id']; ?>"/>
    <img class="hide editBgImg" src=<?php echo $card['img']; ?> alt="background"/>
    <div class="hide titleContainer">
      <?php if(($cardTitle != null) && ($status == 0)){?>
        <p class="red">psst... <?php echo $owner; ?> called <?php echo $cardTitle['description']; ?> ...</p>
      <?php } else {?> 
        <textarea name="title" type="textarea" placeholder="Title of the card..."></textarea>
      <?php } ?>
    </div>

    <div class="hide imgEditContainer">
    </div>
    
    <div class="hide descriptionContainer">
      <textarea name="description" class="descArea" type="textarea" maxlength="250" placeholder="Write here a fitting text for your masterpiece..."></textarea>
    </div>

    <div class="hide submitContainer">
      <button type="submit" class="secondaryButton" name="action" value="add">NEXT</button>
    </div>
  </form>
</div> 


