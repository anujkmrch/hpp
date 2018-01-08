<?php

namespace Hpp\Middlewares;

use Closure;
use Admin,System, Auth;

use Hpp\Apps\Admin\Models\Frontpage;

class Hppify
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
        
        if (!Auth::guest() and !System::isGuestCreated()) {
            if(System::can('can_access_admin')):
                $this->build_admin_menu();
                $this->build_admin_quick_action_buttons();
                if($path = $request->input('redirect_to'))
                    return redirect($path);
            endif;
        }

        return $next($request);;
    }

    function build_admin_menu()
    {
        $menu=["title"=> "Hpp","slug"=>"users",'href'=>route('hpp.admin.index'),
            "ordering"=> 10,];
        Admin::add_admin_menu('hpp',['__base__'=>$menu]);

        $menu=["title"=> "Main","slug"=>"users",'href'=>route('hpp.admin.index'),
            "ordering"=> 10,];
        Admin::add_admin_menu('hpp/main',['__base__'=>$menu]);


        $menu=["title"=> "Applications","slug"=>"users",'href'=>route('hpp.admin.attendance.index'),"ordering"=> 11,];
        Admin::add_admin_menu('hpp/applications',['__base__'=>$menu]);

    }

    function build_admin_quick_action_buttons()
    {
        $dashboard=["title"=> "Dashboard User Data","slug"=>"users","callback"=>'hpp_funny_name','ordering' => 0,];
        Admin::add_admin_dashboard($dashboard);
    }
}
