<?php foreach ($todo as $todoitem):?>
<h2><?php echo $todoitem['item_name']?></h2>
<?php endforeach?>
	<a class="big" href="../../../items/delete/<?php echo $todoitem['id']?>">
	<span class="item">
	Delete this item
	</span>
	</a><br/>
