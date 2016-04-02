<?php
	require_once("../../connect_zoo-app.php");

	$type = $_POST["type"];
	$id = $_POST["id"];
	$accepted = $_POST["accepted"];

	$type_slider = "slider";
	$type_radio = "radio";
	$type_checkbox = "checkbox";
	$type_trueFalse = "trueFalse";
	$type_sort = "sort";
	$type_text = "text";
	$type_creative = "creative";
	
	switch ($type) {
		case $type_slider:
			$question = $_POST["question"];
			$min = $_POST["min"];
			$max = $_POST["max"];
			$step = $_POST["step"];
			$answer = $_POST["answer"];

			mysqli_query($db_zoo_app, 
				"UPDATE questions_slider SET question = '$question', min = $min, max = $max, step =  $step, answer =  $answer, accepted = $accepted WHERE id = $id");
			echo(true);
			break;
		case $type_radio:
			$question = $_POST["question"];
			$falseAnswers = $_POST["falseAnswers"];
			$answer = $_POST["answer"];

			mysqli_query($db_zoo_app, 
				"UPDATE questions_radio SET question =  '$question', falseAnswers =  $falseAnswers, answer =  '$answer', accepted = $accepted WHERE id = $id");
			echo(true);
			break;
		case $type_checkbox:
			$question = $_POST["question"];
			$falseAnswers = $_POST["falseAnswers"];
			$answers = $_POST["answers"];

			mysqli_query($db_zoo_app, 
				"UPDATE questions_checkbox SET question = '$question', falseAnswers = $falseAnswers, answers = $answers, accepted = $accepted WHERE id = $id");
			echo(true);
			break;
		case $type_trueFalse:
			$question = $_POST["question"];
			$answer = $_POST["answer"];

			mysqli_query($db_zoo_app, 
				"UPDATE questions_true_false SET question = '$question', answer = $answer, accepted = $accepted WHERE id = $id");
			echo(true);
			break;
		case $type_sort:
			$question = $_POST["question"];
			$answers = $_POST["answers"];

			mysqli_query($db_zoo_app, 
				"UPDATE questions_sort SET question = '$question', answers = $answers, accepted = $accepted WHERE id = $id");
			echo(true);
			break;
		case $type_text:
			$question = $_POST["question"];
			$answer = $_POST["answer"];

			mysqli_query($db_zoo_app, 
				"UPDATE questions_text SET question = '$question', answer = '$answer', accepted = $accepted WHERE id = $id");
			echo(true);
			break;
		case $type_task:
			$task = $_POST["task"];

			mysqli_query($db_zoo_app, 
				"UPDATE questions_creative SET task = '$task', accepted = $accepted WHERE id = $id");
			echo(true);
			break;
		default:
			echo "Question type " . $type . " unknown.";
			break;
	}
?>