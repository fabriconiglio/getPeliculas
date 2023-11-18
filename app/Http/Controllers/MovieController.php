<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function fetchAndStoreMovies()
    {
        $client = new Client();

        // Obtener los géneros
        $genreResponse = $client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list?language=en', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('TMDB_TOKEN'),
                'accept' => 'application/json',
            ],
        ]);

        $genres = json_decode($genreResponse->getBody()->getContents(), true)['genres'];
        $genreMap = array_column($genres, 'name', 'id');

        // Obtener las películas
        $movieResponse = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('TMDB_TOKEN'),
                'accept' => 'application/json',
            ],
        ]);

        $moviesData = json_decode($movieResponse->getBody()->getContents(), true)['results'];

        foreach ($moviesData as $movieData) {
            $genreNames = array_map(function ($id) use ($genreMap) {
                return $genreMap[$id] ?? null;
            }, $movieData['genre_ids']);

            Movie::updateOrCreate(
                ['id' => $movieData['id']],
                [
                    'title' => $movieData['title'],
                    'year' => date('Y', strtotime($movieData['release_date'])),
                    'genre' => implode(', ', array_filter($genreNames)), // Usando nombres de géneros
                ]
            );
        }
    }


    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }


    public function create()
    {
        return view('movies.create', ['movie' => new Movie(), 'action' => route('movies.store'), 'method' => 'POST']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'year' => 'required|integer',
            'genre' => 'required|string',
        ]);

        Movie::create($request->all());

        return redirect()->route('movies.index');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'year' => 'required|integer',
            'genre' => 'required|string',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->update($request->all());

        return redirect()->route('movies.index'); // Asume que tienes una ruta para listar películas
    }


    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index'); // Asume que tienes una ruta para listar películas
    }


}
