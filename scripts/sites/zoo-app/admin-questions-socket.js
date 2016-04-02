var secrets = require('../../pw.js');
var host = secrets.dbHost;
var user = secrets.dbUser;
var pw = secrets.dbPw;

var typeSlider = 'slider';
var typeRadio = 'radio';
var typeCheckbox = 'checkbox';
var typeTrueFalse = 'trueFalse';
var typeSort = 'sort';
var typeText = 'text';
var typeCreative = 'creative';

var sql = new Ape.MySQL(host, user, pw, "zoo-app");

var clients = [];

sql.onConnect = function() {
	var socket = new Ape.sockServer("80", "https://deepspace.onl", {flushlf: true});

	socket.onAccept = function(client) {
		Ape.log("New client: " + client);
		client.write("Hello world\n");
		clients.push(client);
	}

	socker.onRead = function(client, data) {
		Ape.log("Recieved data: " + data + " from client: " + client);
		if(data == "bye") {
			client.close();
			var index = clients.indexOf(client);
			clients.splice(index, 1);
		} else {
			var body = JSON.parse(data);
			var type = body.type;
			var id = body.id;
			var accepted = body.accepted;

			switch(type) {
				case typeSlider: 
					var question = body.question;
					var min = body.min;
					var max = body.max;
					var step = body.step;
					var answer = body.answer;

					updateAndPush("UPDATE questions_slider SET question = '" + question + "', min = '" + min + "', max = '" + max + "', step = '" + step + "', answer = '" + answer + "', accepted = '" + accepted + "' WHERE id = " + id, type, id);
					break;
				case typeRadio: 
					var question = body.question;
					var falseAnswers = body.falseAnswers;
					var answer = body.answer;

					updateAndPush("UPDATE questions_radio SET question = '" + question + "', falseAnswers = '" + falseAnswers + "', answer = '" + answer + "', accepted = '" + accepted + "' WHERE id = " + id, type, id);
					break;
				case typeCheckbox: 
					var question = body.question;
					var falseAnswers = body.falseAnswers;
					var answers = body.answers;

					updateAndPush("UPDATE questions_checkbox SET question = '" + question + "', falseAnswers = '" + falseAnswers + "', answers = '" + answers + "', accepted = '" + accepted + "' WHERE id = " + id, type, id);
					break;
				case typeTrueFalse: 
					var question = body.question;
					var answer = body.answer;

					updateAndPush("UPDATE questions_true_false SET question = '" + question + "', answer = '" + answer + "', accepted = '" + accepted + "' WHERE id = " + id, type, id);
					break;
				case typeSort: 
					var question = body.question;
					var answers = body.answers;

					updateAndPush("UPDATE questions_sort SET question = '" + question + "', answers = '" + answers + "', accepted = '" + accepted + "' WHERE id = " + id, type, id);
					break;
				case typeText: 
					var question = body.question;
					var answer = body.answer;

					updateAndPush("UPDATE questions_text SET question = '" + question + "', answer = '" + answer + "', accepted = '" + accepted + "' WHERE id = " + id, type, id);
					break;
				case typeTask: 
					var task = body.task;

					updateAndPush("UPDATE questions_task SET task = '" + task + "', accepted = '" + accepted + "' WHERE id = " + id, type, id);
					break;
			}
		}
	}

	function updateAndPush(query, type, id) {
		sql.query(query, function(result, error) {
			if(error) Ape.log('Request error : ' + errorNo + ' : ' + this.errorString());
			else {
				var tableName = getDbNameByType(type);
				sql.query("SELECT * FROM " + type + " WHERE id = " + id, function(result) {
					for (var i = 0; i < clients.length; i++) {
						clients[i].write(result[0]);
					};
				});
			}
		});
	}

	function getDbNameByType(type) {
		switch(type) {
			case typeSlider: return "questions_slider";
			case typeRadio: return "questions_radio";
			case typeCheckbox: return "questions_checkbox";
			case typeTrueFalse: return "questions_true_false";
			case typeSort: return "questions_sort";
			case typeText: return "questions_text";
			case typeTask: return "questions_task";
		}
	}
}
