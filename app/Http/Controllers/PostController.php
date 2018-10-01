<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $title  = $request->get('title');

        $Datos = Post::orderBy('id','DESC')
        ->where('title', 'LIKE', "%".$title."%")
        ->paginate(2);
        //return $post;
        
        return [
            'pagination' => [
                'total'         => $Datos->total(),
                'current_page'  => $Datos->currentPage(),
                'per_page'      => $Datos->perPage(),
                'last_page'     => $Datos->lastPage(),
                'from'          => $Datos->firstItem(),
                'to'            => $Datos->lastItem(),
            ],
            'Datos' => $Datos
        ];
        
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
            $post = new Post();
            $post->title = $request->title;
            if($request->get('image'))
            {
                $file = $request->get('image');
                $name = time().'.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
                \Image::make($request->get('image'))->save(public_path('images/').$name);              
                $post->image = $name;
            }

            $post->save();

           // return response()->json(['success' => 'You have successfully uploaded an image'], 200);      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
