<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoInfo extends Model
{
    // primarykey設定
    protected $primaryKey = 'photo_id';
    // model名とテーブル名で紐付け
    // model : PhotoInfo , tableName : photoInfos
    protected $table = 'photoInfos';
    

    protected $fillable = [
        'photo_id',
        'shooting_location',
        'prefecture',
        'iso',
        'f_value',
        'shutter_speed',
        'time_zone',
        'is_tripod',
        'other',
    ];
    

    // ★Laravelでは「id」timestampsのカラム「create_at」「update_id」が標準で作成する仕組みがあるのでfalseにする
    // public $timestamps = false;
    
}
