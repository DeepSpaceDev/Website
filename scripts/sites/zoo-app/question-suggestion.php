<?php
	require_once("../../connect_zoo-app.php");
	require_once("../../tools/ErrorReporter.php");

	$type = urldecode(isset($_POST["type"]) ? $_POST["type"] : $_GET["type"]);
	
	$type_slider = "slider";
	$type_radio = "radio";
	$type_checkbox = "checkbox";
	$type_trueFalse = "trueFalse";
	$type_sort = "sort";
	$type_text = "text";
	$type_creative = "creative";

	if($type == $type_slider) {
		$question = urldecode(isset($_POST["question"]) ? $_POST["question"] : $_GET["question"]);
		$min = urldecode(isset($_POST["min"]) ? $_POST["min"] : $_GET["min"]);
		$max = urldecode(isset($_POST["max"]) ? $_POST["max"] : $_GET["max"]);
		$step = urldecode(isset($_POST["step"]) ? $_POST["step"] : $_GET["step"]);
		$answer = urldecode(isset($_POST["answer"]) ? $_POST["answer"] : $_GET["answer"]);

		if(mysqli_query($db_zoo_app, "INSERT INTO questions_slider (question, min, max, step, answer) VALUES ('$question', $min, $max, $step, $answer)")){
			echo "true";
		}
	} elseif($type == $type_radio) {
		$question = urldecode(isset($_POST["question"]) ? $_POST["question"] : $_GET["question"]);
		$answer = urldecode(isset($_POST["answer"]) ? $_POST["answer"] : $_GET["answer"]);
		$falseAnswers = urldecode(isset($_POST["falseAnswers"]) ? $_POST["falseAnswers"] : $_GET["falseAnswers"]);

		if(mysqli_query($db_zoo_app, "INSERT INTO questions_radio (question, answer, falseAnswers) VALUES ('$question', '$answer', '$falseAnswers')")){
			echo "true";
		}
	} elseif ($type == $type_checkbox) {
		$question = urldecode(isset($_POST["question"]) ? $_POST["question"] : $_GET["question"]);
		$answers = urldecode(isset($_POST["answers"]) ? $_POST["answers"] : $_GET["answers"]);
		$falseAnswers = urldecode(isset($_POST["falseAnswers"]) ? $_POST["falseAnswers"] : $_GET["falseAnswers"]);
		
		if(mysqli_query($db_zoo_app, "INSERT INTO questions_checkbox (question, answer, falseAnswers) VALUES ('$question', '$answers', '$falseAnswers')")){
			echo "true";
		}
	} elseif ($type == $type_trueFalse) {
		$question = urldecode(isset($_POST["question"]) ? $_POST["question"] : $_GET["question"]);
		$answer = urldecode(isset($_POST["answer"]) ? $_POST["answer"] : $_GET["answer"]);

		if(mysqli_query($db_zoo_app, "INSERT INTO questions_true_false (question, answer) VALUES ('$question', '$answer')")){
			echo "true";
		}
	} elseif ($type == $type_sort) {
		$question = urldecode(isset($_POST["question"]) ? $_POST["question"] : $_GET["question"]);
		$answers = urldecode(isset($_POST["answers"]) ? $_POST["answers"] : $_GET["answers"]);

		if(mysqli_query($db_zoo_app, "INSERT INTO questions_sort (question, answers) VALUES ('$question', '$answers')")){
			echo "true";
		}
	} elseif ($type == $type_text) {
		$question = urldecode(isset($_POST["question"]) ? $_POST["question"] : $_GET["question"]);
		$answer = urldecode(isset($_POST["answer"]) ? $_POST["answer"] : $_GET["answer"]);

		if(mysqli_query($db_zoo_app, "INSERT INTO questions_text (question, answer) VALUES ('$question', '$answer')")){
			echo "true";
		}
	} elseif ($type == $type_creative) {
		$task = urldecode(isset($_POST["task"]) ? $_POST["task"] : $_GET["task"]);

		if(mysqli_query($db_zoo_app, "INSERT INTO questions_creative (task) VALUES ('$task')")){
			echo "true";
		}
	} else {
		echo "Error, please contact the Webmaster";
	}
?>