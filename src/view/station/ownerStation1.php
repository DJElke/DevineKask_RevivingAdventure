<!-- FIRST TAP - INTRODUCTION -->
<div class="tab">
  <div class="stationOne__grid">
    <header class="stationOneHeader">
      <h1 class="blue">Station one 
        <a href="index.php?page=home">
          <span class="close">&#10005;</span>
        </a>
      </h1>
      <p class="text--medium red text--margintop">Player cards for each player</p>
    </header>
    <img class="stationOneIntro__img" src='assets/illustrations/passport.svg'>
    <p class="stationOneIntro__text text--medium">Choose for every friend who is in this game a fitting character trait and a beautiful photo.</p>
    <button type="button" class="stationOneIntro__next nextBtn secondaryButton" >START</button>
  </div>
</div>

<form class="characterCardForm" action="index.php?page=ownerStation1&amp;id=<?php echo $vacationId;?>" method="post" enctype="multipart/form-data">
<!-- <input type="hidden" name="cardTypeId" value="1" /> -->

  <?php $i = 0 ?> 
  <?php foreach($participants as $participant): ?>
    <input type="hidden" name="cards[<?php echo $i;?>][vacation_id]" value="<?php echo $_GET['id'];?>" />
    <div class="tab">
      <div class="stationOne__grid">
      <!-- HEADER -->
      <div class="tab--header stationOneHeader">
        <img src="<?php echo $participant['icon'];?>" class="user--icon">
        <p class="text--medium blue bold">Player cards
        <a href="index.php?page=home">
          <span class="close">&#10005;</span>
        </a>
        </p>
      </div>
      <!-- DESCRIPTION -->
      <div class="stationOneDescription">
      <div class="charactercard__name text--big bold">
        <input type="hidden" name="cards[<?php echo $i;?>][participant_name]" value="<?php echo $participant['name'];?>" />
        <p><?php echo $participant['name'] ?>&nbsp;</p>
        <p> is the &nbsp;</p>
        <p class="characteristic--description red"> </p>
      </div>

        <div class="characteristic--options">
          <div class="characteristic--option--wrap"><input required type="radio" class="characteristic--option" id="funniest<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="funniest"><label for="funniest<?php echo $i;?>" class="characteristic--option--description text--medium">funniest</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="laziest<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="laziest"><label for="laziest<?php echo $i;?>" class="characteristic--option--description text--medium">laziest</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="clumsiest<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="clumsiest"><label for="clumsiest<?php echo $i;?>" class="characteristic--option--description text--medium">clumsiest</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="outragious<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="outragious"><label for="outragious<?php echo $i;?>" class="characteristic--option--description text--medium">outragious</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="optimist<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="optimist"><label for="optimist<?php echo $i;?>" class="characteristic--option--description text--medium">optimist</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="extravert<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="extravert"><label for="extravert<?php echo $i;?>" class="characteristic--option--description text--medium">extravert</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="narcissist<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="narcissist"><label for="narcissist<?php echo $i;?>" class="characteristic--option--description text--medium">narcissist</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="dramaqueen<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="drama queen"><label for="dramaqueen<?php echo $i;?>" class="characteristic--option--description text--medium">drama queen</label></div>
        </div>
      </div>

      <!-- FILE UPLOAD -->
      <div class="img--input stationFileInput"> 
        <label for="ptImage<?php echo $i;?>">
          <img class="output" width="200px"/>
          <label class="custom-file-upload" for="ptImage<?php echo $i;?>"><span class="plus">+</span></label>
          <input type="file" accept="image/*" class="characterCardForm__img" name="characterImage<?php echo $i;?>" id="ptImage<?php echo $i;?>" required>
        </label>
      </div>
      <p class="error"></p>

      <!-- NEXT BUTTON -->
      <div class="stationOneButtons">
        <button type="button" class="prevBtn">PREVIOUS</button>
        <button type="button" class="nextBtn secondaryButton"><?php echo $participant['id'] ?>/<?php echo count($participants) ?> NEXT</button>
      </div>

      </div>
    </div>
    <?php $i = $i + 1 ?> 
  <?php endforeach; ?>
  <?php unset($i); ?>

  <div class="tab">
    <p>You are all done!</p>
    <p>Now we wait if your friends will find it funny too &#128540;</p>
    <p class="error"></p>
    <button type="submit" name="action" value="add">SUBMIT</button>
  </div>
</form>

  
