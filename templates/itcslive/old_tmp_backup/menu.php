<?php defined ('ITCS') or die ("Go away.");
  global $Config;
 // print_r($this->MenuInArray); exit;
?>
          <ul id="menu-<?php echo $this->MenuID; ?>" class="menu">
		    <?php foreach($this->MenuInArray as $Menu):?>
            <li id="menu-item-<?php echo $Menu->id; ?>" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-2 current_page_item menu-item-<?php echo $Menu->id; ?>"><a href="<?php echo $Config->site.$Menu->alias; ?>"><?php echo $Menu->title?></a></li>
			<?php endforeach; ?>
          </ul>
