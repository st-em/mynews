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

// use App\Profile;

use App\Profile;
use App\Kadai17;
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


// use App\Profile2;
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
      
     
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
       // データベースに保存する
      $profile->fill($form);
      $profile->save();
      
            return redirect('admin/profile/create');
  }

/*public function index(Request $request)

{
      $cond_name = $request->cond_name;
      if ($cond_name != '') {
          $posts = Profile::where('name', $cond_name)->get();
      } else {
          $posts =Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
  }

*/

  public function edit(Request $request)
  {
      // profile Modelからデータを取得する
      $profile = Profile::find($request->id);

      return view('admin.profile.edit', ['profile_form' => $profile]);
  }


   public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = Profile::find($request->id);
        $profile_form = $request->all();
        /*if ($request->remove == 'true') {
            $profile_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $profile_form['image_path'] = basename($path);
        } else {
            $profile_form['image_path'] = $profile->image_path;*/
        // }

        unset($profile_form['_token']);
        // unset($profile_form['image']);
        unset($profile_form['remove']);
        $profile->fill($profile_form)->save();

        // 以下を追記
        $kadai17 = new Kadai17;
        $kadai17->id = $profile->id;
        $kadai17->edited_at = Carbon::now();
        $kadai17->save();

        return redirect('admin/profile/create');
    
}

}