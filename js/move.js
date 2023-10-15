// function drawLine() {
//     const canvas = document.getElementById("myCanvas");
//     const ctx = canvas.getContext("2d");

//     const startX = parseFloat(document.getElementById("startX").value);
//     const startY = parseFloat(document.getElementById("startY").value);
//     const endX = parseFloat(document.getElementById("endX").value);
//     const endY = parseFloat(document.getElementById("endY").value);

//     ctx.clearRect(0, 0, canvas.width, canvas.height);

//     ctx.beginPath();
//     ctx.moveTo(startX, startY);
//     ctx.lineTo(endX, endY);
//     ctx.stroke();
// }

function drawLines() {
    const canvas = document.getElementById("myCanvas");
    const ctx = canvas.getContext("2d");

    // Define the coordinates for your lines
    const vLine1StartX = parseFloat(document.getElementById("vLine1StartX").value);
    const vLine1StartY = parseFloat(document.getElementById("vLine1StartY").value);

    const hLine1StartX = parseFloat(document.getElementById("hLine1StartX").value);
    const hLine1StartY = parseFloat(document.getElementById("hLine1StartY").value);

    const vLine2StartX = parseFloat(document.getElementById("vLine2StartX").value);
    const vLine2StartY = parseFloat(document.getElementById("vLine2StartY").value);

    const hLine2StartX = parseFloat(document.getElementById("hLine2StartX").value);
    const hLine2StartY = parseFloat(document.getElementById("hLine2StartY").value);

    // Define coordinates for other lines

    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw lines
    ctx.beginPath();

    // Vertical Line 1
    ctx.moveTo(vLine1StartX, vLine1StartY);
    ctx.lineTo(vLine1StartX, vLine1StartY + 100);

    // Horizontal Line 1
    ctx.moveTo(hLine1StartX, hLine1StartY);
    ctx.lineTo(hLine1StartX + 100, hLine1StartY); // Specify the endpoint correctly

    // Repeat for other lines...

    // Vertical Line 2
    ctx.moveTo(vLine2StartX, vLine2StartY);
    ctx.lineTo(vLine2StartX, vLine2StartY + 100);

    // Horizontal Line 2
    ctx.moveTo(hLine2StartX, hLine2StartY);
    ctx.lineTo(hLine2StartX + 100, hLine2StartY); // Specify the endpoint correctly

    ctx.stroke();
}
