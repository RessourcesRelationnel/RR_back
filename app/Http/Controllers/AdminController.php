<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function showUnvalidateArticles(){
            $articles = Article::where('validated', false)->get();

            return response()->json(['success' => $articles]);
    }
    public function validateArticle(Article $article){
        if($article && $article->validated == false){
            $article->validated = true;
            return response()->json(['success' => 'Article publié']);
        }else{
            return response()->json(['error' => 'L"article n"a pas pu etre publié']);
        }
    }

    public function showAdmin(){
        $admins = User::role('admin')->get();
        return $admins;
    }

    public function showModerator(){
        $moderators = User::role('moderator')->get();
        return $moderators;
    }

    public function promoteUser(User $user){



        $roles = $user->getRoleNames();

        //$user->removeRole(        json_encode($roles));
        $user->assignRole('admin');

        return  $roles;
    }

       /* $user = User::find($userId);

        $moderatorRole = Role::where('name', 'moderator')->first();

        $user->assignRole($moderatorRole);

        return response()->json(['message' => 'Utilisateur promu en modérateur avec succès']);*/

    public function deleteComment(){

    }
}
