let a = 0;
let alphabet = "abcdefghijklmnopqrstuvwxyz";

function onButtonClick(id) {
    a++;
    let text = document.getElementById("text-p").innerHTML;
    console.log(text)
    text = text.replaceAt(Math.random() * text.length, alphabet[Math.floor(Math.random() * alphabet.length)]);
    document.getElementById("text-p").innerHTML = text;

    document.getElementById(id).value = "Button clicked " + a + " times";
}

String.prototype.replaceAt = function(index, replacement) {
    return this.substring(0, index) + replacement + this.substring(index + replacement.length);
}