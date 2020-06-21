<a href="index.php?page=home">
  <span class="close">&#10005;</span>
</a>
<div>
  <p> Player cards</p>
</div>
<input type="hidden" name="cardId" value="<?php echo $card['id']; ?>"/>
      <p><?php echo $title['description']?></p>
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
<div>
  <button type="button" class="prevBtn">PREVIOUS</button>
  <button type="button" class="nextBtn"> NEXT</button>
</div>


