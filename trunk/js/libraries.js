/**
 * Funcao que pega o posicionamento de um elemento
 */
function getPosicaoElemento(elemID){
	var offsetTrail = document.getElementById(elemID);
	var offsetLeft = 0;
	var offsetTop = 0;
	while (offsetTrail) {
		offsetLeft += offsetTrail.offsetLeft;
		offsetTop += offsetTrail.offsetTop;
		offsetTrail = offsetTrail.offsetParent;
	}
	if (navigator.userAgent.indexOf("Mac") != -1 && 
		typeof document.body.leftMargin != "undefined") {
		offsetLeft += document.body.leftMargin;
		offsetTop += document.body.topMargin;
	}
	return {left:offsetLeft, top:offsetTop};
}
/**
 * Funcao que substitui \n por <br>
 */
function htmlEntities(string) {
    while(string.indexOf("\n") > 0){
		string = string.replace("\n","<br />");
	}
	return string;
}
/** 
 * Verifica se os cookies do navegador do usuario estao habilitados
 * Author: Daniel Reis
 */
function cookiesHabilitados(){
	var tmpcookie = new Date();
	chkcookie = (tmpcookie.getTime() + '');
   	document.cookie = "chkcookie=" + chkcookie + "; path=/";
	if (document.cookie.indexOf(chkcookie,0) < 0) {
  		return false;
  	}
  	return true;
}

/**
 * Nao deixa inserir mais que "maxlimit" caracteres no textarea
 * Author: Daniel Machado Reis 
 */
function textCounter(field, maxlimit) {
    if (field.value.length > maxlimit)
        field.value = field.value.substring(0, maxlimit);
}

/**
 * Abrir modal 
 */
function abrirLogin(){
	$(function() {
	    $( "#dialog-message" ).show();
	    $( "#dialog-message" ).dialog({
		modal: true,
		width:'600',
		height:'255',
		resizable:'false'
	    });
	});
}


/**
 * Codigo que "cria" o atributo maxlength para textareas :)
 */
$("textarea[maxlength]").keypress(function(event){
    var key = event.which;
 
    //todas as teclas incluindo enter
    if(key >= 33 || key == 13) {
        var maxLength = $(this).attr("maxlength");
        var length = this.value.length;
        if(length >= maxLength) {
            event.preventDefault();
        }
    }
});

/**
 * Funaco de espera em javascript
 * @param int milliseconds
 */
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

/**
 * Funcao que pega a letra digitada (usando evento)
 * 
 * @param evt event
 * @return charStr varchar
 */
function getKeyPressed(evt){
    evt = evt || window.event;
    var charCode = evt.keyCode || evt.which;
    var charStr = String.fromCharCode(charCode);
    return charStr;
};

/*
 * Retorna o radiobutton selecionado para o tipo
 * @param: nome da classe utilizada nas opcoes do radiobutton
 * Author: Daniel Machado Reis 
 */
function getRadioValue(classeUtilizada) {
    var radVal = ($("."+ classeUtilizada +":checked").val());
    return radVal;
}

/*
 * Nao deixa inserir mais que "maxlimit" caracteres no textarea
 *
 * Author: Daniel Machado Reis 
 */
function textCounter(field, maxlimit) {
    if (field.value.length > maxlimit)
        field.value = field.value.substring(0, maxlimit);
}

/* Verifica se uma string eh um e-mail */
function isEmail(email){
	var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
	var check=/@[\w\-]+\./;
	var checkend=/\.[a-zA-Z]{2,3}$/;
	if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}
	else {return true;}
}

/*
 * Verifica se um elemento existe no array
 * @param: elemento a ser procurado
 * @param: array em que o elemento sera procurado
 * 
 * Author: Daniel Machado Reis 
 */
Array.prototype.has = function(value) {
    for (var i = 0, loopCnt = this.length; i < loopCnt; i++) {
        if (this[i] == value) {
            return true;
        }
    }
    return false;
};

//valida numero inteiro com mascara
function mascaraInteiro(){
	code = event.keyCode;
	if(code == 8 || code == 35 || code == 36 || code == 37 || code == 38 || code == 39 || code == 40 || code == 45 || code == 46) return true;
    if (event.keyCode < 48 || event.keyCode > 57){
        event.returnValue = false;
        return false;
    }
    return true;
}

function isset (a) {
	if(typeof a == "undefined")
		return false;
	else
		return true;
}

/* 
 * Deixa o valor padrao "busca" no campo e o remove no evento focus
 * Author: Daniel Machado Reis
 */
function inputValorPre(campo, exibirTexto, texto){
	//Conteudo do campo
	var valorAtual = campo.value;
	//Se for onblur:
	if(exibirTexto && valorAtual == '') campo.value = texto;
	//onFocus
	if(!exibirTexto && valorAtual == texto) campo.value = "";
}

//Mascara de data em um input
function mascaraData(campo){
    var valor = campo.value;
    if((valor.length == 2) || (valor.length == 5)) campo.value = valor + '/';
}

//adiciona mascara ao telefone
function MascaraTelefone(tel){  
    if(mascaraInteiro(tel)==false){
            event.returnValue = false;
    }       
    return formataCampo(tel, '(00) 0000-0000', event);
}

function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if(whichCode == 13 || whichCode == 8 || whichCode == 0) return true;
    key = String.fromCharCode(whichCode); // Valor para o c�digo da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inv�lida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}

function isMoeda(pVal) {
	var reMoeda = /^\d{1,10}(\,\d{3})*\.\d{2}$/;
	return reMoeda.test(pVal);
}

function isInteiro(pVal) {
	var reDigits = /^\d+$/;
	return reDigits.test(pVal);
}

function isEmail(email){
	var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
	var check=/@[\w\-]+\./;
	var checkend=/\.[a-zA-Z]{2,3}$/;
	if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}
	else {return true;}
}

//valida telefone
function isTelefone(tel){
    exp = /\(\d{2}\)\ \d{4}\-\d{4}/;
    if(!exp.test(tel.value))
        return false;
    return true;
}

function isData(pVal) {
	var reData = /^((0[1-9]|[12]\d)\/(0[1-9]|1[0-2])|30\/(0[13-9]|1[0-2])|31\/(0[13578]|1[02]))\/\d{4}$/;
	return reData.test(pVal);
}