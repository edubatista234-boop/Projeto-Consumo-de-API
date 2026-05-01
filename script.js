async function buscarDados() {
    const raca = document.getElementById("raca").value.trim();
    const resultado = document.getElementById("resultado");

    resultado.innerHTML = `
        <div class="loading">
            <div class="spinner"></div>
            <p>Carregando...</p>
        </div>
    `;

    try {
        let url = "api.php";

        if (raca !== "") {
            url += "?raca=" + raca;
        }

        const resposta = await fetch(url);
        const dados = await resposta.json();

        if (dados.success) {
            resultado.innerHTML = `
                <div class="card">
                    <h2>${dados.raca}</h2>
                    <img src="${dados.imagem}">
                    <p><strong>URL:</strong> ${dados.url}</p>
                </div>
            `;
        } else {
            resultado.innerHTML = `<p>${dados.mensagem}</p>`;
        }

    } catch (erro) {
        resultado.innerHTML = "<p>Erro ao conectar com o servidor.</p>";
    }
}