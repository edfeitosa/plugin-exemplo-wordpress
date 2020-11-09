<?php 
namespace Templates;

class Modal {
	
	public static function padrao() {
		$html = "
			<div id='bg-modal' class='bg-modal'>
				<div class='modal'>
					<div id='cabecalho' class='cabecalho-sucesso'>
						Sucesso
					</div>
					<div id='body' class='body'>Aqui fica a mensagem</div>
					<div class='footer'>
						<button id='button-modal' class='button'>Fechar</button>
					</div>
				</div>
			</div>
		";
		echo $html;
	}
	
} ?>