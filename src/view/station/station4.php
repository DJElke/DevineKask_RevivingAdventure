
<div class="overlay">
  <div class="warning-quit">
    <p>If you quit now your progress will be lost. </p>
    <a href="index.php?page=home">OK</a>
  </div>
</div>

<header class="header--station">
  <a href="index.php?page=home">
    <span class="close">&#10005;</span>
  </a>
  <h1>Station four </h1>
  <p class="sub-text">Vote for you favorite card style</p>
</header>

<?php $i = 0 ?>
<form class="form--design--card" action="index.php?page=station4&amp;id=<?php echo $vacationId;?>" method="post">
<input type="hidden" name="vacation_id" value="<?php echo $_GET['id'];?>" />
<div class="list--design--card">
  <?php foreach ($designs as $design): ?>
    <div class="design--card">
      <label for="option<?php echo $i;?>">
        <input type="radio" class="design--option" id="option<?php echo $i;?>" name="design--option" value="<?php echo $design['id']?>">
        <div class="design--checkbox"></div> 
      </label>
      <p class="description-design"><?php echo $design['description']?></p>
      <div>      
        <img class="design" src="<?php echo $design['lucky_cards']?>">
        <img class="design" src="<?php echo $design['hazard_cards']?>">
      </div>
      <?php if($i == count($designs)-1): ?><p class="limited_edition">*limited edition</p><?php endif; ?>
    </div>
    <?php $i++; ?>
  <?php endforeach; ?>
  <?php unset($i) ?>
</div>
<button class="secondaryButton" type="submit" name="action" value="add">VOTE</button>
</form>