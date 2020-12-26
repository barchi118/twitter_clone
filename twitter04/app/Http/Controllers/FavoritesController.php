<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;


class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Favorite $favorite)
    {
        $user = auth()->user();
        //ログインしているユーザーを取得
        $tweet_id = $request->tweet_id;
        //tweet_idを投稿内容から取得
        $is_favorite = $favorite->isFavorite($user->id, $tweet_id);
        //いいねをしているかの判定をする。
        if(!$is_favorite) {
            $favorite->storeFavorite($user->id, $tweet_id);
            // いいねしていなかったらいいねをする。
            return back();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Favorite $favorite)
    {
        $user_id = $favorite->user_id;
        // Favoriteモデルのuser_idを$user_idとする
        $tweet_id = $favorite->tweet_id;
        // Favoriteモデルのuser_idを$user_idとする
        $favorite_id = $favorite->id;
        // Favoriteモデルのidを$favortite_idとする

        $is_favorite = $favorite->isFavorite($user_id, $tweet_id);
        //Favorite.phpのisFavoriteを使っていいねしているかの真偽値を返す。

        if($is_favorite) {
            $favorite->destroyFavorite($favorite_id);
            //いいねしていたらdestroyFavoriteを実行して値の消去
            return back();
        }
        return back();
    }
}
