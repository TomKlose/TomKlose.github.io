
var btn0 = document.getElementById('rechner_button0');
var btn1 = document.getElementById('rechner_button1');
var btn2 = document.getElementById('rechner_button2');
var btn3 = document.getElementById('rechner_button3');
var btn4 = document.getElementById('rechner_button4');
var btn5 = document.getElementById('rechner_button5');
var btn6 = document.getElementById('rechner_button6');
var btn7 = document.getElementById('rechner_button7');
var btn8 = document.getElementById('rechner_button8');
var btn9 = document.getElementById('rechner_button9');

var clear = document.getElementById('rechner_buttonClear');
var plus = document.getElementById('rechner_buttonPlus');
var minus = document.getElementById('rechner_buttonMinus');
var gleich = document.getElementById('rechner_buttonGleich');

var ergebnis = document.getElementById('rechner_Ergebnis');

var anzeige = '0';
var hintergrundAnzeige;
var stringArray = [];

var rechNummernBtn = document.getElementsByClassName('rechner_buttonZahl');
var rechFunktionBtn = document.getElementsByClassName('rechner_buttonFunk');



var updateAnzeige = (clickObj) => {
	var btnNum = clickObj.target.innerText;
	
	if(anzeige ==='0')
		anzeige = '';
	
	anzeige += parseInt(btnNum);
	ergebnis.innerText = anzeige;
}

function resetView()  {
	hintergrundAnzeige = anzeige;
	anzeige = '0';
	ergebnis.innerText = anzeige;
	stringArray.push(parseInt(hintergrundAnzeige));
}

var machFunktion = (clickObj) => {
	var funk = clickObj.target.innerText;
	
	switch (funk) {
		
		case '+':
			resetView();
			stringArray.push('+');
			break;
	
		case '-':
			resetView();
			stringArray.push('-');
			break;
	
		case '=':
			stringArray.push(parseInt(anzeige));
			console.log(stringArray);
			var zwischenrechnung = stringArray[0];
			
			for (i = 0; i < stringArray.length; i++) {
					aktuellesElement = stringArray[i];
					naechstesElement = 0;
	
					if (i + 1 != stringArray.length) {
						naechstesElement = stringArray[i + 1];
					}
	
					if (aktuellesElement == "+") {
						zwischenrechnung += naechstesElement;
					}
					else if (aktuellesElement == "-") {
						zwischenrechnung -= naechstesElement;
					}
		
					else {
		
					}
				}
			anzeige = zwischenrechnung;
			ergebnis.innerText = anzeige;
			stringArray = [];
			break;
		default:
			break;
	}
}

for (let i = 0; i < rechNummernBtn.length; i++) {
	rechNummernBtn[i].addEventListener('click', updateAnzeige, false);
}

for (let i = 0; i < rechFunktionBtn.length; i++) {
	rechFunktionBtn[i].addEventListener('click', machFunktion, false);
}

clear.onclick = () => {
	anzeige = "0";
	hintergrundAnzeige = undefined;
	StringArray = [];
	ergebnis.innerHTML = anzeige;
}