<form action="../items/add" method="post">
<input type="text" value="I have to..." onclick="this.value=''" name="todo"> <input type="submit" value="add">
</form>
<br/><br/>
<?php
/*foreach( $todo as $key1 => $value1 ) 
{ 

  echo 'key1:'.$key1 . '<br />'; 
  
  foreach( $value1 as $key2 => $value2 ) 
{ 
  echo  'key2:'.$key2 . ' <br />'; 
  
  foreach( $value2 as $key3 => $values3 ) 
    echo 'key3:' .$key3.' '. 'values3:'.$values3 . '<br />'; 
   
  echo '<br />'; 
}



}*/
?>
<?php $number = 0?>

<?php foreach ($todo as $todoitem):?>
	<a class="big" href="../items/view/<?php echo $todoitem['id']?>/<?php echo strtolower(str_replace(" ","-",$todoitem['item_name']))?>">
	<span class="item">
	<?php echo ++$number?>
	<?php echo $todoitem['item_name']?>
	</span>
	</a><br/>
<?php endforeach?>
