<?php

namespace Hpp\Middlewares;

use Closure;
use Admin;

use Hpp\Apps\Admin\Models\Frontpage;

class HppAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $this->build_admin_menu();
        $this->build_admin_quick_action_buttons();

        return $next($request);
    }

    function build_admin_menu()
    {
        
    }

    function build_admin_quick_action_buttons()
    {
        
    }
}
