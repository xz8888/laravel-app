<div class="container">
    <div class="span12">
		<div class="row">
<?php

if($errors->count()) {
	echo "<div class=\"alert alert-error\"><h2>".Lang::line('common.error_message')."</h2>";
	foreach($errors->getMessages() as $messages){
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