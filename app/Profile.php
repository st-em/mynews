<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded = array('id');
    

    // 以下を追記
    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'introduction' => 'required',
        'hobby' => 'required',
    );
    
    // 以下を追記
    // News Modelに関連付けを行う
    public function records()
    {
      return $this->hasMany('App\Record');
    }
}