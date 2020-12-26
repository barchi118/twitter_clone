<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Comment extends Model
{
    protected $fillable = [
        'text'
    ];
    // $fillableプロパティで属性を指定
    // $fillableとは悪意のあるユーザーからの変更を拒否する

    //リレーションの親子関係
    public function user()
    {
        return $this->belongsTo(User::class);
        // UserからCommemtにアクセスできるようにする
    }

    public function getComments(Int $tweet_id)
    {
        //getTweet()で取得した情報に紐づいたコメント情報を取得します。
        return $this->with('user')->where('tweet_id', $tweet_id)->get();
    }

    public function commentStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->tweet_id = $data['tweet_id'];
        $this->text = $data['text'];
        $this->save();
        // 上記のカラムをsaveメソッドで保存する
        return;
    }
}
