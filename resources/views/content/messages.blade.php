@extends('layout/layout')

@include('common/header_inner')

@section('content')

<section class="main-content messages">

	<div class="container">

		<div class="row">

			<div class="col-lg-3">

        @include('common/sidebar')

			</div>

			<div class="col-lg-9">

				<div class="heading-sec1">

					<div class="dropdown pull-left">

						<button class="btn2 btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Unread

						<span class="caret"></span></button>

						<ul class="dropdown-menu">

							<li><a href="#" id="Incoming" onclick="myFunction()" >All Incoming </a></li>

							<li class="divider"></li>

							<li><a href="#" id="Unread" onclick="myUnread()">Unread</a></li>

							<li class="divider"></li>

							<li><a href="#"  onclick="myConversations()">Conversations</a></li>

							<li class="divider"></li>

							<li><a href="#" onclick="mySent()">Sent</a></li>

							<li class="divider"></li>

							<li><a href="#" onclick="myWinks()">Initial Winks</a></li>

							<li class="divider"></li>

							<li><a href="#" onclick="myInitials()">Initial Messages</a></li>

						</ul>

					</div>

					<div class="delete-btn pull-right">

						<a href="#" class="grey-btn">Edit <i class="fa fa-trash-o" aria-hidden="true"></i></a>

					</div>

					<div class="clearfix"></div>

				</div>


				<div class="profile-main" id="main" style="display:none;">
					

					<div class="massage-icon">

						<img src="{{Request::root()}}/assets/frontend/img/big-mail-icon.png" alt="" />

						<h2>You don't have any messages that match this filter</h2>

					</div>

					<div class="members">

						<h4>Boost Your Visibility</h4>

						<p>Members receive an average of 3 times more views while they Boost.</p>

						<div class="member-pic">

							<img src="{{Request::root()}}/assets/frontend/img/member-pics.png" alt="" />

							<div class="member-single-pic">

								<img src="{{Request::root()}}/assets/frontend/img/member-single-pic.jpg" alt="" />

							</div>

						</div>

						<h4>Want more views? Get 75 Boost!</h4>

						<a href="#" class="btn2"><i class="fa fa-gg-circle" aria-hidden="true"></i> 150 Coins</a>

					</div>

				</div>



				<div class="profile-main" id="inc" style="display: none;">
					
					<div class="massage-icon">

						<img src="{{Request::root()}}/assets/frontend/img/big-mail-icon.png" alt="" />

						<h2>You don't have any messages that match this filter</h2>

					</div>

					<div class="members">

						<h4>hello</h4>

						<p>Members receive an average of 3 times more views while they Boost.</p>

						<div class="member-pic">

							<img src="{{Request::root()}}/assets/frontend/img/member-pics.png" alt="" />

							<div class="member-single-pic">

								<img src="{{Request::root()}}/assets/frontend/img/member-single-pic.jpg" alt="" />

							</div>

						</div>

						<h4>Want more views? Get 75 Boost!</h4>

						<a href="#" class="btn2"><i class="fa fa-gg-circle" aria-hidden="true"></i> 150 Coins</a>

					</div>

				</div>


				<div class="profile-main" id="unred" style="display: none;">
					

					<div class="massage-icon">

						<img src="{{Request::root()}}/assets/frontend/img/big-mail-icon.png" alt="" />

						<h2>You don't have any messages that match this filter</h2>

					</div>

					<div class="members">

						<h4>Unread</h4>

						<p>Members receive an average of 3 times more views while they Boost.</p>

						<div class="member-pic">

							<img src="{{Request::root()}}/assets/frontend/img/member-pics.png" alt="" />

							<div class="member-single-pic">

								<img src="{{Request::root()}}/assets/frontend/img/member-single-pic.jpg" alt="" />

							</div>

						</div>

						<h4>Want more views? Get 75 Boost!</h4>

						<a href="#" class="btn2"><i class="fa fa-gg-circle" aria-hidden="true"></i> 150 Coins</a>

					</div>

				</div>



				<div class="profile-main" id="conver" style="display: none;">
					
					<div class="massage-icon">

						<img src="{{Request::root()}}/assets/frontend/img/big-mail-icon.png" alt="" />

						<h2>You don't have any messages that match this filter</h2>

					</div>

					<div class="members">

						<h4>Conver</h4>

						<p>Members receive an average of 3 times more views while they Boost.</p>

						<div class="member-pic">

							<img src="{{Request::root()}}/assets/frontend/img/member-pics.png" alt="" />

							<div class="member-single-pic">

								<img src="{{Request::root()}}/assets/frontend/img/member-single-pic.jpg" alt="" />

							</div>

						</div>

						<h4>Want more views? Get 75 Boost!</h4>

						<a href="#" class="btn2"><i class="fa fa-gg-circle" aria-hidden="true"></i> 150 Coins</a>

					</div>

				</div>


				<div class="profile-main" id="send" style="display: none;">
					
					<div class="massage-icon">

						<div class="col-md-12">
					
					        <div class="panel panel-info">
					            <div class="panel-heading">
					                RECENT CHAT HISTORY
					            </div>
					            <div class="panel-body">
					                <ul class="media-list">
					             

					                 @foreach($send as $sent)
	                                    <li class="media">
	                                        <div class="media-body">
	                                            <div class="media">
	                                                <a class="pull-left">
	                                               
	                                                @foreach($reciver as $profile)	

	                                                    <img class="media-object img-circle " height="30px" height="50px" src="{{url('/images')}}/{{$profile[0]->image}}" />
	                                                    	{{$profile[0]->name}}
	                                       				
					                				@endforeach
					                					
	                                                </a>
	                                                                                          
		                                                <div class="media-body" >
		                                                 
		                                                    {{$sent->message}} 
		                                               
	                                                    <br />
	                                       				
	                                                   <small class="text-muted"> Active From 3 hours </small>
	                                                   
	                                                    <hr />
	                                                </div>
	                                                
	                
	                                            </div>
	                                           
	                                        </div>
	                                    </li>
	                                    
	     							 @endforeach
	                                </ul>
					            </div>
					            <!-- <div class="panel-footer">
					                <div class="input-group">
					                					
					                                    <input type="text" class="form-control" placeholder="Enter Message" />
					                                    <span class="input-group-btn">
					                                        <button class="btn btn-info" type="button">SEND</button>
					                                    </span>
					                                </div>
					            </div> -->
					        </div>
					    </div>
					    <div class="clearfix"></div>

					</div>

	
				</div>


				<div class="profile-main" id="win" style="display: none;">
					
					<div class="massage-icon">

						<img src="{{Request::root()}}/assets/frontend/img/big-mail-icon.png" alt="" />

						<h2>You don't have any messages that match this filter</h2>

					</div>

					<div class="members">

						<h4>winks</h4>

						<p>Members receive an average of 3 times more views while they Boost.</p>

						<div class="member-pic">

							<img src="{{Request::root()}}/assets/frontend/img/member-pics.png" alt="" />

							<div class="member-single-pic">

								<img src="{{Request::root()}}/assets/frontend/img/member-single-pic.jpg" alt="" />

							</div>

						</div>

						<h4>Want more views? Get 75 Boost!</h4>

						<a href="#" class="btn2"><i class="fa fa-gg-circle" aria-hidden="true"></i> 150 Coins</a>

					</div>

				</div>
					<div class="profile-main" id="last" style="display: none;">
					
					<div class="massage-icon">

						<img src="{{Request::root()}}/assets/frontend/img/big-mail-icon.png" alt="" />

						<h2>You don't have any messages that match this filter</h2>

					</div>

					<div class="members">

						<h4>All Initials</h4>

						<p>Members receive an average of 3 times more views while they Boost.</p>

						<div class="member-pic">

							<img src="{{Request::root()}}/assets/frontend/img/member-pics.png" alt="" />

							<div class="member-single-pic">

								<img src="{{Request::root()}}/assets/frontend/img/member-single-pic.jpg" alt="" />

							</div>

						</div>

						<h4>Want more views? Get 75 Boost!</h4>

						<a href="#" class="btn2"><i class="fa fa-gg-circle" aria-hidden="true"></i> 150 Coins</a>

					</div>

				</div>



			</div>

		</div>

	</div>

