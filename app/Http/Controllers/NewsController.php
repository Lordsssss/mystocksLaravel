<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class NewsController extends Controller
{
    public function index()
    {
        $client = new Client();
        $apiKey = env('NEWS_API_KEY'); // Get your API key from the .env file
        $response = $client->get("https://newsapi.org/v2/top-headlines?category=business&language=en&pageSize=10&apiKey={$apiKey}");

        $data = json_decode($response->getBody(), true);

        // Filter articles to only include those with images
        $filteredArticles = array_filter($data['articles'], function ($article) {
            return !empty($article['urlToImage']);
        });

        // Limit the number of articles to return to 6
        $filteredArticles = array_slice($filteredArticles, 0, 6);

        return view('news.index', ['news' => $filteredArticles]);
    }

    
}

