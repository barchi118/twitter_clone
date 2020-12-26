<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tweet;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Favorite;

class TweetArticle extends Component
{
    public $user;
    public $follow_ids;
    public $following_ids;
    public $timelines;
    public $follow_count;
    public $follower_count;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Tweet $tweet, Follower $follower)
    {
        // $this->users = User::all();
        $this->user = auth()->user();//ログインしているユーザー
        $this->follow_ids = $follower->followingIds(auth()->user()->id);//フォローしているユーザーのidを取得
        // followed_idだけ抜き出す
        $this->following_ids = $follower->followingIds(auth()->user()->id)->pluck('followed_id')->toArray();
        //pluckメソッドは指定したキーの全コレクション値を取得します。
        //toArrayメソッドはコレクションをPHPの「配列」へ変換します。
        //$follow_idsからfollowed_idをすべて取得して配列に変換する。
        $this->timelines = $tweet->getTimelines(auth()->user()->id, $follower->followingIds(auth()->user()->id)->pluck('followed_id')->toArray());
        // Tweetモデルからフォローしているユーザーとログインユーザーの投稿を取得
        $this->follow_count = $follower->getFollowCount(auth()->user()->id);
        // ログインユーザーのフォロー数を数える
        $this->follower_count = $follower->getFollowerCount(auth()->user()->id);
        // ログインフォローワー数を数える
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tweet-article');
    }
}
