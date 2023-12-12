'use strict'
class Movie {
    constructor(movie) {
        fetch('http://www.omdbapi.com/?apikey=4f4ef094&s=' + movie) 
        .then(res => res.json())
        .then(data => {
            console.log(data.Search);
            if(movie === 'joker') {
                Movie.createMovieBox(data.Search, '.joker-info-box');
            }
            else if(movie === 'batman') {
                Movie.createMovieBox(data.Search, '.batman-info-box');
            }
            else if(movie === 'superman') {
                Movie.createMovieBox(data.Search, '.superman-info-box');
            }
            else if(movie === 'spiderman') {
                Movie.createMovieBox(data.Search, '.spiderman-info-box');
            }
        })
        .catch(err => console.log('Something went wrong.'))
    }

    static createMovieBox(movies, box) {
        let output = '';
        for(let i = 0; i < movies.length; i++) {
            if(i === 5) {
                break;
            }
            else {
                output += `
                <div class="col">
                    <div class="card bg-dark" id="movie-card">
                        <img class="img-fluid movie-picture w-100" src="${movies[i].Poster}" style="height:15rem;">
                        <div class="card-body">
                            <h5>Title</h5>
                            <p class="movie-name bg-dark">${movies[i].Title}</p>
                            <h5>Released year:</h5>
                            <p class="year-title bg-dark">${movies[i].Year}</p>
                            <h5>Movie type:</h5>
                            <p class="movie-type bg-dark">${movies[i].Type}</p>
                            <a id="movie-details-form" onclick="Movie.movieSelected('${movies[i].imdbID}')" class="btn btn-primary")">Movie Details</a>
                        </div>
                    </div>
                </div>`;
                document.querySelector(box).innerHTML = output;
            }
        }
    }

    static movieSelected(id){
        sessionStorage.setItem('movieId', id);
        Movie.getMovie();
    }

    static getMovie() {
        let movieId = sessionStorage.getItem('movieId');

        fetch('http://www.omdbapi.com/?apikey=4f4ef094&i=' +movieId)
        .then(res => { return res.json() })
        .then(data => {
            console.log(data);
            let movie = data;

            let output = `
                <div class="row">
                <div class="col-md-4">
                <a href="http://imdb.com/title/${movie.imdbID}" target="_blank" class="btn btn-primary">View IMDB</a>
                <a href="http://localhost/MovieApp/pages/movies" class="btn btn-light">Go Back To Search</a>

                    <img src="${movie.Poster}" class="thumbnail">
                </div>
                <div class="col-md-8">
                    <h2>${movie.Title}</h2>
                    <ul class="list-group">
                        <li class="list-group-item bg-dark"><strong>Genre:</strong> ${movie.Genre}</li>
                        <li class="list-group-item bg-dark"><strong>Released:</strong> ${movie.Released}</li>
                        <li class="list-group-item bg-dark"><strong>Rated:</strong> ${movie.Rated}</li>
                        <li class="list-group-item bg-dark"><strong>IMDB Rating:</strong> ${movie.imdbRating}</li>
                        <li class="list-group-item bg-dark"><strong>Director:</strong> ${movie.Director}</li>
                        <li class="list-group-item bg-dark"><strong>Writer:</strong> ${movie.Writer}</li>
                        <li class="list-group-item bg-dark"><strong>Actors:</strong> ${movie.Actors}</li>
                    </ul>
                </div>
                </div>
                <div class="row">
                <div class="well">
                    <h3>Plot</h3>
                    ${movie.Plot}
                    <hr>
                </div>
                </div>
            `;

            document.getElementById('movie').innerHTML = output;
        })
    }

    static findMovie() {
        let searchField = document.getElementById('search-field').value;
        
        fetch('http://www.omdbapi.com/?apikey=4f4ef094&s=' + searchField)
        .then(res => { return res.json() })
        .then(data => {
            console.log(data);
            let movies = data.Search;

            Movie.searchAllMovies(movies);
        })
    }

    static searchAllMovies(movies) {
        let output = '';
        for(let i = 0; i < movies.length; i++) {
            if(i === 5) {
                break;
            }
            else {
                output += `
                <div class="col">
                    <div class="card bg-dark">
                        <img class="img-fluid movie-picture w-100" src="${movies[i].Poster}" style="height:15rem;">
                        <div class="card-body">
                            <h5>Title</h5>
                            <p class="movie-name bg-dark">${movies[i].Title}</p>
                            <h5>Released year:</h5>
                            <p class="year-title bg-dark">${movies[i].Year}</p>
                            <h5>Movie type:</h5>
                            <p class="movie-type bg-dark">${movies[i].Type}</p>
                            <a id="movie-details-form" onclick="Movie.movieSelected('${movies[i].imdbID}')" class="btn btn-primary")">Movie Details</a>
                        </div>
                    </div>
                </div>`;
                document.getElementById('movie-info-box').innerHTML = output;
            }
        }
    }
}

let joker = new Movie('joker');
let batman = new Movie('batman');
let superman = new Movie('superman');
let spiderman = new Movie('spiderman');