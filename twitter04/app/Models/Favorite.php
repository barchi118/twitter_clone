<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Favorite extends Model
{
    public $timestamps = false;

    // いいねしているかどうかの判定処理
    public function isFavorite(Int $user_id, Int $tweet_id) 
    {
        //boolean は、真偽の値を表します。 この値は、TRUE または FALSE のどちらかになります
        return (boolean) $this->where('user_id', $user_id)->where('tweet_id', $tweet_id)->first();
        //Favoriteモデルの中からuser_idとtweet_idが一致するかを真偽値で返す。
    }

    public function storeFavorite(Int $user_id, Int $tweet_id)
    {
        $this->user_id = $user_id;
        $this->tweet_id = $tweet_id;
        $this->save();

        return;
    }

    public function destroyFavorite(Int $favorite_id)
    {
        return $this->where('id', $favorite_id)->delete();
        //idと一致するものをデリート
    }


}
