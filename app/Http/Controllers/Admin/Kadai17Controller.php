<?php


namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
use App\Kadai17;
use Carbon\Carbon;


class ProfileController extends Controller{
    
    protected $table = 'kadai17s';
    
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
        

        unset($profile_form['_token']);
        unset($profile_form['remove']);
        $profile->fill($profile_form)->save();

        // 以下を追記
        $kadai17 = new Kadai17;
        $kadai17->profile_id = $profile->id;
        $kadai17->edited_at = Carbon::now();
        $kadai17->save();

        return redirect('admin/profile/create');
    
}

}