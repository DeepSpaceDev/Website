var Newman = require("newman");
var schedule = require("node-schedule");

var testJob;

function startNewman() {
	testJob = schedule.scheduleJob("* * 1 * * *", newman);
}

function stopNewman() {
	if(testJob) testJob.cancel();
	else console.warn("No Job running");
}

function newman() {
	var collectionJSON = JSON.parse(fs.readFileSync("collection.json", "utf8"));

	newmanOptions = {
		envJson = JSON.parse(fs.readFileSync("envjson.json", "utf8")),
		dataFile: data.csv,
		iterationCount: 2,
		outputFile: "output.json",
		asLibrary: true,
		stopOnError: true
	};

	Newman.execute(collectionJSON, newmanOptions, callback);
}

function callback(e) {
	console.log(e);
}
