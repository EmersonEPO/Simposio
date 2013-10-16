//valida cpf
function checkCpf(ncpf){
CPF = ncpf.value; 
CPF = CPF.replace(/[^\d]+/g,'');
   var erro=0;
   var texto= "";
   if (CPF.length != 11 || CPF == "00000000000" || CPF == "11111111111" ||
       CPF == "22222222222" ||    CPF == "33333333333" || CPF == "44444444444" ||
       CPF == "55555555555" || CPF == "66666666666" || CPF == "77777777777" ||
       CPF == "88888888888" || CPF == "99999999999" || CPF.length<1){
	   MM_effectAppearFade('erro',1000,0,100, false); //Chamar a fun��o p/ mostrar a div erro
	   document.getElementById('erro').innerHTML = "O cpf é invalido!";
	   //alert ("CPF inv�lido!");
	   //ncpf.focus();
	  return false;
	   }
   soma = 0;
   for (i=0; i < 9; i ++)
       soma += parseInt(CPF.charAt(i)) * (10 - i);
   resto = 11 - (soma % 11);
   if (resto == 10 || resto == 11)
       resto = 0;
   if (resto != parseInt(CPF.charAt(9))){
       MM_effectAppearFade('erro',1000,0,100, false); //Chamar a fun��o p/ mostrar a div erro
	   document.getElementById('erro').innerHTML = "O cpf é invalido!";
	   //alert ("CPF inv�lido!");
	   //ncpf.focus();
	   return false;}
   soma = 0;
   for (i = 0; i < 10; i ++)
       soma += parseInt(CPF.charAt(i)) * (11 - i);
   resto = 11 - (soma % 11);
   if (resto == 10 || resto == 11)
       resto = 0;
   if (resto != parseInt(CPF.charAt(10))){
       MM_effectAppearFade('erro',1000,0,100, false); //Chamar a fun��o p/ mostrar a div erro
	   document.getElementById('erro').innerHTML = "O cpf é invalido!";
	   return false;
	}
   MM_effectAppearFade('erro',1000,0,100, true); //Chamar a fun��o p/ mostrar a div erro
   return true;

}

