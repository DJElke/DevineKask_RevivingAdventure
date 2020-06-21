<header>
  <a href="index.php?page=home">
    <span class="close">&#10005;</span>
  </a>
  <h1> Welcome to <?php echo $vacation['name'] ?>!</h1>
  <wrapper class="participant__list">
    <?php foreach($participants as $participant): ?>
        <div class= "participant">
          <?php if($participant['description'] == 'Owner'): ?>
            <p> <?php echo $participant['description'] ?> </p>
          <?php else: ?>
            <p> &nbsp; </p>
          <?php endif; ?>
          <span class="dot"></span>
            <p> <?php echo $participant['name'] ?> </p>
          </a>
        </div>
    <?php endforeach; ?>
    <div class="participant">
      <span class="plus">&#43;</span>
    </div>
  </wrapper>
  <div>
    <p><?php echo $status*11 ?>%</p>
  </div>
</header>
<section>
  <div <?php if($status >= 0): ?>
    class="unlocked" 
    <?php else: ?>
      class="locked" 
      <?php endif; ?>>
    <a class="station__link" <?php if($status == 0): ?> href="index.php?page=editorIndex&amp;id=<?php echo $vacation['id'];?>" <?php endif; ?>>
      <p>Station one</p>
    </a>
    <?php if($status == 1): ?><input type='checkbox' disabled='disabled' checked="true"><label>Playercards 4/4</label><?php else: ?><input type='checkbox' disabled='disabled'><label>Playercards 0/4</label><?php endif;?>
  </div> 
  <div <?php if($status >= 1): ?>
    class="unlocked" 
    <?php else: ?>
      class="locked" 
      <?php endif; ?>>
    <a class="station__link" <?php if($status == 1): ?> href="index.php?page=editorIndex&amp;id=<?php echo $vacation['id'];?>" <?php endif; ?>>
      <p>Station two</p>
    </a>
    <input type='checkbox' disabled='disabled'><label>Item cards 0/26</label>
  </div> 
  <div <?php if($status >= 2): ?>class="unlocked" <?php else: ?>class="locked" <?php endif; ?>>
    <a class="station__link" <?php if($status == 2): ?> href="index.php?page=editorIndex&amp;id=<?php echo $vacation['id'];?>" <?php endif; ?>>
      <p>Station three</p>
    </a>
   <input type='checkbox' disabled='disabled'><label>Adventure cards 0/27</label>
  </div> 
  <div <?php if($status >= 3): ?>class="unlocked" <?php else: ?> class="locked" <?php endif; ?>>
    <a class="station__link" <?php if($status == 3): ?> href="index.php?page=station4&amp;id=<?php echo $vacation['id'];?>" <?php endif; ?>>
      <p>Station four</p>
    </a>
    <?php if($status >= 4): ?><input type='checkbox' disabled='disabled' checked='true'><?php else: ?><input type='checkbox' disabled='disabled'><?php endif;?><label>Style vote</label>
  </div> 
</section>