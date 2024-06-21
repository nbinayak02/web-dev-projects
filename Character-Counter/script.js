var inputLength;
function calcChar() {
    var inputString = document.getElementById("input-field").value;
    inputLength = inputString.length;
    document.getElementById("result").innerHTML = inputLength+1;
}
