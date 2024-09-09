
const display = document.getElementById("text");
const history = document.getElementById("history");

function show(input) {
    display.innerHTML += input;
}

function clearDisplay() {
    display.innerHTML = "";
    history.innerHTML = "";
}

function calculate() {
    var result;
    var exp = display.textContent;

    if(exp.search('pow') > 0){
        //calculate power
        clearDisplay();
        history.innerHTML = exp;
        show("power clicked");
    } else{

    
    try {

        result = eval(exp);

        clearDisplay();

        if (Number.isInteger(result)) {

            show(result);
        } else {
            show(result.toFixed(5));
        }

        history.innerHTML = exp;


    } catch {
        clearDisplay();
        display.innerHTML += "Error";
    }

}
}

function calcPow() {
    show("pow");
    var exp = display.textContent;
    var e = findIndex(exp, 'e');
    var p = findIndex(exp, 'p');
    e = exp.slice(0, e);
    p = exp.slice(p, exp.length);
    clearDisplay();
    history.innerHTML = exp;
    show(Math.pow(e,p));
}

function findIndex(str, typ) {
    if (typ == 'e') {
        return (str.indexOf('p'));
    } else {
        return (str.indexOf('w') + 1);
    }
}