document.addEventListener('DOMContentLoaded', function() {
    loadFavoriteMovies();
});

async function loadFavoriteMovies() {
    try {
        const response = await fetch('getFavoriteMovies.php');
        const data = await response.json();
        displayFavoriteMovies(data);
    } catch (error) {
        console.error('Erro ao carregar filmes favoritos:', error);
    }
}

function displayFavoriteMovies(movies) {
    const favoriteMoviesContainer = document.getElementById('favoriteMovies');
    favoriteMoviesContainer.innerHTML = '';

    if (movies.length === 0) {
        favoriteMoviesContainer.innerHTML = '<p>Nenhum filme favorito encontrado.</p>';
        return;
    }

    movies.forEach(movie => {
        const movieElement = document.createElement('div');
        movieElement.classList.add('movie');
        movieElement.innerHTML = `
            <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" alt="${movie.title} poster">
            <h2>${movie.title}</h2>
            <p>Gêneros: ${movie.genres}</p>
            <button onclick="removeFavoriteMovie(${movie.movie_id}, this)">Remover Filme</button>
        `;
        favoriteMoviesContainer.appendChild(movieElement);
    });
}

async function removeFavoriteMovie(movieId, buttonElement) {
    try {
        const response = await fetch('removeFavoriteMovie.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ movieId: movieId })
        });

        const result = await response.json();

        if (response.ok && result.status === 'success') {
            const movieElement = buttonElement.parentElement;
            movieElement.remove();
        } else {
            console.error('Erro ao remover o filme:', result.message);
        }
    } catch (error) {
        console.error('Erro ao remover o filme:', error);
    }
}