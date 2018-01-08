<?php
namespace Hpp\Apps\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hpp\Models\CourseSession;

class HomeController extends Controller
{
	public function index(Request $request)
	{
		return view("HppView::client.home.index");
	}
}
?>