
@extends('layout/layout')

@include('common/header_inner')

@section('content')
<section class="main-content pro-search">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">

               @include('common/sidebar')

		    </div>
			<div class="col-lg-9">
				<div class="heading-sec1">
					<div class="grid-view">
						<div class="grid-list pull-left">
							<a href="{{url('/profile-search?id=')}}{{ $_GET['id'] }}"><img src="{{Request::root()}}/assets/frontend/img/list-icon.png" alt="" /></a>
							<a href="{{url('/profile-detail?id=')}}{{ $_GET['id'] }}"><img src="{{Request::root()}}/assets/frontend/img/gird-view.png" alt="" /></a>
						</div>
						<div class="go pull-right">
							<a href="#">
								<img src="{{Request::root()}}/assets/frontend/img/go-invisible.png" alt="" /> Go Invisible
							</a>
						</div>	
						<div class="clearfix"></div>
					</div>
					<?php
					//dd(Session::get('id')) ;
					 $userData = DB::table('manage_users')->where('id',array(Session::get('id')))->first();
					// $userData = DB::table('manage_users')->where('id',$_GET['id'])->first();
					 
					 ?>
					 
					<div class="row">
						<div class="edit-search">
							<div class="loction-show pull-left">
								<ul class="clearfix">
								@if($userData)

									<li><span style="text-transform: uppercase;">{{ $userData->gender }}</span> interested in <span style="text-transform: uppercase;">{{ $userData->looking_for}}</span></li>
									<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
								@endif	

					
				<?php
				//$filter = DB::table('user_search')->where('user_id',Session::get('id'))->get();

				//$filter = DB::table('user_search')->where('user_id',$_GET['id'])->get();
				
				if(isset($search) || empty($search))
				{
					foreach ($search as $value) 
					{

						$res_for   = $value->looking_for;
						$res_fromAge   = $value->from_age;
						$res_toAge   = $value->to_age;
						$res_location   = $value->location;
						$res_fromHeight   = $value->from_height;
						$res_toHeight   = $value->to_height;
						$res_relationship   = $value->relationship;
						$res_children   = $value->children;
						$res_education   = $value->education;
						$res_ethnicity   = $value->ethnicity;
						$res_religion   = $value->religion;
						$res_bodyType   = $value->body_type;
						$res_smoke   = $value->smoking;
						$res_search   = $value->search_name;
					}
				    ?>

									<li>Ages <span>@if(!empty($res_fromAge)){{ $res_fromAge }}@endif</span> to <span>@if(!empty($res_toAge)){{ $res_toAge }}@endif</span></li>
									<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
									<li>within <span>15</span> km of Delhi</li>
								</ul>
							</div>
							<a href="{{url('/search-edit?id=')}}{{ $_GET['id'] }}" class="search-a pull-right">Search Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>
				<div class="search-right">

				<?php

				if(!empty($search))
				{
			 
			    	$result = DB::table('manage_users')
				            ->whereNotIn('id',array(Session::get('id')))
				            ->where('gender',$res_for)
				            ->whereBetween('age', array( $res_fromAge, $res_toAge))
				            ->whereBetween('height', array( $res_fromHeight, $res_toHeight))
				            ->where('relationship',$res_relationship)
				            ->where('children',$res_children)
				            ->where('education',$res_education)
				            ->where('ethnicity',$res_ethnicity)
				            ->where('religion',$res_religion)
				            ->where('body_type',$res_bodyType)
				            ->where('smoking',$res_smoke)
				            ->paginate(28);   

			    }
			    	
			    ?>
			   
					<ul class="clearfix">
						@foreach($result as $values)
						<li id="{{ $values->id }}">
							<a href="{{url('/profile-about?id=')}}{{$values->id}}">
								<div class="img">
									<img src="{{url('/images')}}/{{ $values->image }}" alt="" height="175px" width="175px" />
								</div>
								<div class="content">
									<h4>{{ $values->name }}</h4>
									<p>{{ $values->age }} years old</p>
								</div>
							</a>
						</li>
						@endforeach
					</ul>
					<?php
				}
				?>
				</div>
				@if(empty($filter))

				<div class="search-right">
					<div class="change-criteria" style="">
						<h2>Want to see more members?</h2>
						<p><span class="link edit-search-options-2" style="-moz-user-select: none;" tabindex="0">Expand your search</span>
						 by increasing the distance, widening the age range or removing advanced search options.</p><p class="extended-option-summary"></p>
						    <span data-zat="modify-search-from-empty-or-limited-search-view" class="edit-search-options-2 button-confirm link" style="-moz-user-select: none;" tabindex="0"><span>Modify Search</span></span></div>
					
				</div>
				@endif
				<div class="paginate">
					<ul>
						{{ $result->links() }}
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

@stop