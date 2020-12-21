<?php

/*「http://XXXXXX.jp/XXX というアクセスが来たときに、 AAAControllerのbbbというAction に渡すRoutingの設定」を書いてみてください。

Route::group(['prefix'=>'XXX'], function(){
	Route::get('XXX', 'AAAController@bbb');
});


Route::get('XXX', 'AAAController@bbb');

*/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //
     public function add()
    {
        return view('admin.profile.create');
    }

    public function create()
    {
        return redirect('admin/profile/create');
    }

    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update()
    {
        return redirect('admin/profile/edit');
    }
    
    
}
