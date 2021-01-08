<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
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
    public function profiles()
    {
      return $this->hasMany('App\Profile');
    }
}