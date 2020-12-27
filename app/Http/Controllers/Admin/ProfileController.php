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

use App\Profiles;
class ProfileController extends Controller{
    public function add()
  {
      return view('admin.profiles.create');
  }
  public function create(Request $request)
  {
​
      // 以下を追記
      // Varidationを行
      
      $this->validate($request, Profiles::$rules);
      
      $news = new News;
      $form = $request->all();
      
      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $news->image_path = basename($path);
      } else {
          $news->image_path = null;
      }
​
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
​
      // データベースに保存する
      $news->fill($form);
      $news->save();
​
      return redirect('admin/news/create');
  }
}
