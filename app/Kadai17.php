<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kadai17 extends Model
{
    // protected $guarded = 'kadai17s';
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'introduction' => 'required',
        'hobby' => 'required',
    );
    
   /* // 以下を追記
    // News Modelに関連付けを行う
    public function kadai17s()
    {
      return $this->hasMany('App\Kadai17');
    }
*/
}