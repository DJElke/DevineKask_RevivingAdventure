<a href="index.php?page=home">
  <span class="close">&#10005;</span>
</a>
<div class="tab">
<header>
  <h1>Station two </h1>
  <h2>Item cards for each player</h2>
</header>
<img src='assets/illustrations/backpack.svg'>
<p>Add some items/typicle situations for your friends!<p>
<button type="button" class="nextBtn" >START</button>
</div>

<form class="itemCardForm" action="index.php?page=ownerStation2" method="post">
<input type="hidden" name="vacation_id" value="<?php echo $_GET['id'];?>" />
<?php $i = 0 ?> 
  <?php foreach($participants as $participant): ?>
    <div class="tab">
      <p>Item cards for <?php echo $participant['name'] ?></p>
      <div class="itemCardFrom__imagesholder">
      <?php for($e = 1; $e <= 6; $e++): ?>
      <label for="ptImage<?php echo $i;?>" class="itemCard__output__label">
        <img class="output"/>
        <input type="file" accept="image/*" class="itemCardForm__img" name="image" id="ptImage<?php echo $i;?>">
      </label>
      <?php endfor; ?>
      </div>
      <div>
        <button type="button" class="prevBtn">PREVIOUS</button>
        <button type="button" class="nextBtn"><?php echo $participant['id'] ?>/<?php echo count($participants) ?> NEXT</button>
      </div>
    </div>
    <?php $i = $i + 1 ?> 
  <?php endforeach; ?> 
  <?php unset($i); ?>

  <div class="tab">
    <p>You are all done!</p>
    <button type="submit" name="action" value="add">SUBMIT</button>
  </div>
</form>

  