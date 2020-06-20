<a href="index.php?page=home">
  <span class="close">&#10005;</span>
</a>
<div class="tab">
<header>
  <h1>Station three </h1>
  <h2>Adventure cards for each player</h2>
</header>
<img src='assets/illustrations/plane.svg'>
<p>What are the unforgetable adventures you made together<p>
<button type="button" class="nextBtn" >START</button>
</div>

<form class="adventureCardForm" action="index.php?page=ownerStation3" method="post" enctype="multipart/form-data">
<input type="hidden" name="vacation_id" value="<?php echo $_GET['id'];?>" />
<!-- <input type="hidden" name="cardTypeId" value="3" /> -->

<?php $i = 0 ?> 
<!-- set amount of pictures that need to be uploaded per person -->
<?php $demoGame = 1?> 
<?php $actualGame = 6?>

<?php $momenttypes = array("funny moments", "joyful moments", "unforgetable moments", "cozy moments");?>

  <?php for($x = 0; $x < count($momenttypes); $x++): ?>
    <div class="tab">
      <p>Adventure cards for <?php echo $momenttypes[$i] ?></p>
      <div class="adventureCardFrom__imagesholder">
        <?php for($e = 1; $e <= $demoGame; $e++): ?>
        <label for="ptImage<?php echo $i;?>" class="adventureCard__output__label">
          <img class="output"/>
          <input type="file" accept="image/*" class="adventureCardForm__img" name="adventureImage<?php echo $i;?>" id="ptImage<?php echo $i;?>">
        </label>
        <?php endfor; ?>
      </div>
      <p class="error"></p>
      <div>
        <button type="button" class="prevBtn">PREVIOUS</button>
        <button type="button" class="nextBtn"><?php echo $i+1 ?>/<?php echo count($momenttypes) ?> NEXT</button>
      </div>
    </div>
    <?php $i = $i + 1 ?> 
  <?php endfor; ?> 
  <?php unset($i); ?>

  <div class="tab">
    <p>You are all done!</p>
    <button type="submit" name="action" value="add">SUBMIT</button>
  </div>
</form>