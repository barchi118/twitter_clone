<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tweet;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Favorite;


class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tweet $tweet, Follower $follower)
    {
        $user = auth()->user();//ログインしているユーザー
        $follow_ids = $follower->followingIds($user->id);//フォローしているユーザーのidを取得
        // followed_idだけ抜き出す
        $following_ids = $follow_ids->pluck('followed_id')->toArray();
        //pluckメソッドは指定したキーの全コレクション値を取得します。
        //toArrayメソッドはコレクションをPHPの「配列」へ変換します。
        //$follow_idsからfollowed_idをすべて取得して配列に変換する。
        $timelines = $tweet->getTimelines($user->id, $following_ids);
        // Tweetモデルからフォローしているユーザーとログインユーザーの投稿を取得
        $follow_count = $follower->getFollowCount($user->id);
        // ログインユーザーのフォロー数を数える
        $follower_count = $follower->getFollowerCount($user->id);
        // ログインフォローワー数を数える

        return view('tweets.index', [
            'user'      => $user,
            'timelines' => $timelines,
            'follow_count'=>$follow_count,
            'follower_count'=>$follower_count,

        ]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        return view('tweets.create', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Tweet $tweet, Comment $comment)
    {
        $user = auth()->user();
        $tweet = $tweet->getTweet($tweet->id);
        $tweet_image = $tweet->getTweet($tweet->id);
        $comments = $comment->getComments($tweet->id);
        

        return view('tweets.show', [
            'tweet_image'     => $tweet_image,
            'user'     => $user,
            'tweet' => $tweet,
            'comments' => $comments
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tweet $tweet)
    {
        
        $user = auth()->user();
        $data = $request->all();
        //request
        // $validator = Validator::make($data, [
        //     'text' => ['required', 'string', 'max:140']
        // ]);

        if($request->text == null){
            //textがなかったらimageをstoreする。
            $path = $request->file('text_image')->store('public/text_images');
            // 
            $image= basename($path);
            $tweet->tweetimageStore($user->id, $data,$image);
        }elseif($request->text_image == null){
            // text_imageがなかったらtextのみをstoreする
            $tweet->tweettextStore($user->id, $data);
        }else{
        if ($request->isMethod('POST')) {
            // 両方あれば両方保存する。
            $path = $request->file('text_image')->store('public/text_images');
            // public/text_imagesに保存
            $image= basename($path); 
            // 画像名のみ保存するようにしています。
            $tweet->tweetStore($user->id, $data,$image);
            // tweetstoreを使って投稿を保存
        }
        }
        // $validator->validate();
        return redirect('tweets');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet)
    {
        $user = auth()->user();
        $tweets = $tweet->getEditTweet($user->id, $tweet->id);
        // 編集するツイートを取得
        // @isset $tweetsは定義済みでnullでない

        if (!isset($tweets)) {
            return redirect('tweets');
        }

        return view('tweets.edit', [
            'user'   => $user,
            'tweets' => $tweets
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        $data = $request->all();
        // 編集したデータを全て取得する。
        $validator = Validator::make($data, [
            'text' => ['required', 'string', 'max:140']
        ]);
        // ヴァリデーションの確認

        $validator->validate();
        $tweet->tweetUpdate($tweet->id, $data);
        // TweetモデルのtweetUpdateを使ってアップデート

        return redirect('tweets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        $user = auth()->user();
        $tweet->tweetDestroy($user->id, $tweet->id);
        // 引数と一致するツイートを消去

        return back();
    }
}
