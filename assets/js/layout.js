const data = document.getElementById("datetime");

function atualizarRelogio() {

    const agora = new Date();

    data.innerHTML = agora.toLocaleString("pt-BR");

}

setInterval(atualizarRelogio, 1000);

atualizarRelogio();

const menu = document.getElementById("sidebar");

const botao = document.getElementById("menu-toggle");

botao.addEventListener("click", () => {

    menu.classList.toggle("mini");

});