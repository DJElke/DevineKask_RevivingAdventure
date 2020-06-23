<div class="overlay">
  <div>
    <p>If you quit now your progress will be lost. </p>
    <a href="index.php?page=home">OK</a>
  </div>
</div>

<div class="tab">
  <div class="station__grid">
    <header class="stationHeader">
    <h1 class="blue">Station two 
      <a href="index.php?page=home">
        <span class="close">&#10005;</span>
      </a>
    </h1>
    <p class="text--medium red text--margintop">Item cards for each player</p>
    </header>
    <img class="stationIntro__img stationIntro__img--padding" src='assets/illustrations/backpack.svg'>
    <p class="stationIntro__text text--medium">Add some items/typical situations for your friends!</p>
    <button type="button" class="stationIntro__next nextBtn secondaryButton" >START</button>
  </div>
</div>

<form class="itemCardForm" action="index.php?page=ownerStation2&amp;id=<?php echo $vacationId;?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="vacation_id" value="<?php echo $_GET['id'];?>" />
<!-- <input type="hidden" name="cardTypeId" value="2" /> -->

<?php $i = 0 ?> 
<!-- set amount of pictures that need to be uploaded per person -->
<?php $demoGame = 1?> 
<?php $actualGame = 6?>

  <?php foreach($participants as $participant): ?>
    <div class="tab">
      <div class=station__grid>
        <!-- HEADER -->
        <div class="stationHeader">
          <h1 class="blue">Item cards for <span class="red"><?php echo $participant['name'] ?></span>
            <a class="create-item--close">
              <span class="close">&#10005;</span>
            </a>
          </h1>
        </div>

         
         <div class="img--input fileInput__wrapper">
            <?php for($e = 1; $e <= $actualGame; $e++): ?>
              <div class="stationFileInput">
              <img class="hide output--small"/>
              <label class="custom-file-upload custom-file-upload--small" for="ptImage<?php echo $i;?>">+</label>
              <input type="file" accept="image/*" class="itemCardForm__img" name="itemImage<?php echo $i;?>" id="ptImage<?php echo $i;?>">
            </label>
              </div>
            <?php endfor; ?>
          </div>
          <p class="error"></p>
      
          <!-- NEXT BUTTON -->
          <div class="stationButtons">
            <button type="button" class="nextBtn secondaryButton"><?php echo $participant['id'] ?>/<?php echo count($participants) ?> NEXT</button>
          </div>

        </div>
    </div>
    <?php $i = $i + 1 ?> 
  <?php endforeach; ?> 
  <?php unset($i); ?>

  <div class="tab">
    <div class="station__grid">
      <div class="stationDone">
        <h1 class="blue">You are all done!</h1>
        </br>
        <p>I bet you can't wait for their review! &#128540;</p>
        <button type="submit" name="action" value="add" class="primaryButton">SUBMIT</button>
      </div>
    </div>
  </div>
</form>

  
