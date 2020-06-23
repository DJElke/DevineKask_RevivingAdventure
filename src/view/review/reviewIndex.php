<div class="overlay">

  <div class="warning-quit">
    <p>If you quit now your progress will be lost. </p>
    <a href="index.php?page=home">OK</a>
  </div>

</div>

<header>
  <a href="index.php?page=home">
    <span class="close">&#10005;</span>
  </a>
  <?php if($status == 4): ?>
    <div class="header--station">
      <h1>Station five </h1>
      <p class="sub-text">Review the player cards for each player<p>
  </div>
  <?php elseif($status == 5): ?>
    <div class="header--station">
      <h1>Station six </h1>
      <p class="sub-text">Review the item cards for each player</p>
    </div>
  <?php else: ?>
    <div class="header--station">
      <h1>Station seven </h1>
      <p class="sub-text">Review the adventure cards for each player</p>
    </div>
  <?php endif; ?>
</header>

<div class="station-review-body">
  <img src='assets/illustrations/quizmaster.svg'>
  <p>Your friends edited the photo's you've uploaded. They also added some titles and descriptions. It's your turn to choose the best title  and description for them!<p>
  <p>Swipe trough the titles and descriptions until you find a MATCH.</p>
  <a href="index.php?page=review&amp;id=<?php echo $_GET['id'];?>" class="secondaryButton">START</a>
</div>

