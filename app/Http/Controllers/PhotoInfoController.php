<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// javaで言うimport
use App\PhotoInfo;
class PhotoInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
    --photoInfosの一覧表示
    return json形式のphotoInfosテーブルのデータ

    この変数$photoInfosをview側でjson形式でresponseする
    */
    public function index()
    {
        $photoInfo = PhotoInfo::all();

        return response()->json(['photoInfo' => $photoInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     *  登録処理
     */
    public function store(Request $request)
    {
        /*
            バリデーション処理記述箇所
        */

        /*
        PHPでの標準的は登録処理はこのようにフォームの値をrequestから各項目から1つずつデータを受け取って処理
        ★editedItemの値をテーブルに押し込む処理
        */
        $photoInfo = new PhotoInfo();
        $photoInfo->fill($request->all())->save();


        // 【参考】modelでfillableを使用することで簡潔に処理ができた
        // $photoInfo->photo_id = $request->input('photo_id');
        // $photoInfo->shooting_location = $request->input('shooting_location');
        // $photoInfo->prefecture = $request->input('prefecture');
        // $photoInfo->iso = $request->input('iso');
        // $photoInfo->f_value = $request->input('f_value');
        // $photoInfo->shutter_speed = $request->input('shutter_speed');
        // $photoInfo->time_zone = $request->input('time_zone');
        // $photoInfo->is_tripod = $request->input('is_tripod');
        // $photoInfo->other = $request->input('other');
        // $photoInfo->save();

        return $photoInfo;
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
    public function destroy(PhotoInfo $photoInfo)
    {
        $photoInfo->delete();
        return $photoInfo;
    }
}
