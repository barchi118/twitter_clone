<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'screen_name',
        'name',
        'profile_image',
        'profile_introduct',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // パスワードのような属性を含めたくない場合があります。それにはモデルの$hiddenプロパティに定義を追加してください。

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // モデルの$castsプロパティは属性を一般的なデータタイプへキャストする便利な手法を提供します。$castsプロパティは配列で、キーにはキャストする属性名を指定し、値にはそのカラムに対してキャストしたいタイプを指定します。

    //リレーションの親子関係
    public function followers()
    {
        // 多対多リレーションはbelongsToManyメソッド呼び出しを記述することで定義します。
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        // followersと同じ
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    //引数で受け取ったログインしているユーザを除くユーザを1ページにつき5名取得しています
    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(10);
    }

      // フォローする
    public function follow(Int $user_id) 
    {
        // モデルを結びつけている中間テーブルにレコードを挿入することにより、ユーザーに役割を持たせるにはattachメソッドを使います。
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        // ユーザーから役割を削除する必要がある場合detachメソッド
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id) 
    {
        //フォローしているかをbooleanメソッドで真偽する
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id) 
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }

    public function updateProfile(Array $params)
    {
        if (isset($params['profile_image'])) {
            // 画像があったら
            $file_name = $params['profile_image']->store('public/profile_image/');
            // public/profile_image/に$params['profile_image']を保存
            $this::where('id', $this->id)
                ->update([
                    'screen_name'   => $params['screen_name'],
                    'name'          => $params['name'],
                    'profile_introduct'          => $params['profile_introduct'],
                    'profile_image' => basename($file_name),
                    'email'         => $params['email'],
                ]);
        } else {
            $this::where('id', $this->id)
                ->update([
                    'screen_name'   => $params['screen_name'],
                    'name'          => $params['name'],
                    'profile_introduct'        => $params['profile_introduct'],
                    'email'         => $params['email'],
                ]); 
        }

        return;
    }
}
