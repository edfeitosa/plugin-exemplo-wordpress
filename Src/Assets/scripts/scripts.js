"use strict";

function redirecionamento(url) {
	window.location.href = url;
}

function substituirTermo(texto, termo_antigo, termo_novo) {
	return texto.replace(termo_antigo, termo_novo);
}

function modal(acao) {
	let bgModal = document.getElementById('bg-modal');
	bgModal.style.display = acao;
}

function salvaEdicao() {
	document.getElementById("salvarEdicao").onclick = function() {
		let titulo = document.getElementById("titulo").value;
		let url = document.getElementById("url").value;
		let status = document.getElementById("status").value;
		let identificador = document.getElementById("identificador").value;
		let servidor = document.getElementById("servidor").value;
		let uri = document.getElementById("uri").value;
		let ajax = new XMLHttpRequest();
		ajax.open("POST", servidor + uri, true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("titulo=" + titulo + "&url=" + url + "&status=" + status + "&identificador=" + identificador);
		if (ajax.status == 200) {
			modal('flex');
		} else {
			modal('flex');
		}
	}
}

function voltaParaConsulta() {
	document.getElementById("cancelarEdicao").onclick = function() {
		let servidor = document.getElementById("servidor").value;
		let uri = document.getElementById("uri").value;
		let url_atual = servidor + uri;
		let url_nova = substituirTermo(url_atual, "editar", "consultar");
		redirecionamento(url_nova);
	}
}

window.onload = function() {
	modal('none');
	salvaEdicao();
	voltaParaConsulta();
}