
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
    <?php foreach ($stickers as $sticker){?> 
      <div class="stickerContainer">
        <img id="sticker<?php echo $sticker['id']; ?>" class="sticker" src="<?php echo $sticker['image'];?>" alt="sticker<?php echo $sticker['id']; ?>" draggable="true"/>
      </div>
    <?php } ?>
    </div>

    <!-- text items -->
    <div class="textItem">
      <span class="text--big">+</span> </br> add some text
    </div>

    <!-- draw items -->
    <div class="drawItems hide">
      <div class="containerItem--left eraser"> Eraser
      </div>
      <div class="containerItem--right brush"> Brush
      </div>
    </div>
  </div>

  <form class="hide editCardForm" action="index.php?page=photoEditor&amp;id=<?php echo $vacation['id'];?>&amp;cardCount=<?php echo $cardCount;?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="cardId" value="<?php echo $card['id']; ?>"/>
    <img class="hide editBgImg" src=<?php echo $image; ?> alt="background"/>
    <div class="hide titleContainer">
      <?php if(($cardTitle != null) && ($status == 0)){?>
        <p class="red">psst... <?php echo $owner; ?> called <?php echo $cardTitle['description']; ?> ...</p>
      <?php } else {?> 
        <textarea class="titleArea" name="title" type="textarea" placeholder="Title of the card..."></textarea>
      <?php } ?>
    </div>

    <div class="hide imgEditContainer">
    </div>
    
    <div class="hide descriptionContainer">
      <textarea name="description" class="descArea" type="textarea" maxlength="250" placeholder="Write here a fitting text for your masterpiece..."></textarea>
    </div>

    <div class="hide submitContainer">
      <button type="submit" class="secondaryButton nextPic" name="action" value="add">NEXT</button>
    </div>
  </form>
</div> 


