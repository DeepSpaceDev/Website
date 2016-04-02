var Newman = require("newman");
var schedule = require("node-schedule");
var fs = require("fs");
var nodemailer = require("nodemailer");

var testJob;

newman();

function startNewman() {
	testJob = schedule.scheduleJob("* * 1 * * *", newman);
}

function stopNewman() {
	if(testJob) testJob.cancel();
	else warn("No Job running");
}

function newman() {
	var collectionJSON = JSON.parse(fs.readFileSync("/var/www/vhosts/deepspace.onl/httpdocs/scripts/tests/deepspace.onl.json", "utf8"));

	newmanOptions = {
		// envJson: JSON.parse(fs.readFileSync("envjson.json", "utf8")),
		// dataFile: data.csv,
		iterationCount: 2,
		outputFile: "scripts/tests/output.json",
		asLibrary: true,
		stopOnError: true
	};

	Newman.execute(collectionJSON, newmanOptions, callback);
}

function callback(e) {
	log(e);
}

function log(message) {
	var options = {
		from: '"Server" <server@deepspace.onl>',
		to: 'sese.tailor@gmail.com, kugelmann.dennis@gmail.com',
		subject: 'Log',
		text: message
	};
	sendMail(options);
}

function warn(message) {
	var options = {
		from: '"Server" <server@deepspace.onl>',
		to: 'sese.tailor@gmail.com, kugelmann.dennis@gmail.com',
		subject: 'Warning',
		text: message
	};
	sendMail(options);
}

function sendMail(options) {

	transporter.sendMail(options, function(error, info) {
		if(error) {
			return console.log(error);
		}
		console.log("Message sent: " + info);
	});
}
