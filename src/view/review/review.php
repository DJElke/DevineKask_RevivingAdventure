<a href="index.php?page=home">
  <span class="close">&#10005;</span>
</a>
<div>
  <?php if($status == 4): ?>
    <p> Player cards</p>
  <?php elseif($status == 5): ?>
    <p> Item cards</p>
  <?php else: ?>
    <p> Adventure cards</p>
  <?php endif; ?>
</div>

<form class="reviewCardForm" action="index.php?page=review&amp;id=<?php echo $vacationId;?>&amp;cardCount=<?php echo $cardCount;?>" method="POST">
  <input type="hidden" name="cardId" value="<?php echo $card['id']; ?>"/>

  <?php if($status == 4): ?>
    <p><?php echo $title['description']?></p>
  <?php else: ?>
    <div class="my-titles">
      <?php foreach ($titleArray as $title) : ?>
        <div><p><?php echo $title?></p></div>
      <?php endforeach; ?>
  </div>  
  <?php endif; ?>

  <div class="my-images">
      <?php foreach ($imageUrlArray as $image) : ?>
        <div><img src="<?php echo $image ?>"></div>
      <?php endforeach; ?>
  </div>

  <div class="my-descriptions">
      <?php foreach ($descriptionArray as $description):  ?>
        <p><?php echo $description ?></p>
      <?php endforeach; ?>
  </div>
  <div class="submitContainer">
    <button type="submit" class="secondaryButton" name="action" value="add">NEXT</button>
  </div>
</form>


