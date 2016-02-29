<?php
	require_once("../../connect_zoo-app.php");

	$type = urldecode(isset($_POST["type"]) ? $_POST["type"] : $_GET["type"]);
	$id = urldecode(isset($_POST["id"]) ? $_POST["id"] : $_GET["id"]);
	$accepted = urldecode(isset($_POST["accepted"]) ? $_POST["accepted"] : $_GET["accepted"]);

	$type_slider = "slider";
	$type_radio = "radio";
	$type_checkbox = "checkbox";
	$type_trueFalse = "trueFalse";
	$type_sort = "sort";
	$type_text = "text";
	$type_creative = "creative";

	switch ($type) {
		case $type_slider:
			$question = urldecode(isset($_POST["question"]) ? $_POST["question"] : $_GET["question"]);
			$min = urldecode(isset($_POST["min"]) ? $_POST["min"] : $_GET["min"]);
			$max = urldecode(isset($_POST["max"]) ? $_POST["max"] : $_GET["max"]);
			$step = urldecode(isset($_POST["step"]) ? $_POST["step"] : $_GET["step"]);
			$answer = urldecode(isset($_POST["answer"]) ? $_POST["answer"] : $_GET["answer"]);

			mysqli_query($db_zoo_app, "UPDATE questions_slider SET question = " . $question . 
				                                                ", min = " . $min . 
				                                                ", max = " . $max . 
				                                                ", step = " . $step .
				                                                ", answer = " . $answer .
				                                                ", accepted = " . $accepted .
				                                                "WHERE id = " . $id);
			break;
		case $type_radio:
			$question = urldecode(isset($_POST["question"]) ? $_POST["question"] : $_GET["question"]);
			$falseAnswers = urldecode(isset($_POST["falseAnswers"]) ? $_POST["falseAnswers"] : $_GET["falseAnswers"]);
			$answer = urldecode(isset($_POST["answer"]) ? $_POST["answer"] : $_GET["answer"]);

			mysqli_query($db_zoo_app, "UPDATE questions_slider SET question = " . $question . 
				                                                ", falseAnswers = " . $falseAnswers . 
				                                                ", answer = " . $answer .
				                                                ", accepted = " . $accepted .
				                                                "WHERE id = " . $id);
			break;
		case $type_checkbox:
			$question = urldecode(isset($_POST["question"]) ? $_POST["question"] : $_GET["question"]);
			$falseAnswers = urldecode(isset($_POST["falseAnswers"]) ? $_POST["falseAnswers"] : $_GET["falseAnswers"]);
			$answers = urldecode(isset($_POST["answers"]) ? $_POST["answers"] : $_GET["answers"]);

			mysqli_query($db_zoo_app, "UPDATE questions_slider SET question = " . $question . 
				                                                ", falseAnswers = " . $falseAnswers . 
				                                                ", answers = " . $answers .
				                                                ", accepted = " . $accepted .
				                                                "WHERE id = " . $id);
			break;
		case $type_trueFalse:
			$question = urldecode(isset($_POST["question"]) ? $_POST["question"] : $_GET["question"]);
			$answer = urldecode(isset($_POST["answer"]) ? $_POST["answer"] : $_GET["answer"]);

			mysqli_query($db_zoo_app, "UPDATE questions_slider SET question = " . $question .
				                                                ", answer = " . $answer .
				                                                ", accepted = " . $accepted .
				                                                "WHERE id = " . $id);
			break;
		case $type_sort:
			$question = urldecode(isset($_POST["question"]) ? $_POST["question"] : $_GET["question"]);
			$answers = urldecode(isset($_POST["answers"]) ? $_POST["answers"] : $_GET["answers"]);

			mysqli_query($db_zoo_app, "UPDATE questions_slider SET question = " . $question .
				                                                ", answers = " . $answers .
				                                                ", accepted = " . $accepted .
				                                                "WHERE id = " . $id);
			break;
		case $type_text:
			$question = urldecode(isset($_POST["question"]) ? $_POST["question"] : $_GET["question"]);
			$answer = urldecode(isset($_POST["answer"]) ? $_POST["answer"] : $_GET["answer"]);

			mysqli_query($db_zoo_app, "UPDATE questions_slider SET question = " . $question .
				                                                ", answer = " . $answer .
				                                                ", accepted = " . $accepted .
				                                                "WHERE id = " . $id);
			break;
		case $type_trueFalse:
			$task = urldecode(isset($_POST["task"]) ? $_POST["task"] : $_GET["task"]);

			mysqli_query($db_zoo_app, "UPDATE questions_slider SET task = " . $task .
				                                                ", accepted = " . $accepted .
				                                                "WHERE id = " . $id);
			break;
		default:
			echo "Question type " . $type . " unknown.";
			break;
	}
?>