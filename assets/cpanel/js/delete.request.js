// No carregamento da página
$(document).ready(function() {
	// Atribui ao evento clique do botão delete
	$('.async').click(function(event) {
		// Cancela o funcionamento padrão
		event.preventDefault();

		// Confirmação de exclusão
		if ( ! confirm("Tem certeza?")) {
			return false;
		}

		// Pega o item para facilitar as chamadas
		var item = $(this);

		// Pega a url para fazer a requisição
		var url = item.attr('href');

		// Pega o id para enviar a requisição
		var id = item.data('identity');

		// Faz a requisição
		var posting = $.post(url,{id:id});

		// Trata o retorno
		posting.done(function(data) {
			if (data == true) {
				item.closest('tr').fadeTo('slow', 0.33);
			}
			else {
				// tratamento do erro
			}
		});

		// Cancela o redirecionamento
		return false;
	});
});