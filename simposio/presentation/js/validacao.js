function validaPessoa(){

	formcliente = document.formPessoa;
	var texto = "";
	var erro = 0;

	if(formcliente.nome.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo NOME<br/>";
		document.getElementById('nome').style.background = '#FF9933';
	}
	
	
	if(formcliente.nascimento.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo DATA NASCIMENTO<br/>";
		document.getElementById('nascimento').style.background = '#FF9933';
	}
	
	if(formcliente.sexo.value == ""){
		erro = 1;
		texto = texto + "Selecione um SEXO<br/>";
		document.getElementById('sexo').style.background = '#FF9933';
	}
        
	if(formcliente.bairro.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo BAIRRO<br/>";
		document.getElementById('bairro').style.background = '#FF9933';
	}
	
	if(formcliente.estado.value == ""){
		erro = 1;
		texto = texto + "Selecione um Estado<br/>";
		document.getElementById('estado').style.background = '#FF9933';
	}
        
        if(formcliente.cidade.value == ""){
		erro = 1;
		texto = texto + "Selecione uma Cidade<br/>";
		document.getElementById('estado').style.background = '#FF9933';
	}
	
	if(formcliente.email.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo E-MAIL<br/>";
		document.getElementById('email').style.background = '#FF9933';
	}
	
	if(formcliente.senha.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo SENHA<br/>";
		document.getElementById('senha').style.background = '#FF9933';
	}
	
	if (formcliente.email.value.lastIndexOf("@") == -1) {
		erro = 1;
		texto = texto + "Formato ilegal para E-MAIL<br/>";
		document.getElementById('email').style.background = '#FF9933';
	}
	
	if(erro == 1){
	    MM_effectAppearFade('errocadastro',1000,0,100, false); //Chamar a função p/ mostrar a div erro
		document.getElementById('errocadastro').innerHTML = texto;
		return false;
	}
}

function vCPF (ncpf) {
   CPF = ncpf.value;
   var erro=0;
   var texto= "";
   if (CPF.length != 11 || CPF == "00000000000" || CPF == "11111111111" ||
       CPF == "22222222222" ||    CPF == "33333333333" || CPF == "44444444444" ||
       CPF == "55555555555" || CPF == "66666666666" || CPF == "77777777777" ||
       CPF == "88888888888" || CPF == "99999999999" || CPF.length<1){
	   MM_effectAppearFade('errocadastro',1000,0,100, false); //Chamar a função p/ mostrar a div erro
	   document.getElementById('errocadastro').innerHTML = "CPF invalido!";
	   //alert ("CPF inválido!");
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
	   return false;}
   soma = 0;
   for (i = 0; i < 10; i ++)
       soma += parseInt(CPF.charAt(i)) * (11 - i);
   resto = 11 - (soma % 11);
   if (resto == 10 || resto == 11)
       resto = 0;
   if (resto != parseInt(CPF.charAt(10))){
	   return false;
	}    
   return true;
}