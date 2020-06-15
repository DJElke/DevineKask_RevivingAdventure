<header>
  <a href="index.php?page=home">
      <span class="close">&#10005;</span>
    </a>
  <h1>Station one </h1>
  <h2>Player cards for each player</h2>
</header>

<div class="tab">
<img src='assets/passport.svg'>
<p>Choose for every friend who is in this game a fitting character trait and a beautiful photo.<p>
<button type="button" class="nextBtn" >START</button>
</div>

<form class="characterCardForm" action="index.php?page=ownedVacation" method="post">
<input type="hidden" name="vacation_id" value="<?php echo $_GET['id'];?>" />
<?php $i = 0 ?> 
  <?php foreach($participants as $participant): ?>
    <div class="tab" >
      <div class="charactercard__name">
        <input type="hidden" name="participant_name" value="<?php echo $participant['name'];?>" />
        <p><?php echo $participant['name'] ?>&nbsp;</p>
        <p> is the &nbsp;</p>
        <select name="characteristic" id="characteristic">
          <option value="laziest">laziest</option>
          <option value="funniest">funniest</option>
          <option value="clumsiest">clumsiest</option>
          <option value="stupidest">stupidest</option>
          <option value="napqueen">nap queen</option>
          <option value="loudest">loudest</option>
        </select>
      </div>
      <label for="ptImage<?php echo $i;?>">
        <img class="output" width="200px"/>
        <input type="file" accept="image/*" class="characterCardForm__img" name="image" id="ptImage<?php echo $i;?>">
      </label>
      <div>
        <button type="button" class="prevBtn">PREVIOUS</button>
        <button type="button" class="nextBtn"><?php echo $participant['id'] ?>/<?php echo count($participants) ?> NEXT</button>
      </div>
    </div>
    <?php $i = $i + 1 ?> 
  <?php endforeach; ?>
  <div class="tab">
    <p>You are all done!</p>
    <p>Now we wait if your friends will find it funny too &#128540;</p>
    <button type="submit" name="action" value="add">SUBMIT</button>
  </div>
</form>

  
