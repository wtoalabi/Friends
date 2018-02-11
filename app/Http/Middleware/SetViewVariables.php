<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class SetViewVariables
{
    

    public function handle($request, Closure $next)
    {
        Blade::directive('user', function() {
            return "<?php if(Illuminate\Support\Facades\Auth::check()):?>";
                
        });
          
        Blade::directive('enduser', function() {
            return '<?php endif; ?>';
        });
        
        
        view()->share('user', auth()->user());
        return $next($request);
    }

}
