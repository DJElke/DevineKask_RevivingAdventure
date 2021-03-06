<div class="overlay">
  <div class="warning-quit">
    <p>If you quit now your progress will be lost. </p>
    <a href="index.php?page=home">OK</a>
  </div>
</div>


<div class="tab">
  <div class="station__grid">
    <header class="stationHeader">
      <h1 class="blue">Station three 
        <a href="index.php?page=home">
          <span class="close">&#10005;</span>
        </a>
      </h1>
      <p class="text--medium red text--margintop">Adventure cards for each player</p>
    </header>
    <img class="stationIntro__img stationIntro__img--padding" src='assets/illustrations/plane.svg'>
    <p class="stationIntro__text text--medium">What are the unforgetable adventures you made together</p>
    <button type="button" class="stationIntro__next nextBtn secondaryButton" >START</button>
  </div>
</div>

<form class="adventureCardForm" action="index.php?page=ownerStation3&amp;id=<?php echo $vacationId;?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="vacation_id" value="<?php echo $_GET['id'];?>" />
<!-- <input type="hidden" name="cardTypeId" value="3" /> -->

<?php $i = 0 ?> 
<!-- set amount of pictures that need to be uploaded per person -->
<?php $demoGame = 1?> 
<?php $actualGame = 6?>

<?php $momenttypes = array("funny moments", "joyful moments", "unforgetable moments", "cozy moments");?>

  <?php for($x = 0; $x < count($momenttypes); $x++): ?>
    <div class="tab">
      <div class="station__grid">
        <!-- HEADER -->
        <header class="stationHeader">
          <h1 class="blue">Adventure cards for <?php echo $momenttypes[$i] ?>
            <a class="create-adventure--close">
              <span class="close">&#10005;</span>
            </a>
          </h1>
        </header>

        <!-- FILE UPLOAD -->
        <div class="img--input fileInput__wrapper">
          <?php for($e = 1; $e <= $actualGame; $e++): ?>
            <div class="stationFileInput">
              <img class="hide output--small" id="img<?php echo $i . $e;?>"/>
              <label class="custom-file-upload custom-file-upload--small" for="ptImage<?php echo $i. $e;?>">+</label>
                <input type="file" accept="image/*" class="adventureCardForm__img" name="adventureImage<?php echo $i. $e;?>" id="ptImage<?php echo $i.$e;?>">
              </label>
            </div>
          <?php endfor; ?>
        </div>
        <p class="error"></p>

        <!-- NEXT BUTTON -->
        <div class="stationButtons">
            <button type="button" class="nextBtn secondaryButton"><?php echo array_search($i, $momenttypes)?>/<?php echo count($momenttypes) ?> NEXT</button>
          </div>

      </div>
    </div>
    <?php $i = $i + 1 ?> 
  <?php endfor; ?> 
  <?php unset($i); ?>

  <div class="tab">
    <div class="station__grid">
    <div class="stationDone">
        <h1 class="blue">You are all done!</h1>
        </br>
        <p>I bet you can't wait for their review! &#128540;</p>
        <p class="error"></p>
        <button type="submit" name="action" value="add" class="primaryButton">SUBMIT</button>
      </div>
    </div>
  </div>
</form>