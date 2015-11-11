"use strict" /* Ex4까지 완료 */
window.onload = function () {
    var stack = [];
    var displayVal = "0";

    for (var i in $$('button')) {
        $$('button')[i].onclick = function () {
            var value = this.innerHTML;
            if(value >= '0' && value <= '9'){
                if(displayVal == 0){
                    displayVal = value - '0';
                }
                else{
                    displayVal = displayVal.toString() + (value - '0');
                }
            }else if(value=='AC'){
	            	displayVal = 0;
	            	stack=[];
	            	document.getElementById("expression").innerHTML = '0';

	        }else if(value=='.'){
	        	if(displayVal.indexOf('.') == -1){
                    displayVal = displayVal.toString() + ".";
                }
	        }
            else{
            	var lastExpre = stack.pop();
            	var lastNumber = stack.pop();
            	if(lastExpre=="*" || lastExpre=="/" || lastExpre=="^"){
            		stack.push(highPriorityCalculator(lastExpre,lastNumber));
            	}else{
            		stack.push(lastNumber);
            		stack.push(lastExpre);
            	}
            	if(document.getElementById("expression").innerHTML == "0"){
                    document.getElementById("expression").innerHTML = displayVal.toString() + value;
                }
                else{
                    document.getElementById("expression").innerHTML = document.getElementById("expression").innerHTML + displayVal.toString() + value;
                }

            	displayVal='0';
            }

            document.getElementById('result').innerHTML = displayVal;
        };
    }
};
function factorial (x) {

}
function highPriorityCalculator(s, val) {
	if(s == "*"){
        return val * document.getElementById('result').innerHTML;
    }
    else if(s == "/"){
        return val / document.getElementById('result').innerHTML;
    }
    else if(s == "^"){
        return Math.pow(val, document.getElementById('result').innerHTML);
    }

}
function calculator(s) {
    var result = 0;
    var operator = "+";
    for (var i=0; i< s.length; i++) {
        
    }
    return result;
}
