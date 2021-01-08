<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kadai17 extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'profile_id' => 'required',
        'edited_at' => 'required',
    );
    
    // 以下を追記
    // News Modelに関連付けを行う
    public function kadai17()
    {
      return $this->hasMany('App\Kadai17');
    }

}