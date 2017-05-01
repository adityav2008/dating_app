@extends('layout/layout')

@include('common/header_outer')

@section('content')

<div class="banner inner-banner">
	<!-- <img src="img/about-banner.jpg" alt="" />-->
	<img src="{{Request::root()}}/assets/frontend/img/about-banner.jpg" alt="" />
 	<div class="bread-main">
		<div class="container">
			<div class="row">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('/index')}}">Home</a></li>
					<li class="breadcrumb-item active">About Us</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<section class="cms-content about-us">
	<div class="container">
		<div class="row">
			<h3>What is Lorem Ipsum?</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
			<h3>Why do we use it?</h3>
			<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
		</div>
	</div>
</section>
@stop