</section>

@stop

<script type="text/javascript">
// all incoming

function myFunction() {
    var a = document.getElementById('inc');
    var b = document.getElementById('main');
    var c = document.getElementById('unred');
    var d = document.getElementById('conver');
    var e = document.getElementById('send');
    var f = document.getElementById('win');
    var g = document.getElementById('last');

    if (a.style.display === 'none') {
        a.style.display = 'block';
    }
    else
    {
        a.style.display = 'none';
        b.style.display = 'none';
        c.style.display = 'none';
        d.style.display = 'none';
        e.style.display = 'none';
        f.style.display = 'none';
    }
}
// all Unread
function myUnread() {
    var a = document.getElementById('inc');
    var b = document.getElementById('main');
    var c = document.getElementById('unred');
    var d = document.getElementById('conver');
    var e = document.getElementById('send');
    var f = document.getElementById('win');
    var g = document.getElementById('last');

    if (c.style.display === 'none') 
    {
        c.style.display = 'block';
    }
    else
    {
        a.style.display = 'none';
        b.style.display = 'none';
        c.style.display = 'none';
        d.style.display = 'none';
        e.style.display = 'none';
        f.style.display = 'none';
    }
}

// all Unread
function myConversations() {
    var a = document.getElementById('inc');
    var b = document.getElementById('main');
    var c = document.getElementById('unred');
    var d = document.getElementById('conver');
    var e = document.getElementById('send');
    var f = document.getElementById('win');
    var g = document.getElementById('last');

    if (d.style.display === 'none') 
    {
        d.style.display = 'block';
    }
    else
    {
        a.style.display = 'none';
        b.style.display = 'none';
        c.style.display = 'none';
        d.style.display = 'none';
        e.style.display = 'none';
        f.style.display = 'none';
    }
}

