<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JanDrda\LaravelGoogleCustomSearchEngine\LaravelGoogleCustomSearchEngine;

use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function googleSearch(Request $request)
    {
        // dd($request->submitbtn);
        $searchWord = $request->search_word;
        $type = $request->submitbtn;
        $fulltext = new LaravelGoogleCustomSearchEngine(); 

        $fulltext->setEngineId('df9fd52aa066551cf'); 
        $fulltext->setApiKey('AIzaSyAMZMaJMNY-cmVs4fEH9QnMV_rRqtlLxW4');
        $results = $fulltext->getResults($searchWord);

        // dd($results);

        if($type == 'Search') {
            return view('home', compact('results', 'searchWord'));
        } else {
    
            $pdf = PDF::loadView('pdf', compact('results'));
            return $pdf->download('searchResult.pdf');
        }
    }

    // public function pdfview(Request $request)
    // {

    //     $searchWord = $request->search_word;

    //     $fulltext = new LaravelGoogleCustomSearchEngine(); // initialize

    //     $fulltext->setEngineId('df9fd52aa066551cf'); // sets the engine ID
    //     $fulltext->setApiKey('AIzaSyAMZMaJMNY-cmVs4fEH9QnMV_rRqtlLxW4');
    //     $results = $fulltext->getResults($searchWord);

    //     $pdf = PDF::loadView('home', compact('results', 'searchWord'));
    //     return $pdf->download('searchResult.pdf');
    // }
}
