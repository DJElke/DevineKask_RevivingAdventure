<a href="index.php?page=home">
  <span class="close">&#10005;</span>
</a>

<div class="tab">
  <header>
    <h1>Station one </h1>
    <h2>Player cards for each player</h2>
  </header>
  <img src='assets/illustrations/passport.svg'>
  <p>Choose for every friend who is in this game a fitting character trait and a beautiful photo.<p>
  <button type="button" class="nextBtn" >START</button>
</div>

<form class="characterCardForm" action="index.php?page=ownerStation1" method="post" enctype="multipart/form-data">
<!-- <input type="hidden" name="cardTypeId" value="1" /> -->

  <?php $i = 0 ?> 
  <?php foreach($participants as $participant): ?>
    <input type="hidden" name="cards[<?php echo $i;?>][vacation_id]" value="<?php echo $_GET['id'];?>" />
    <div class="tab" >
      <div class="tab--header">
        <img src="<?php echo $participant['icon'];?>" class="user--icon">
        <p>Player cards</p>
      </div>

      <div class="charactercard__name">
        <input type="hidden" name="cards[<?php echo $i;?>][participant_name]" value="<?php echo $participant['name'];?>" />
        <p><?php echo $participant['name'] ?>&nbsp;</p>
        <p> is the &nbsp;</p>
        <p class="characteristic--description"> </p>
      </div>

        <div class="characteristic--options">
          <div class="characteristic--option--wrap"><input required type="radio" class="characteristic--option" id="funniest<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="funniest"><label for="funniest<?php echo $i;?>" class="characteristic--option--description">funniest</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="laziest<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="laziest"><label for="laziest<?php echo $i;?>" class="characteristic--option--description">laziest</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="clumsiest<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="clumsiest"><label for="clumsiest<?php echo $i;?>" class="characteristic--option--description">clumsiest</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="outragious<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="outragious"><label for="outragious<?php echo $i;?>" class="characteristic--option--description">outragious</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="optimist<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="optimist"><label for="optimist<?php echo $i;?>" class="characteristic--option--description">optimist</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="extravert<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="extravert"><label for="extravert<?php echo $i;?>" class="characteristic--option--description">extravert</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="narcissist<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="narcissist"><label for="narcissist<?php echo $i;?>" class="characteristic--option--description">narcissist</label></div>
          <div class="characteristic--option--wrap"><input type="radio" class="characteristic--option" id="dramaqueen<?php echo $i;?>" name="cards[<?php echo $i;?>][characteristic]" value="drama queen"><label for="dramaqueen<?php echo $i;?>" class="characteristic--option--description">drama queen</label></div>
        </div>

       <div class="img--input"> 
        <label for="ptImage<?php echo $i;?>">
          <img class="output" width="200px"/>
          <input type="file" accept="image/*" class="characterCardForm__img" name="characterImage<?php echo $i;?>" id="ptImage<?php echo $i;?>" required>
        </label>
      </div>
      <p class="error"></p>
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
    <p>Now we wait if your friends will find it funny too &#128540;</p>
    <button type="submit" name="action" value="add">SUBMIT</button>
  </div>
</form>

  
