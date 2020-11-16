<?php 
namespace Templates;

class Modal {
	
	public static function padrao() {
		$html = "
			<div id='bg-modal' class='bg-modal'>
				<div class='modal'>
					<div id='cabecalho' class='cabecalho-sucesso'></div>
					<div id='body' class='body'></div>
					<div class='footer'>
						<button id='fechar' class='button'>Fechar</button>
					</div>
				</div>
			</div>
		";
		echo $html;
	}
	
} ?>