<?php

namespace App\Models;
use App\Models\Follower;


use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $primaryKey = [
        'following_id',
        'followed_id'
    ];
    protected $fillable = [
        'following_id',
        'followed_id'
    ];
    // protectedのprimaryKeyプロパティを定義してください。
    // オブジェクト指向プログラミングにおいてオーバーライド (override) とは、スーパークラスで定義されたメソッドをサブクラスで定義し直し、動作を上書き（変更）することである
    public $timestamps = false;
    // $timestampsの更新をオフにする
    public $incrementing = false;
    // 自動増分ではない、もしくは整数値ではない主キーを使う場合、モデルにpublicの$incrementingプロパティを用意し、falseをセット

    public function getFollowCount($user_id)
    {
        return $this->where('following_id', $user_id)->count();
        // $user_idと同じfollowing_idを数える
    }

    public function getFollowerCount($user_id)
    {
        return $this->where('followed_id', $user_id)->count();
        // $user_idと同じfollowed_idを数える
    }

    // フォローしているユーザのIDを取得
    public function followingIds(Int $user_id)
    {
        return $this->where('following_id', $user_id)->get('followed_id');
        //  $user_idと同じfollowing_idのfollowed_idを取得する
    }
}
