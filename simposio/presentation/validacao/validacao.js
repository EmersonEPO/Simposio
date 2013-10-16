function validaPessoa(){

	formPessoa = document.formPessoa;
	var texto = "";
	var erro = 0;
        var email = 0;

	if(formPessoa.nome.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo nome<br/>";
		document.getElementById('nome').style.background = '#ffdfdf';
	}
	if(formPessoa.cpf.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo cpf<br/>";
		document.getElementById('cpf').style.background = '#ffdfdf';
	}
        if(formPessoa.nascimento.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo data nascimento<br/>";
		document.getElementById('nascimento').style.background = '#ffdfdf';
	}
        if(formPessoa.sexo.value == ""){
		erro = 1;
		texto = texto + "Selecione o sexo<br/>";
		document.getElementById('sexo').style.background = '#ffdfdf';
	}
        if(formPessoa.fone.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo telefone<br/>";
		document.getElementById('fone').style.background = '#ffdfdf';
	}
        if(formPessoa.instituicao.value == ""){
		erro = 1;
		texto = texto + "Selecione uma instituição<br/>";
		document.getElementById('instituicao').style.background = '#ffdfdf';
	}
        if(formPessoa.instituicao.value == 1){
		erro = 1;
		texto = texto + "Preencha o campo instituição<br/>";
		document.getElementById('novaIns').style.background = '#ffdfdf';
	}
        if(formPessoa.rua.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo rua<br/>";
		document.getElementById('rua').style.background = '#ffdfdf';
	}
        if(formPessoa.numero.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo numero<br/>";
		document.getElementById('numero').style.background = '#ffdfdf';
	}
        if(formPessoa.bairro.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo bairro<br/>";
		document.getElementById('bairro').style.background = '#ffdfdf';
	}
        if(formPessoa.estado.value == ""){
		erro = 1;
		texto = texto + "Selecione um estado<br/>";
		document.getElementById('estado').style.background = '#ffdfdf';
	}
        if(formPessoa.cidade.value == ""){
		erro = 1;
		texto = texto + "Selecione uma cidade<br/>";
		document.getElementById('cidade').style.background = '#ffdfdf';
	}
        if(formPessoa.email.value == ""){
		erro = 1;
                email = 1;
		texto = texto + "Preencha o campo email<br/>";
		document.getElementById('email').style.background = '#ffdfdf';
	}
        if(email == 0){
            if (formPessoa.email.value.lastIndexOf("@") == -1) {
                erro = 1;
                texto = texto + "Formato ilegal para email<br/>";
                document.getElementById('email').style.background = '#ffdfdf';
            }
        }

        if(formPessoa.primeiraSenha.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo senha<br/>";
		document.getElementById('primeiraSenha').style.background = '#ffdfdf';
	}
     
        if(formPessoa.senha.value == ""){
		erro = 1;
		texto = texto + "Confirme a senha digitada<br/>";
		document.getElementById('senha').style.background = '#ffdfdf';
	}
        
        
	
	if(erro == 1){
	    MM_effectAppearFade('erro',1000,0,100, false);
		document.getElementById('erro').innerHTML = texto;
		return false;
	}
}

function validaPessoaEdit(){

	formPessoa = document.formPessoa;
	var texto = "";
	var erro = 0;

	if(formPessoa.nome.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo nome<br/>";
		document.getElementById('nome').style.background = '#ffdfdf';
	}
        if(formPessoa.nascimento.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo data nascimento<br/>";
		document.getElementById('nascimento').style.background = '#ffdfdf';
	}
        if(formPessoa.sexo.value == ""){
		erro = 1;
		texto = texto + "Selecione o sexo<br/>";
		document.getElementById('sexo').style.background = '#ffdfdf';
	}
        if(formPessoa.fone.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo telefone<br/>";
		document.getElementById('fone').style.background = '#ffdfdf';
	}
        if(formPessoa.instituicao.value == ""){
		erro = 1;
		texto = texto + "Selecione uma instituição<br/>";
		document.getElementById('instituicao').style.background = '#ffdfdf';
	}
        if(formPessoa.instituicao.value == 1){
		erro = 1;
		texto = texto + "Preencha o campo instituição<br/>";
		document.getElementById('novaIns').style.background = '#ffdfdf';
	}
        if(formPessoa.rua.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo rua<br/>";
		document.getElementById('rua').style.background = '#ffdfdf';
	}
        if(formPessoa.numero.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo numero<br/>";
		document.getElementById('numero').style.background = '#ffdfdf';
	}
        if(formPessoa.bairro.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo bairro<br/>";
		document.getElementById('bairro').style.background = '#ffdfdf';
	}
        if(formPessoa.estado.value == ""){
		erro = 1;
		texto = texto + "Selecione um estado<br/>";
		document.getElementById('estado').style.background = '#ffdfdf';
	}
        if(formPessoa.cidade.value == ""){
		erro = 1;
		texto = texto + "Selecione uma cidade<br/>";
		document.getElementById('cidade').style.background = '#ffdfdf';
	}
        
        
	if(erro == 1){
	    MM_effectAppearFade('erro',1000,0,100, false);
		document.getElementById('erro').innerHTML = texto;
		return false;
	}
}


function validarLogin(){

	formLogin = document.formEditLogin;
	var texto = "";
	var erro = 0;
        var email = 0;

        if(formLogin.senha.value == ""){
		erro = 1;
		texto = texto + "Preencha o campo senha<br/>";
		document.getElementById('senha').style.background = '#ffdfdf';
	}
     
        if(formLogin.confirmarSenha.value == ""){
		erro = 1;
		texto = texto + "Confirme a senha digitada<br/>";
		document.getElementById('confirmarSenha').style.background = '#ffdfdf';
	}
        
        
	
	if(erro == 1){
	    MM_effectAppearFade('erroEditLogin',1000,0,100, false);
		document.getElementById('erroEditLogin').innerHTML = texto;
		return false;
	}
}


