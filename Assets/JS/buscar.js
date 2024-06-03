document.getElementById('searchButton').addEventListener('click', function() {
    const query = document.getElementById('searchInput').value;
    if (query) {
        searchMovies(query);
    }
});

async function searchMovies(query) {
    const apiKey = '3e7c136fdafbdffed510fb7d49ec111a';
    const url = `https://api.themoviedb.org/3/search/movie?api_key=${apiKey}&query=${query}&language=pt-BR`;

    try {
        const response = await fetch(url);
        const data = await response.json();
        displayResults(data.results);
    } catch (error) {
        console.error('Erro ao buscar filmes:', error);
    }
}

async function fetchMovieDetails(movieId) {
    const apiKey = '3e7c136fdafbdffed510fb7d49ec111a';
    const url = `https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}&language=pt-BR`;

    try {
        const response = await fetch(url);
        return await response.json();
    } catch (error) {
        console.error('Erro ao buscar detalhes do filme:', error);
        return null;
    }
}

function displayResults(movies) {
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = '';

    if (movies.length === 0) {
        resultsContainer.innerHTML = '<p>Nenhum filme encontrado.</p>';
        return;
    }

    movies.forEach(async (movie) => {
        const details = await fetchMovieDetails(movie.id);
        if (!details) return;

        const genres = details.genres.map(genre => genre.name).join(', ');

        const movieElement = document.createElement('div');
        movieElement.classList.add('movie');
        const title = encodeURIComponent(movie.title);
        const genresEncoded = encodeURIComponent(genres);
        const posterPath = encodeURIComponent(movie.poster_path);

        movieElement.innerHTML = `
            <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" alt="${movie.title} poster">
            <h2>${movie.title}</h2>
            <p>Gêneros: ${genres}</p>
            <button onclick="addToFavorites(${movie.id}, '${title}', '${genresEncoded}', '${posterPath}')">Adicionar aos Favoritos</button>
        `;
        resultsContainer.appendChild(movieElement);
    });
}

async function getUserId() {
    const response = await fetch('getUserId.php');
    const data = await response.json();

    if (data.success) {
        return data.userId;
    } else {
        console.error(data.message);
        return null;
    }
}

async function addToFavorites(movieId, title, genres, posterPath) {
    // Faz uma solicitação AJAX para obter o ID do usuário autenticado
    const userId = await getUserId();
    const url = 'addFavorite.php';
    const data = {
        userId, 
        movieId, 
        title: decodeURIComponent(title), 
        genres: decodeURIComponent(genres), 
        posterPath: decodeURIComponent(posterPath) 
    };

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        const result = await response.json();
        if (result.success) {
            console.log('Filme adicionado aos favoritos!');
        } else {
            console.log('Erro ao adicionar filme aos favoritos.');
        }
    } catch (error) {
        console.error('Erro ao adicionar filme aos favoritos:', error);
    }
}