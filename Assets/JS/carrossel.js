var imagens = [
    'https://i0.wp.com/www.cinematorio.com.br/wp-content/uploads/2019/05/sombrasdavida01.jpg?fit=1280%2C853&ssl=1', // Sombras da Vida
    'https://w.forfun.com/fetch/e3/e39c3cf76ce1d4bd0297c8485c8f22a5.jpeg?w=1470&r=0.5625', // Wall-E
    'https://wallpapers.com/images/featured/spirited-away-glulkohud4k8bubt.jpg', // A Viagem de Chihiro
    'https://ew.com/thmb/brjLvL1iElfhwWyFpz3UBLRYKdA=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/rexfeatures_1606014a-2000-83a25a1551f94acbb6fa56e554cd3af2.jpg', // Scream
    'https://m.media-amazon.com/images/M/MV5BNzFjOWQwZTYtN2U5Mi00ZjU0LTgxOTYtNzY5NjAxNWViOTRiXkEyXkFqcGdeQXRyYW5zY29kZS13b3JrZmxvdw@@._V1_.jpg' // A Voz Suprema do Blues
]
var indiceAtual = 0
var divBackground = document.getElementById("gifMain")

// Função para pré-carregar as imagens
function preCarregarImagens() {
    for (var i = 0; i < imagens.length; i++) {
        var img = new Image()
        img.src = imagens[i]
    }
}
// Função para alterar o background do id gifMain: utilizados em index e login
function alterarBackground() {
    divBackground.style.backgroundImage = "url('" + imagens[indiceAtual] + "')"
    indiceAtual = (indiceAtual + 1) % imagens.length
}

// Pré-carregar as imagens antes de iniciar a transição
preCarregarImagens()

// Alterar background automaticamente a cada 5 segundos
setInterval(alterarBackground, 5500)

// Definir a primeira imagem
alterarBackground()