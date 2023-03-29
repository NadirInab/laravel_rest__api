<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::with(["collection", "genre"])->get() ;
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            "title" => "required",
            "author" => "required",
            "isbn" => "required",
            "NP" => "required",
            "status" => "required",
            "publish_date" => "required",
            "genre_id" => "required",
            "collection_id" => "required",
        ]) ;

        $book = Book::create($request->all()) ;
        return response()->json([
            'success' => 'Book has been well added',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        return Book::find($id) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required",
            "author" => "required",
            "isbn" => "required",
            "NP" => "required",
            "status" => "required",
            "publish_date" => "required",
            "genre_id" => "required",
            "collection_id" => "required",
        ]) ;

        $book = Book::find($id) ;
        $book->update($request->all()) ;
        return response()->json([
            'success' => 'Book has been well updated',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::destroy($id) ;
        return response()->json([
            'success' => 'Book has been well deleted',
        ], 201);
    }

    /**
     * Search  by title the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function search($title)
    {
        $book = Book::where("title", "LIKE", "%$title%")->get() ;
        return $book ;
    }
    /**
     * Search the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function searchAuthor($author)
    {
        $book = Book::where("author", "LIKE", "%$author%")->get() ;
        return $book ;
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
        public function filter(Request $request){
            // $book = Book::with(['genre']);
            
            // if ($request->genre) {
            //     $book->whereHas('genre', function($book) use($request){
            //         $book->where('name', 'LIKE',"%$request->name%");
            //     });
            // }
        
            // $Tbook = $book->get();
            return response()->json([
                'data'=>$request,
            ], 200);
        }
    }
