<?php
	require_once("../../connect.php");
	require_once("../../pw.php");

	$type = urldecode(isset($_POST["type"]) ? $_POST("type") : $_GET["type"]);
	
	$type_slider = "slider";
	$type_radio = "radio";
	$type_checkbox = "checkbox";
	$type_trueFalse = "trueFalse";
	$type_sort = "sort";
	$type_text = "text";
	$type_creative = "creative";

	if($type == $type_slider) {
		$question = urldecode(isset($_POST["question"]) ? $_POST("question") : $_GET["question"]);
		$min = urldecode(isset($_POST["min"]) ? $_POST("min") : $_GET["min"]);
		$max = urldecode(isset($_POST["max"]) ? $_POST("max") : $_GET["max"]);
		$step = urldecode(isset($_POST["step"]) ? $_POST("step") : $_GET["step"]);
		$answer = urldecode(isset($_POST["answer"]) ? $_POST("answer") : $_GET["answer"]);

		# TODO put in DB
	} elseif($type == $type_radio) {
		$question = urldecode(isset($_POST["question"]) ? $_POST("question") : $_GET["question"]);
		$answer = urldecode(isset($_POST["answer"]) ? $_POST("answer") : $_GET["answer"]);
		$falseAnswer = urldecode(isset($_POST["falseAnswer"]) ? $_POST("falseAnswer") : $_GET["falseAnswer"]);

		# TODO put in DB
	} elseif ($type == $type_checkbox) {
		$question = urldecode(isset($_POST["question"]) ? $_POST("question") : $_GET["question"]);
		$answers = urldecode(isset($_POST["answers"]) ? $_POST("answers") : $_GET["answers"]);
		$falseAnswers = urldecode(isset($_POST["falseAnswers"]) ? $_POST("falseAnswers") : $_GET["falseAnswers"]);
		
		# TODO put in DB
	} elseif ($type == $type_trueFalse) {
		$question = urldecode(isset($_POST["question"]) ? $_POST("question") : $_GET["question"]);
		$answer = urldecode(isset($_POST["answer"]) ? $_POST("answer") : $_GET["answer"]);

		# TDO put in DB
	} elseif ($type == $type_sort) {
		$question = urldecode(isset($_POST["question"]) ? $_POST("question") : $_GET["question"]);
		$answers = urldecode(isset($_POST["answers"]) ? $_POST("answers") : $_GET["answers"]);

		# TODO put in DB
	} elseif ($type == $type_text) {
		$question = urldecode(isset($_POST["question"]) ? $_POST("question") : $_GET["question"]);
		$answer = urldecode(isset($_POST["answer"]) ? $_POST("answer") : $_GET["answer"]);

		# TODO put in DB
	} elseif ($type == $type_creative) {
		$task = urldecode(isset($_POST["task"]) ? $_POST("task") : $_GET["task"]);

		# TODO put in DB
	} else {
		# TODO answer with: 'Type not found'
	}
?>