<div class="container">
    <div class="span12">
		<div class="row">
<?php

die(var_dump($errors));
if(count($errors->messages)) {
	echo "<div class=\"alert alert-error\"><h2>".Lang::line('common.error_message')."</h2>";
	foreach($errors->messages as $messages){
		foreach($messages as $message)
			echo "<p>$message</p>";
	}
	echo "</div>";
}
$messages = Session::get("messages");
if(count($messages)) {
	echo "<div class=\"alert alert-success\">";
	foreach ($messages as $message)
		echo "<p>$message</p>";
	echo "</div>";
}
?>
      </div>
   </div>
</div>