document.getElementById('formMudarSenha').addEventListener('submit', async function(event) {
    event.preventDefault();

    const senhaAtual = document.getElementById('senhaAtual').value;
    const novaSenha = document.getElementById('novaSenha').value;
    const confirmarNovaSenha = document.getElementById('confirmarNovaSenha').value;
    const mensagem = document.getElementById('mensagem');

    if (novaSenha !== confirmarNovaSenha) {
        mensagem.textContent = 'A nova senha e a confirmação não coincidem.';
        return;
    }

    console.log('Dados para enviar:', { senhaAtual, novaSenha });

    try {
        const response = await fetch('mudarSenha.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ senhaAtual, novaSenha })
        });

        const result = await response.json();
        mensagem.textContent = result.message;

        console.log('Resposta do servidor:', result);
        
    } catch (error) {
        mensagem.textContent = 'Erro ao tentar mudar a senha.';
        console.error('Erro:', error);
    }
});