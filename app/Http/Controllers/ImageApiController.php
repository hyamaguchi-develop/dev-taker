<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class ImageApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $image = Image::all();
        

        return response()->json(['image' => $image]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $image = new Image();
        // $image->fill($request->all())->save();
        if (request()->image_path) {
            $file_name = time() . '.' . request()->image_path->getClientOriginalName();
            request()->image_path->storeAs('public/storage', $file_name);

            $image = new Image();
            $image->image_path = 'storage/' . $file_name;
            $image->image_title = $request->image_title;
            $image->save();

            return ['success' => '登録しました!'];
        }
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