// all Unread
function mySent() {
    var a = document.getElementById('inc');
    var b = document.getElementById('main');
    var c = document.getElementById('unred');
    var d = document.getElementById('conver');
    var e = document.getElementById('send');
    var f = document.getElementById('win');
    var g = document.getElementById('last');

    if (e.style.display === 'none') 
    {
        e.style.display = 'block';
    }
    else
    {
        a.style.display = 'none';
        b.style.display = 'none';
        c.style.display = 'none';
        d.style.display = 'none';
        e.style.display = 'none';
        f.style.display = 'none';
    }
}

// all Unread
function myWinks(){
    var a = document.getElementById('inc');
    var b = document.getElementById('main');
    var c = document.getElementById('unred');
    var d = document.getElementById('conver');
    var e = document.getElementById('send');
    var f = document.getElementById('win');
    var g = document.getElementById('last');

    if (f.style.display === 'none') 
    {
        f.style.display = 'block';
    }
    else
    {
        a.style.display = 'none';
        b.style.display = 'none';
        c.style.display = 'none';
        d.style.display = 'none';
        e.style.display = 'none';
        f.style.display = 'none';
    }
}

// all Unread
function myInitials()
{
    var a = document.getElementById('inc');
    var b = document.getElementById('main');
    var c = document.getElementById('unred');
    var d = document.getElementById('conver');
    var e = document.getElementById('send');
    var f = document.getElementById('win');
    var g = document.getElementById('last');

    if (g.style.display === 'none') 
    {
        g.style.display = 'block';
    }
    else
    {
        a.style.display = 'none';
        b.style.display = 'none';
        c.style.display = 'none';
        d.style.display = 'none';
        e.style.display = 'none';
        f.style.display = 'none';
    }
}

$(document).ready(function(){
// send messege to others
		$("#send").click(function(){
			var user_idss = $('#hidden_id').val();
			var send_by = "{{Session::get('id')}}";
			var msg = $('#msg').val();
			// Returns successful data submission message when the entered information is stored in database.
			if(user_idss == '' || send_by == '' || msg == '' )
			{
			  alert("Please Fill All Fields");
			}
			else
			{
			// AJAX Code To Submit Form.
				 $.ajax({
                    type:'post',
                    url:"profile-detail",
                    dataType:'json',
                    data:{  
                    		messanger_id : send_by,
                    		manage_users_id : user_idss,
                    		message : msg,
                    	  	action : 'send',
                    	  	_token:'{{csrf_token()}}'
                    	 },
                    success: function(result){
                    	if(result == 0 )
                    	{
                    		
							swal(
							      'Oops...',
							      'Try Again later..',
							      'error'
							    )

                    	}
                    	else
                    	{
                    		
							swal(
							      'Success...',
							      'Message send successfully to this member',
							      'success'
							    );
							$("#send").html("sent");
							
                    	}

                        
                    }
                });	
			}
			return false;
		});

});
</script>
