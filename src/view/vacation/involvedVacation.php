<div class="vacation__grid">
<header class="vacationInfo bg--red">
  <div class="welcomeContainer">
    <p class="text--medium white">Welcome to <span class="blue"><?php echo $vacation['name'] ?></span>!    
      <a href="index.php?page=home">
        <span class="close">&#10005;</span>
      </a>
    </p>
  </div>

  <wrapper class="participant__list">
    <?php foreach($participants as $participant): ?>
        <div class= "participant">
          <img class="user--icon" src='<?php echo $participant['icon'] ?>'/>
            <p class="white bold"> <?php echo $participant['name'] ?> </p>
            <!-- <?php if($participant['description'] == 'Owner'): ?>
            <p> Master </p>
            <?php else: ?>
            <p class="hide">empty</p>
            <?php endif; ?> -->
        </div>
    <?php endforeach; ?>
    <div class="participant">
      <input type="image" src="assets/icons/plus-icon.svg" class="user--icon" >
      <p class="hide">empty</p>
    </div>
  </wrapper>
  <div class="progressbar__border--thick">
    <p class="progressbar red"><?php echo $status*11 ?>%</p>
  </div>
</header>

<section class="stationOverview">
  <!-- STATION 1 -->
  <div <?php if($status >= 0): ?>
    class="station--right station--unlocked" 
    <?php else: ?>
      class="station--right station--locked" 
      <?php endif; ?>>
      <a class="station__link" <?php if($status == 0): ?> href="index.php?page=editorIndex&amp;id=<?php echo $vacation['id'];?>" <?php endif; ?>>
      <p>Station one</p>
    </a>
  </div> 
  </br>
  </br>
  </br>
  </br>
  </br>
  <?php if($status >= 1): ?>
    <div class="checkboxContainer station--right blue">
      <input class="checkbox" type='checkbox' disabled='disabled' checked="true">
      <span class="checkbox__custom--checked"></span>
      <label class="station--checkbox--label" >Playercards 4/4</label>
    </div>
  <?php else: ?>
      <div class="checkboxContainer station--right red">
        <input class="checkbox" type='checkbox' disabled='disabled'>
        <span class="checkbox__custom--unchecked"></span>
        <label class="station--checkbox--label" >Playercards 0/4</label>
      </div>
  <?php endif;?>

  <!-- STATION 2 -->  
  <div 
  <?php if($status >= 1): ?> 
    class="station--left station--unlocked" 
  <?php else: ?> 
    class="station--left station--locked"
  <?php endif; ?>>
  <a class="station__link" <?php if($status == 1): ?> href="index.php?page=editorIndex&amp;id=<?php echo $vacation['id'];?>" <?php endif; ?>>
      <p>Station two</p>
    </a>
    </div> 
  </br>
  </br>
  </br>
  </br>
  </br>
  <?php if($status >= 2): ?>
    <div class="checkboxContainer station--left blue">
      <input class="checkbox" type='checkbox' disabled='disabled' checked="true">
      <span class="checkbox__custom--checked"></span>
      <label class="station--checkbox--label" >Item cards 26/26</label>
    </div>
    <?php else: ?>
      <div class="checkboxContainer station--left red">
        <input class="checkbox" type='checkbox' disabled='disabled'>
        <span class="checkbox__custom--unchecked"></span>
        <label class="station--checkbox--label" >Item cards 0/26</label>
      </div>
    <?php endif;?>

  <!-- STATION 3 -->
  <div <?php if($status >= 2): ?>
    class="station--right station--unlocked" 
    <?php else: ?>
      class="station--right station--locked" 
    <?php endif; ?>>
    <a class="station__link" <?php if($status == 2): ?> href="index.php?page=editorIndex&amp;id=<?php echo $vacation['id'];?>" 
      <?php endif; ?>>
      <p>Station three</p>
    </a>
  </div>
  </br>
  </br>
  </br>
  </br>
  </br>
  <?php if($status >= 3): ?>
    <div class="checkboxContainer station--right blue">
      <input class="checkbox" type='checkbox' disabled='disabled' checked="true">
      <span class="checkbox__custom--checked"></span>
      <label class="station--checkbox--label" >Adventure cards 27/27</label>
    </div>
  <?php else: ?>
    <div class="checkboxContainer station--right red">
        <input class="checkbox" type='checkbox' disabled='disabled'>
        <span class="checkbox__custom--unchecked"></span>
        <label class="station--checkbox--label" >Adventure cards 0/27</label>
    </div>
  <?php endif;?>

  <!-- STATION 4 -->
  <div <?php if($status >= 3): ?>
    class="station--left station--unlocked" 
  <?php else: ?>
    class="station--left station--locked"
  <?php endif; ?>>
    <a class="station__link" <?php if($status == 3): ?> href="index.php?page=station4&amp;id=<?php echo $vacation['id'];?>" <?php endif; ?>>
      <p>Station four</p>
    </a>
  </div> 
  </br>
  </br>
  </br>
  </br>
  </br>
  <?php if($status >= 4): ?>
    <div class="checkboxContainer station--left blue">
      <input class="checkbox" type='checkbox' disabled='disabled' checked="true">
      <span class="checkbox__custom--checked"></span>
      <label class="station--checkbox--label" >Style vote</label>
    </div>
  <?php else: ?>
    <div class="checkboxContainer station--left red">
        <input class="checkbox" type='checkbox' disabled='disabled'>
        <span class="checkbox__custom--unchecked"></span>
        <label class="station--checkbox--label" >Style vote</label>
    </div>
  <?php endif;?>
</section>

</div>
