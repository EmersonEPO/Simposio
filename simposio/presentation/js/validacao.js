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