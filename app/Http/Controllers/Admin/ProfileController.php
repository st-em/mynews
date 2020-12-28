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

use App\History;
use Carbon\Carbon;

/*class ProfileController extends Controller
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
*/


use App\Profile;
class ProfileController extends Controller{
    public function add()
  {
      return view('admin.profile.create');
  }
  
  public function create(Request $request)
  {
      // Varidationを行う
     $this->validate($request,Profile::$rules);
     $profile = new Profile;
     $form = $request->all();
      
      // フォームから画像が送信されてきたら、保存して、$profiles->image_path に画像のパスを保存する
     /* if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $profiles->image_path = basename($path);
      } else {
          $profiles->image_path = null;
      }
      */
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
       // データベースに保存する
      $profile->fill($form);
      $profile->save();
      
            return redirect('admin/profile/create');
  }

public function index(Request $request)

{
      $cond_name = $request->cond_name;
      if ($cond_name != '') {
          $posts = Profile::where('name', $cond_name)->get();
      } else {
          $posts =Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
  }



  public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $profile = Profile::find($request->id);

      return view('admin.profile.edit', ['profile_form' => $profile]);
  }


  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, profile::$rules);
      // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();
      unset($profile_form['_token']);

      // 該当するデータを上書きして保存する
      $profile->fill($profile_form)->save();

      return redirect('admin/profile/');
  }

  // 以下を追記　　
  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $profile = Profile::find($request->id);
      // 削除する
      $profile->delete();
      return redirect('admin/profile/');
  }  


}