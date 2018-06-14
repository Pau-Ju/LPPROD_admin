<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Favorite;
use App\Note;
use App\Posting;
use App\Serie;
use App\Keyword;
use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;

class SerieController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $series = Serie::getSeriesHome();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 12;

        $path=LengthAwarePaginator::resolveCurrentPath();

        $series = new LengthAwarePaginator(array_slice($series, $perPage * ($currentPage - 1), $perPage), count($series), $perPage, $currentPage,['path'=>$path]);

        return view('home', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('serie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        request()->validate([
            'name' => 'required',
            'release_date' => 'required',
            'author' => 'required',
            'synopsis' => 'required'
        ]);
        $uploaddiradm = public_path("images/");
        $uploaddirpublic = '/srv/http/netflux/public/images/';

        $serie = new Serie();
        $serie->name = $request->name;
        $serie->author = $request->author;
        $serie->release_date = $request->release_date;
        $serie->synopsis = $request->synopsis;

       if($request->hasFile('image')) {
           $file = $request->file('image');
           $name = str_replace(' ', '_', strtolower($request->name)).".".$file->getClientOriginalExtension();
           $dest = $uploaddiradm ;
           $request->file('image')->move($dest, $name);

            copy($dest.$name, $uploaddirpublic.$name);
           $serie->image_link = '/images/' . $name;
       }
        $serie->save();


        $this->setIDF();

        return redirect()->route('home')

            ->with('success','Série crée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $serie = Serie::find($id);

        return view('serie.show',compact('serie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serie = Serie::find($id);
        return view('serie.edit',compact('serie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'release_date' => 'required',
            'author' => 'required',
            'synopsis' => 'required'
        ]);
        $dest = public_path("images/");
        $uploaddirpublic = '/srv/http/netflux/public/images/';


        Serie::find($id)->update($request->all());

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = str_replace(' ', '_', strtolower($request->name)).".".$file->getClientOriginalExtension();

            $request->file('image')->move($dest, $name);
            copy($dest.$name, $uploaddirpublic.$name);
            $image_link = '/images/' . $name;


            Serie::find($id)->update(['name'=>$request->name,
                'release_date'=>$request->release_date,
                'author'=>$request->author,
                'synopsis'=>$request->synopsis,
                'image_link'=>$image_link]);

        }else{
            Serie::find($id)->update(['name'=>$request->name,
                                        'release_date'=>$request->release_date,
                                        'author'=>$request->author,
                                        'synopsis'=>$request->synopsis
                                        ]);
        }


        $this->setIDF();

        return redirect()->route('home')
            ->with('success','Série mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Comment::where('id_Comment_Serie',$id)->count()>0){
            Comment::where('id_Comment_Serie',$id)->delete() ;
        }
        if( Note::where('id_Notes_Serie',$id)->count()>0){
            Note::where('id_Notes_Serie',$id)->delete();
        }
        if(Favorite::where('id_Favorite_Serie',$id)->count()>0){
            Favorite::where('id_Favorite_Serie',$id)->delete();
        }

        if(Posting::where('id_Post_Serie',$id)->count()>0){
           Posting::where('id_Post_Serie',$id)->delete();
        }

        Serie::find($id)->delete();

        return redirect()->route('home')
            ->with('success','Série supprimée avec succès');
    }



    public function setIDF(){
        $nbTotal = Serie::count();
        $keywords = Keyword::get();

        foreach ($keywords as $keyword){
            $nbConcerned = Posting::where('id_Post_Keyword',$keyword->id_Word)->distinct()->count();

            if($nbConcerned!=0){
                $division = $nbTotal/$nbConcerned;
                $idf = log($division);
            }else{
                $idf = 0;
            }
            Keyword::where('id_Word', $keyword->id_Word)->update(['idf'=>$idf]);
        }
    }
}
