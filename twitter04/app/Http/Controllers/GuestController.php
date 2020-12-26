<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Favorite;
use App\Models\Follower;


class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user,Tweet $tweet)
    {
        $user = auth()->user();
        $all_users = User::all();
        $tweets = Tweet::orderBy('id', 'desc')->get();

        return view('guests.index',
        ['all_users'=>$all_users,
        'user'=>$user,
        'tweets'=>$tweets,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(User $user, Tweet $tweet, Follower $follower, Favorite $favorite)
    {
        // $timelines = $tweet->getUserTimeLine($user->id);
        // tweetのタイムラインと同じ
        // $tweet_count = $tweet->getTweetCount($user->id);
        // 閲覧しているユーザーのツイート数を数える
        $follow_count = $follower->getFollowCount($user->id);
        // 閲覧しているユーザーのフォロー数を数える
        $follower_count = $follower->getFollowerCount($user->id);
        // 閲覧しているフォローワー数を数える
        $tweets = Tweet::all();
        $all_users= User::all();
        $favorites = Favorite::all();
        //①プロフィールユーザーのFavorite情報を取得する。
        $favorites_tweet_ids = Favorite::where('user_id',$user->id)->orderBy('id', 'desc')->get();
        //②$favorites_tweet_idsを使って、Tweetから$userがいいねしているツイート情報を取得する。

        
        return view('guests.show', [
            'user'           => $user,
            // 'guest_timelines'      => $guest_timelines,
            // 'tweet_count'    => $tweet_count,
            // 'follow_count'   => $follow_count,
            // 'follower_count' => $follower_count,
            'tweets'         => $tweets,
            'favorites'      => $favorites,
            'favorites_tweet_ids'=>$favorites_tweet_ids ,
            //③、②をビューに渡す。

            'all_users'      =>$all_users,
            // 'favoriting_users'  => $favoriting_users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
