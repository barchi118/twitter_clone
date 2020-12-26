<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
//SoftDeleteという論理削除（削除してもDBには残るがシステム上削除したとみなす機能
class Tweet extends Model
{
    protected $fillable = [
        'text','text_image',
    ];

    //リレーションの親子関係
    public function user()
    {
        return $this->belongsTo(User::class);
        // UserクラスからもTweetにアクセスできるようにする
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
        // 外部キーとローカルキーをhasManyメソッドに追加の引数として渡すことでオーバーライドできます。
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function getUserTimeLine(Int $user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);
    // user_idと同じ投稿を日付を逆順で取得する
    }

    public function getTweetCount(Int $user_id)
    {
        return $this->where('user_id', $user_id)->count();
        // user_idと一致するものを数える
    }

     // 一覧画面
    public function getTimeLines(Int $user_id, Array $follow_ids)
    {
        // 自身とフォローしているユーザIDを結合する
        $follow_ids[] = $user_id;
        return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
        // 自身とフォローしているユーザーの投稿を逆順で取得する
    }
     // 詳細画面
    public function getTweet(Int $tweet_id)
    {
        return $this->with('user')->where('id', $tweet_id)->first();
        // tweet_idと同じidの最初のものだけ取得する
    }

    public function tweetStore(Int $user_id, Array $data,$image)
    {
        $this->user_id = $user_id;
        $this->text = $data['text'];
        $this->text_image = $image;
        $this->save();
        // 上記のあたいをsaveで保存
        return;
    }

    public function tweettextStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->text = $data['text'];
        $this->save();
        
        return;
    }

    public function tweetimageStore(Int $user_id, Array $data,$image)
    {
        $this->user_id = $user_id;
        $this->text_image = $image;
        $this->save();
        return;
    }
    

    //ツイート編集画面用に$user_idと$tweet_idに値に一致するツイートを取得します
    public function getEditTweet(Int $user_id, Int $tweet_id)
    {
        return $this->where('user_id', $user_id)->where('id', $tweet_id)->first();
    }

    public function tweetUpdate(Int $tweet_id, Array $data)
    {
        $this->id = $tweet_id;
        $this->text = $data['text'];
        $this->update();

        return;
    }

    // $user_idと$tweet_idに一致したツイートを削除します。
    public function tweetDestroy(Int $user_id, Int $tweet_id)
    {
        return $this->where('user_id', $user_id)->where('id', $tweet_id)->delete();
    }
}


