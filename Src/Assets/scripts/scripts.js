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
	if (modal) {
		modal.style.display = acao;
		let cabecalho = document.getElementById('cabecalho');
		cabecalho.setAttribute('class', estilo);
		cabecalho.innerHTML = titulo[estilo];
		document.getElementById('body').innerHTML = mensagem;
		document.getElementById('fechar').onclick = function() {
			modal.style.display = 'none';
		}
	}
}

function clearInput(identificador, value) {
	document.getElementById(identificador).value = value;
}

function clearChecked(identificador) {
	document.getElementsByName(identificador).checked = false;
}

function resourcesList() {
	let itens = [];
	let checks = document.getElementsByName('item-check');
	for(let i=0; i < checks.length; i++) {
		checks[i].checked && itens.push(checks[i].value);
	}
	return itens;
}

function saveEndpoint() {
	let endpoint = document.getElementById("salvarEndpoint");
	if (endpoint) {
		endpoint.onclick = function() {
			let titulo = document.getElementById("titulo").value;
			let endpoint = document.getElementById("endpoint").value;
			let status = document.getElementById("status").value;
			let identificador = document.getElementById("identificador").value;
			let servidor = document.getElementById("servidor").value;
			let uri = document.getElementById("uri").value;
			let resources = resourcesList();

			if (titulo == '' || endpoint == '' || resources.length <= 0) {
				modal('flex', 'Os campos marcados com (*), são obrigatórios', 'cabecalho-erro');
			} else {
				let ajax = new XMLHttpRequest();
				ajax.open("POST", servidor + uri, true);
				ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				ajax.send(
					"titulo=" + titulo +
					"&endpoint=" + endpoint +
					"&status=" + status + 
					"&identificador=" + identificador +
					"&resources=" + resources
				);
				
				ajax.onreadystatechange = function() {
					if (ajax.status == 200) {
						if (identificador == '0') {
							clearInput('titulo', '');
							clearInput('endpoint', '');
							clearInput('status', '1');
							clearChecked('item-check');
						}
						modal('flex', 'Os dados foram salvos com sucesso', 'cabecalho-sucesso');
						redirectToPage("fechar", "edition_endpoints", "home_endpoints");
					} else {
						modal('flex', 'Ocorreu um erro e não possível salvar', 'cabecalho-erro');
					}
				}
			}
		}
		redirectToPage("cancelarEndpoint", "edition_endpoints", "home_endpoints");
	}
}

function saveToken() {
	let token = document.getElementById('salvarToken');
	if (token) {
		document.getElementById('salvarToken').onclick = function () {
			let titulo = document.getElementById("titulo").value;
			let status = document.getElementById("status").value;
			let identificador = document.getElementById("identificador").value;
			let servidor = document.getElementById("servidor").value;
			let uri = document.getElementById("uri").value;

			if (titulo == '') {
				modal('flex', 'Os campos marcados com (*), são obrigatórios', 'cabecalho-erro');
			} else {
				let ajax = new XMLHttpRequest();
				ajax.open("POST", servidor + uri, true);
				ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				ajax.send(
					"titulo=" + titulo +
					"&status=" + status +
					"&identificador=" + identificador
				);
				
				ajax.onreadystatechange = function() {
					if (ajax.status == 200) {
						if (identificador == '0') {
							clearInput('titulo', '');
							clearInput('status', '1');
						}
						modal('flex', 'Os dados foram salvos com sucesso', 'cabecalho-sucesso');
						redirectToPage("fechar", "edition_tokens", "home_tokens");
					} else {
						modal('flex', 'Ocorreu um erro e não possível salvar', 'cabecalho-erro');
					}
				}
			}
		}
		redirectToPage("cancelarToken", "edition_tokens", "home_tokens");
	}
}

function redirectToPage(identificador, pagina_atual, redirecionamento) {
	document.getElementById(identificador).onclick = function() {
		let servidor = document.getElementById("servidor").value;
		let uri = document.getElementById("uri").value;
		let url_atual = servidor + uri;
		let url_nova = changeTerm(url_atual, pagina_atual, redirecionamento);
		redirect(url_nova);
	}
}

window.onload = function() {
	modal();
	saveEndpoint();
	saveToken();
}