<a href="index.php?page=home">
  <span class="close">&#10005;</span>
</a>
<div class="review--page--box">
<div class="card--type">
  <?php if($status == 4): ?>
    <h1 class="blue"> Player cards</h1>
  <?php elseif($status == 5): ?>
    <h1 class="blue"> Item cards</h1>
  <?php else: ?>
    <h1 class="blue"> Adventure cards</h1>
  <?php endif; ?>
</div>
</div>

<form class="reviewCardForm" action="index.php?page=review&amp;id=<?php echo $vacationId;?>&amp;cardCount=<?php echo $cardCount;?>" method="POST">
  <input type="hidden" name="cardId" value="<?php echo $card['id']; ?>"/>

  <div class="card--review">
    <?php if($status == 4): ?>
      <p class="unique--review--title"><?php echo $title['description']?></p>
    <?php else: ?>
      <div class="my-titles">
        <?php foreach ($titleArray as $title) : ?>
          <div><p class="review--title"><?php  echo $title?></p></div>
        <?php endforeach; ?>
    </div>  
    <?php endif; ?>

    <div class="my-images">
        <?php foreach ($imageUrlArray as $image) : ?>
          <div><img class="review--image" src="<?php echo $image ?>"></div>
        <?php endforeach; ?>
    </div>

    <div class="my-descriptions">
        <?php foreach ($descriptionArray as $description):  ?>
          <div class="despription--test"><p class="review--description"><span><?php echo $description ?></p></div>
        <?php endforeach; ?>
    </div>
    <!-- <div class="previewButton">
      <a class="secondaryButton">NEXT</a>
    </div> -->

    <div class="startreview-button">
      <button type="submit" class="reviewpage1--intro" name="action" value="add">NEXT</button>
    </div>
  </div>

  <!-- <div class="hide card--preview">
    <p class="title--preview">test</p>
    <img class="img--preview" src="uploads/camille.jpg" height="200px"></img>
    <p class="title--preview">test</p>
    <div class="reviewButton">
      <a>previous</a>
    </div>
    
  </div> -->

</form>



