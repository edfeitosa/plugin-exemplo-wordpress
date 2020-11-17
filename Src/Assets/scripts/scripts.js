"use strict";

function redirect(url) {
	window.location.href = url;
}

function changeTerm(texto, termo_antigo, termo_novo) {
	return texto.replace(termo_antigo, termo_novo);
}

function modal(acao = 'none', mensagem = 'mensagem do modal', estilo = 'cabecalho-sucesso') {
	let titulo = {
		'cabecalho-sucesso': 'Sucesso',
		'cabecalho-erro': 'Erro',
		'cabecalho-alerta': 'Alerta'
	}

	let modal = document.getElementById('bg-modal');
	modal.style.display = acao;
	let cabecalho = document.getElementById('cabecalho');
	cabecalho.setAttribute('class', estilo);
	cabecalho.innerHTML = titulo[estilo];
	document.getElementById('body').innerHTML = mensagem;
	document.getElementById('fechar').onclick = function() {
		modal.style.display = 'none';
	}
}

function clearInput(identificador) {
	document.getElementById(identificador).value = '';
}

function salveEdition() {
	document.getElementById("salvarEdicao").onclick = function() {
		let titulo = document.getElementById("titulo").value;
		let url = document.getElementById("url").value;
		let status = document.getElementById("status").value;
		let identificador = document.getElementById("identificador").value;
		let servidor = document.getElementById("servidor").value;
		let uri = document.getElementById("uri").value;

		if (titulo == '' || url == '') {
			modal('flex', 'Os campos marcados com (*), são obrigatórios', 'cabecalho-erro');
		} else {
			let ajax = new XMLHttpRequest();
			ajax.open("POST", servidor + uri, true);
			ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajax.send("titulo=" + titulo.value + "&url=" + url.value + "&status=" + status.value + "&identificador=" + identificador);
			
			ajax.onreadystatechange = function() {
				if (ajax.status == 200) {
					if (identificador == '0') {
						;
						url.value = '';
						status.value = '1';
					}
					modal('flex', 'Os dados foram salvos com sucesso', 'cabecalho-sucesso');
					backToConsultation('fechar');
				} else {
					modal('flex', 'Ocorreu um erro e não possível salvar', 'cabecalho-erro');
				}
			}
		}
	}
}

function backToConsultation(identificador) {
	document.getElementById(identificador).onclick = function() {
		let servidor = document.getElementById("servidor").value;
		let uri = document.getElementById("uri").value;
		let url_atual = servidor + uri;
		let url_nova = changeTerm(url_atual, "editar", "consultar");
		redirect(url_nova);
	}
}

window.onload = function() {
	modal();
	salveEdition();
	backToConsultation('cancelarEdicao');
}