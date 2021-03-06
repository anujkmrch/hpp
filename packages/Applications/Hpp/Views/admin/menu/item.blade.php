@extends('SystemView::admin.admin')
@section('content')
	<div class="admin menu-item">
			<div class="wrapper">
				<div class="small">
					<h3 class="section-heading to-animate">Menu item for edit<span class="border"></span></h3>

					 <div class="button margin10"><a href="{{route('admin.menu.item.create',['type'=>$menu->type->slug])}}" class="btn btn-block btn-default">Create new item</a></div>

					 <div class="button margin10"><a href="{{route('admin.menu.items',['menu'=>$menu->type->slug])}}" class="btn btn-block btn-primary">Go back</a></div>
            {{-- </form> --}}


        <div class="button margin10"><a href="{{route('admin.frontpage.index')}}" class="btn btn-block btn-default">Frontpage</a></div>
				</div>

				<div class="big">
					<div class="row">
						<div class="col-md-12">
							<div class="accordion-wrap">
								<form action="{{route('admin.menu.item',['type'=>$menu->type->slug, 'id' => $menu->id])}}" method="POST" role="form">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<legend>{{$menu->title}}</legend>
				
									<div class="fc-grp">
										<label for="">Title</label>
										<input type="text" name="title" class="fc-in" id="" placeholder="Input field" value="{{ $menu->title }}">
									</div>

									<div class="fc-grp">
										<label for="">Slug</label>
										<input type="text" name="slug" class="fc-in" id="" placeholder="Input field" value="{{ $menu->slug }}">
									</div>

									<div class="fc-grp">
										<label for="">Parent</label>

										@if(count($menu->type->menus))
								 			@php $m = $menu->type->menus->toTree(); @endphp
								 				{!! "<select name=\"parent_id\" class=\"fc-in\">"!!}
								 					<option value="0" @if($menu->parent_id==0) {{ "selected=\"true\"" }} @endif>Root</option>
								 				{!! menu_select($m,'-','id',true,$menu->id,$menu->parent_id) !!}
								 				{!! "</select>" !!}
								 		@endif

							 		</div>
									<div class="fc-grp">
										<label for="">Visible to</label>
										<select name="roles[]" id="inputRoles" class="fc-in chosen-select" required="required" multiple>
											@foreach($roles as $role)
												<option value="{{ $role->id }}"{{$menu->roles->has($role->id) ? ' selected' : ''}}>{{$role->title}}</option>
											@endforeach
										</select>
									</div>
									<div class="fc-grp">
										<label for="">Route</label>
										<input type="text" name="route" class="fc-in" id="" placeholder="Route" value="{{ $menu->route }}">
									</div>

									<div class="fc-grp">
										<label for="">Route options</label>
										<input type="text" name="route_options" class="fc-in" id="" placeholder="Route" value="{{ $menu->route_options }}">
									</div>

									<div class="fc-grp">
										<label for="">Order</label>
										<input type="text" name="ordering" class="fc-in" id="" placeholder="Order" value="{{ $menu->ordering }}">
									</div>
									<div class="fc-grp">
										<label for="">Enable</label>
										<div class="radio">
											<label>
												<input type="radio" name="enabled" value="1" @if($menu->enabled) {{"checked"}} @endif>
												Yes
											</label>
											<label>
												<input type="radio" name="enabled" value="0"  @if(!$menu->enabled) {{"checked"}} @endif>
												No
											</label>
										</div>
									</div>
									<button type="submit" class="button button-style">Submit</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END .row -->
		</div>
		<!-- END .container -->
@stop