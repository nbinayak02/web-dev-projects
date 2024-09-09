var expression = "2+3*(6-3)*8/2+9";
var opstack=[]
var outputstack=[]
var operator = ["+", "-", "*", "/"]

function precedence(op){
    if( op == "*" || op == "/" )
    return 2;
    if( op == "+" || op == "-")
    return 1;
}

function isOperator(a){
    
    for(var b in operator){
        if(a == operator[b])
        return 1;
        break;
    }
    return 0;
    
}
for(var e in expression){
    
    if(!isNaN(expression[e])){
        //operand
        outputstack.push(expression[e])
    } else if(isOperator(expression[e]) && opstack.length == 0){
        //operator and operator stack is empty
        opstack.push(expression[e])
    } else if (isOperator(expression[e]) && opstack.length > 0){
        
        if(precedence(expression[e]) > precedence(opstack[opstack.length - 1])) {
            outputstack.push(expression[e])
        } else if(precedence(expression[e]) <= precedence(opstack[opstack.length - 1])) {
            while(precedence(opstack[opstack.length -1]) < precedence(expression[e])) {
                outputstack.push(opstack.pop())
            }
            
         if(expression[e] == "(")   {
             opstack.push(expression[e])
         }
         
         if(expression[e] == ")"){
            
             while(opstack[opstack.length -1]!="("){
                 outputstack.push(opstack.pop())
                 
             }
         }
         
         while(opstack.length != 0){
 outputstack.push(opstack.pop())
         }
        }
        
    }
    
    
    
    
}
for(var e in outputstack){
    console.log(outputstack[e])
}