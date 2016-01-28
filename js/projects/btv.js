function drawRoot(canvas) {
	var ctx = canvas.getContext('2d');
	ctx.lineWidth = 2;

	ctx.beginPath();
	ctx.arc(24, 21, 8, 2 * Math.PI, false);
	ctx.stroke();

	ctx.beginPath();
	ctx.moveTo(18, 27);
	ctx.lineTo(12, 33);
	ctx.stroke();

	ctx.beginPath();
	ctx.moveTo(30, 27);
	ctx.lineTo(36, 33);
	ctx.stroke();
}

function drawNode(canvas) {
	var ctx = canvas.getContext('2d');
	ctx.lineWidth = 2;

	ctx.beginPath();
	ctx.arc(24, 24, 8, 2 * Math.PI, false);
	ctx.stroke();
}

function drawBranch(canvas) {
	var ctx = canvas.getContext('2d');
	ctx.lineWidth = 2;

	ctx.beginPath();
	ctx.moveTo(16, 16);
	ctx.lineTo(32, 32);
	ctx.stroke();
}

function drawParent(canvas) {
	var ctx = canvas.getContext('2d');
	ctx.lineWidth = 2;

	ctx.beginPath();
	ctx.arc(24, 19, 8, 2 * Math.PI, false);
	ctx.stroke();

	ctx.beginPath();
	ctx.moveTo(24, 27);
	ctx.lineTo(24, 36);
	ctx.stroke();
}

function drawChild(canvas) {
	var ctx = canvas.getContext('2d');
	ctx.lineWidth = 2;

	ctx.beginPath();
	ctx.moveTo(24, 8);
	ctx.lineTo(24, 16);
	ctx.stroke();

	ctx.beginPath();
	ctx.arc(24, 24, 8, 2 * Math.PI, false);
	ctx.stroke();

	ctx.beginPath();
	ctx.moveTo(24, 32);
	ctx.lineTo(24, 41);
	ctx.stroke();
}

function drawSibling(canvas) {
	var ctx = canvas.getContext('2d');
	ctx.lineWidth = 2;

	ctx.beginPath();
	ctx.arc(24, 19, 4, 2 * Math.PI, false);
	ctx.stroke();

	ctx.beginPath();
	ctx.moveTo(20, 23);
	ctx.lineTo(14, 29);
	ctx.stroke();

	ctx.beginPath();
	ctx.moveTo(28, 23);
	ctx.lineTo(34, 29);
	ctx.stroke();

	ctx.beginPath();
	ctx.arc(10, 32, 4, 2 * Math.PI, false);
	ctx.stroke();

	ctx.beginPath();
	ctx.arc(38, 32, 4, 2 * Math.PI, false);
	ctx.stroke();
}

function drawLeaf(canvas) {
	var ctx = canvas.getContext('2d');
	ctx.lineWidth = 2;

	ctx.beginPath();
	ctx.moveTo(24, 11);
	ctx.lineTo(24, 19);
	ctx.stroke();

	ctx.beginPath();
	ctx.arc(24, 27, 8, 2 * Math.PI, false);
	ctx.stroke();
}