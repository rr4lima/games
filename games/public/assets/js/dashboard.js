
document.getElementById("formNoticia").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("criarNoticia.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.text())
        .then(data => {

            alert("Notícia criada!");


            document.getElementById("formNoticia").reset();


            carregarNoticias();
        });
});


function carregarNoticias() {
    fetch("listarNoticias.php")
    .then(res => res.text())
    .then(html => {
        document.getElementById("listaNoticias").innerHTML = html;
    });
}

