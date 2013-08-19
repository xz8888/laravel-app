<div class="container">
    <div class="col-lg-12">
		<div class="row">
<?php
$error_messages = Session::get('error_messages');

if(!empty($error_messages)) {
	echo "<div class=\"alert alert-error\"><h3><i class='icon-warning-sign'></i>".Lang::get('common.error_message')."</h3>";
	foreach($error_messages as $message){
	    echo "<p>$message</p>";
	}
	echo "</div>";
}

//here checks the validation message
$validation_errors = $errors->all();
if(sizeof($validation_errors) > 0){
    echo "<div class=\"alert alert-error\"><h3><i class='icon-warning-sign'></i>".Lang::get('common.error_message')."</h3>";
	foreach($validation_errors as $message){
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