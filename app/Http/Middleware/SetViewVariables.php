<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class SetViewVariables
{
    

    public function handle($request, Closure $next)
    {
        
       if(Auth::check())
       { $currentUser = User::where('id', Auth::user()->id)
        ->with(['statuses',
            'following'=>function($query){
                $query->with('images');
            },
            'followers'=> function($query){
                $query->with('images');
        }
            ,'images'])
        ->first();

        $usersToFollow = $currentUser->following()->pluck('follow_id');
        $usersToFollow[] = $currentUser->id;
        $usersToFollow =  User::whereNotIn('id', $usersToFollow)
                            ->with('images','following','followers')
                            ->inRandomOrder()
                            ->take(2)->get();
        view()->share(['currentUser'=>$currentUser, 'usersToFollow'=>$usersToFollow]);
    }
        return $next($request);
    }

}
