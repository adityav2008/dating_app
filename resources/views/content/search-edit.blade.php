@extends('layout/layout')
@include('common/header_inner')
@section('content')
<section class="main-content connections">
   <div class="container">
      <div class="row">
         <div class="col-lg-3">
            @include('common.sidebar')
         </div>
         <div class="col-lg-9">
            <div class="connections-right">
               <div class="heart-heading">
                  <h3>Edit Search</h3>
               </div>
               <div id="tabs">
                  <div class="row">
                     <ul>
                        <li><a href="#tabs-1">New Search</a></li>
                        <li><a href="#tabs-2">Saved Search</a></li>
                     </ul>
                  </div>
                  <form method="post" action="{{url('/search-edit')}}">
                     {{csrf_field()}}
                     <input value="{{ Session::get('id')}}" type="hidden" name="user_id"> 
                     <div id="tabs-1">
                        <div class="js-mod-body mod-body">
                           <div class="basic-search-options">
                              <h5>Searching for Women interested in Men</h5>
                              <div class="input" style="padding: 19px 25px 5px;" >
                                 Ages 
                                 <input class="js-criteria-age-min age-input" type="text" name="from_age"> 
                                 to <input class="js-criteria-age-max age-input" name="to_age" type="text">
                              </div>
                              <div class="input" style="padding: 19px 25px 10px;">
                                 Location:  <strong class="js-location-string">Sec-27 Noida</strong> (<a href="#">edit</a>)
                              </div>
                              <div class="input" style="padding: 19px 25px 20px;">
                                 Search distance:  
                                 <select name="location" class="js-criteria-distance">
                                    <option value="0" selected="selected">Search within Radius</option>
                                    <option value="5">5 km</option>
                                    <option value="10">10 km</option>
                                    <option value="15">15 km</option>
                                    <option value="30">30 km</option>
                                    <option value="80">80 km</option>
                                    <option value="160">160 km</option>
                                 </select>
                              </div>
                           </div>
                           <p id="advance" data-toggle="collapse" data-target="#demo"> Advanced Search </p>
                           <div class="collapse" id="demo">
                              <div class="height-option">
                                 <div class="xyz">
                                    Height between  
                                    <select class="js-criteria-height-min" name="from_height">
                                       <option selected="selected" value="0"> -- </option>
                                       @for ($i = 91; $i <= 241 ; $i++)
                                       <option value="{{ $i }}"> {{ $i }} </option>
                                       @endfor  
                                    </select>
                                    and
                                    <select class="js-criteria-height-max" name="to_height">
                                       <option selected="selected" value="0">--</option>
                                       @for ($i = 91; $i <= 241 ; $i++)
                                       <option value="{{ $i }}"> {{ $i }} </option>
                                       @endfor 
                                    </select>
                                 </div>
                                 <div class="input">
                                    Looking For:  
                                    <select name="looking_for" class="js-criteria-distance">
                                       <option value="Any" selected="selected"> Looking For</option>
                                       <option value="male">Male</option>
                                       <option value="female">Female</option>
                                    </select>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-4 edit-container">
                                       <h3 class="">Relationship</h3>
                                       <ul class="js-search-category">
                                          <div>
                                             <label>
                                             <input class="js-criteria-relationship" name="relationship[]" value="1" type="checkbox">
                                             <span class="label-text">Never married</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                             <input class="js-criteria-relationship" name="relationship[]" value="2" type="checkbox"><span class="label-text">Separated</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                             <input class="js-criteria-relationship" name="relationship[]" value="3" type="checkbox"><span class="label-text">Divorced</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                             <input class="js-criteria-relationship" name="relationship[]" value="4" type="checkbox"><span class="label-text">Widowed</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                             <input class="js-criteria-relationship" name="relationship[]" value="5" type="checkbox"><span class="label-text">Tell you later</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                             <input class="js-criteria-any" value="any" name="relationship[]" type="checkbox"><span class="label-text">Any</span>
                                             </label>
                                          </div>
                                       </ul>
                                    </div>
                                    <div class="col-lg-4 edit-container">
                                       <h3 class="">Children</h3>
                                       <div class="js-search-category">
                                          <label>
                                          <input class="js-criteria-children" name="children[]" value="1" type="checkbox"><span class="label-text">No</span>
                                          </label>
                                       </div>
                                       <div>
                                          <label>
                                          <input class="js-criteria-children" name="children[]"  value="2" type="checkbox"><span class="label-text">Yes, at home with me</span>
                                          </label>
                                       </div>
                                       <div>
                                          <label>
                                          <input class="js-criteria-children" name="children[]"  value="3" type="checkbox"><span class="label-text">Yes, but they don't live with me</span>
                                          </label>
                                       </div>
                                       <div>
                                          <label>
                                          <input class="js-criteria-any" value="any" name="children[]"  type="checkbox"><span class="label-text">Any</span></label>
                                       </div>
                                    </div>
                                    <div class="col-lg-4 edit-container">
                                       <h3 class="">Ethnicity</h3>
                                       <div class="js-search-category">
                                          <div>
                                             <label>
                                             <input class="js-criteria-ethnicity" name="ethnicity[]"  value="7" type="checkbox"><span class="label-text">White/Caucasian</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                             <input class="js-criteria-ethnicity" name="ethnicity[]" value="2" type="checkbox"><span class="label-text">Black/African</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                             <input class="js-criteria-ethnicity" name="ethnicity[]" value="3" type="checkbox"><span class="label-text">Latino/Hispanic</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                             <input class="js-criteria-ethnicity" name="ethnicity[]" value="1" type="checkbox"><span class="label-text">Asian</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                             <input class="js-criteria-ethnicity" name="ethnicity[]" value="9" type="checkbox"><span class="label-text">Indian</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                             <input class="js-criteria-ethnicity" name="ethnicity[]" value="4" type="checkbox"><span class="label-text">Middle Eastern</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                             <input class="js-criteria-ethnicity" name="ethnicity[]" value="8" type="checkbox"><span class="label-text">Mixed/Other</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                             <input class="js-criteria-any" value="any" name="ethnicity[]" type="checkbox"><span class="label-text">Any</span>
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div  class="col-lg-4 edit-container">
                                       <h3 class="">Religion</h3>
                                       <ul class="js-search-category">
                                          <div><label><input class="js-criteria-redivgion" value="1" name="religion[]" type="checkbox"><span class="label-text">Agnostic</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-redivgion" name="religion[]" value="2" type="checkbox"><span class="label-text">Atheist</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-redivgion" name="religion[]" value="3" type="checkbox"><span class="label-text">Buddhist</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-redivgion" name="religion[]" value="4" type="checkbox"><span class="label-text">Christian</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-redivgion" name="religion[]" value="5" type="checkbox"><span class="label-text">Christian - Catholic</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-redivgion" name="religion[]" value="6" type="checkbox"><span class="label-text">Jewish</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-redivgion" name="religion[]" value="7" type="checkbox"><span class="label-text">Hindu</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-redivgion" name="religion[]" value="8" type="checkbox"><span class="label-text">Muslim</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-redivgion" name="religion[]" value="9" type="checkbox"><span class="label-text">Spiritual</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-redivgion" name="religion[]" value="10" type="checkbox"><span class="label-text">Other</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-any" value="any" name="religion[]" type="checkbox"><span class="label-text">Any</span></label>
                                          </div>
                                       </ul>
                                    </div>
                                    <div  class="col-lg-4 edit-container">
                                       <div class="advanced-search-category">
                                          <h3 class="">Education</h3>
                                          <div>
                                             <label>
                                             <input class="js-criteria-education" name="education[]" value="6" type="checkbox"><span class="label-text">No degree</span>
                                             </label>
                                          </div>
                                          <div>
                                             <label>
                                                <input class="js-criteria-education" name="education[]" value="1" type="checkbox">
                                                <span class="label-text">High school graduate</span>
                                             </label>
                                          </div>
                                          <div><label><input class="js-criteria-education" name="education[]" value="2" type="checkbox"><span class="label-text">Attended college</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-education" name="education[]" value="4" type="checkbox"><span class="label-text">College graduate</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-education" name="education[]" value="5" type="checkbox"><span class="label-text">Advanced degree</span></label>
                                          </div>
                                          <div><label><input value="any" class="js-criteria-any" name="education[]" type="checkbox"><span class="label-text">Any</span></label>
                                          </div>
                                       </div>
                                    </div>
                                    <div  class="col-lg-4 edit-container">
                                       <h3 class="">Body Type</h3>
                                       <ul class="js-search-category">
                                          <div>
                                             <label><input class="js-criteria-body_type" name="body_type[]" value="1" type="checkbox"><span class="label-text">Slim</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-body_type" name="body_type[]" value="2" type="checkbox"><span class="label-text">Athletic</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-body_type" name="body_type[]" value="3" type="checkbox"><span class="label-text">Average</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-body_type" name="body_type[]" value="4" type="checkbox"><span class="label-text">Curvy</span></label>
                                          </div>
                                          <div><label><input class="js-criteria-any" name="smoking[]" value="any" type="checkbox"><span class="label-text">Any</span></label>
                                          </div>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div  class="col-lg-4 edit-container">
                                       <div class="advanced-search-category">
                                          <h3 class="">Smoking</h3>
                                          <ul class="js-search-category">
                                             <div><label><input class="js-criteria-smoking" name="smoking[]" value="1" type="checkbox"><span class="label-text">No</span></label>
                                             </div>
                                             <div><label><input class="js-criteria-smoking" name="smoking[]" value="2" type="checkbox"><span class="label-text">Yes, socially</span></label>
                                             </div>
                                             <div><label><input class="js-criteria-smoking" name="smoking[]" value="3" type="checkbox"><span class="label-text">Yes, regularly</span></label>
                                             </div>
                                             <div><label><input class="js-criteria-any" value="any" name="smoking[]" type="checkbox"><span class="label-text">Any</span></label>
                                             </div>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                                 <!--/advanced-search-options-->
                              </div>
                           </div>
                        </div>
                        <div id="footer">
                           <div class="paginate">
                              <p ><a href="#">Reset</a></p>
                              <div class="save-search-option js-save-this-search-container">
                                 <p>
                                    <input class="js-save-this-search-checkbox" id="show"  name="save_me" type="checkbox"> Save this search
                                 </p>
                                 <div class="input-method"  id="save_for" style="display: none">
                                    <input maxlength="50" class="js-save-search-input-text save-search-field" placeholder="Enter search name" name="search_name" type="text">
                                    <div class="js-error-empty-name form-error" style="display:none">Please enter a name for this saved search.</div>
                                    <div class="js-error-exists-name form-error" style="display:none">You already have a search saved by this name.</div>
                                    <div class="js-error-max-reached form-error" style="display:none">You have reached the maximum number of saved searches. To save this search, delete one from Saved Searches.</div>
                                    <div id="submit" tabindex="0">
                                       <input class="btn2" type="submit" name="save" id="save" value="Save and Search" >
                                       <input class="btn2" type="Reset" value="Cancel">
                                    </div>
                                 </div>
                                 <div  class="action-container" id="hide_for">
                                    <input class="btn2" type="submit" name="save" id="save" value="Search" >
                                    <input class="btn2" type="Reset" value="Cancel">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
                  <div id="tabs-2">
                     <?php
                        $result = DB::table('user_search')->where('user_id',Session::get('id'))->get();
                      
                        ?>

                     @if(empty($result) || !isset($result))          
                     <div class="basic-search-options clearfix">
                        <h2>You don't have any searches.</h2>
                        <div class="input" style="padding: 19px 25px 5px;" >
                           <p id="list">To save a search:</p>
                           <p id="list">Fill out a new search</p>
                           <p id="list">Check the "Save this search" box</p>
                           <p id="list">Name your search</p>
                           <p id="list">Click "Save and Search" and you're done!</p>
                        </div>
                        <button class="btn2" id="newsearch">New Search</button>
                     </div>
                     <div id="footer">
                        <div class="paginate">
                           <p>Cancel</p>
                        </div>
                     </div>
                     @else
                     <div class="basic-search-options clearfix">
                        @foreach($result as $values)
                           @for($i=0; $i<= count($values);$i++)
                           <div class="col-lg-6">
                           <?php 
                            $relation = $values->relationship; 
                            $res_relation = explode(',', $relation);
                            $child = $values->children;
                            $children = explode(',', $child);
                            $edu = $values->education;
                            $education = explode(',', $edu);
                            $ethni = $values->ethnicity;
                            $ethnicity = explode(',', $ethni);
                            $relig = $values->religion;
                            $religion = explode(',', $relig);
                            $body_type = $values->body_type;
                            $body_type = explode(',', $body_type);
                            $smoking = $values->smoking;
                            $smoking = explode(',', $smoking);
                            ?>


                           <div class="loading"  id="{{ $values->id }}" aria-hidden="true">
                              <h2 class="js-title-name">  {{ $values->search_name }} </h2>
                              <div class="criteria-frame" >
                                 <ul class="js-options-container">
                                    <li class="js-age-and-distance-control">
                                       <span class="js-age-range-with-age-max"><strong>Age:</strong> <span class="js-age-controls-minimum"> {{ $values->from_age }}</span> to <b><span class="js-age-controls-maximum"> {{ $values->to_age }}</span></b></span>
                                    </li>
                                    <li class="js-age-and-distance-control">
                                       <span class="js-age-range-with-age-max"><strong>Height:</strong> <span class="js-age-controls-minimum"> {{ $values->from_height }}</span> to <span class="js-age-controls-maximum">   {{ $values->to_height }}</span></span>
                                    </li>
                                    <li class="js-age-and-distance-control">
                                       <label>Relationship : </label>
                                       <span class="js-age-range-with-age-max">
                                          @for($j = 0; $j < count($res_relation); $j++)
                                             @if($res_relation[$j] == 1)
                                             {{ "Never married" }}
                                             @elseif($res_relation[$j] == 2)
                                             {{ "Separated"}}
                                             @elseif($res_relation[$j] == 3)
                                             {{ "Divorced"}}
                                             @elseif($res_relation[$j] == 4)
                                             {{ "Widowed" }} 
                                             @elseif($res_relation[$j] == 5)
                                             {{ "Tell you later" }} 
                                             @else
                                             {{ "Any" }}  
                                             @endif
                                          @endfor
                                       </span>
                                    </li>
                                    <li class="js-age-and-distance-control">
                                       <label>Children :</label>
                                       <span class="js-age-range-with-age-max">
                                       @for($j = 0; $j < count($children); $j++)
                                          @if($children[$j] == 1)
                                             {{ "No" }}
                                             @elseif($children[$j] == 2)
                                             {{ "Yes, at home with me"}}
                                             @elseif($children[$j] == 3)
                                             {{ "Yes, but they don't live with me"}}
                                             @else
                                             {{ "Any" }}  
                                          @endif 
                                       @endfor
                                       </span>
                                    </li>
                                    <li class="js-age-and-distance-control">
                                       <label>Education : </label>
                                       <span class="js-age-range-with-age-max">
                                       @for($j = 0; $j < count($education); $j++)
                                          @if($education[$j] == 1)
                                          {{ "No degree" }}
                                          @elseif($education[$j] == 2)
                                          {{ "High school graduate" }}
                                          @elseif($education[$j] == 3)
                                          {{ "Attended college" }}
                                          @elseif($education[$j] == 4)
                                          {{ "College graduate" }}
                                          @elseif($education[$j] == 5)
                                          {{ "Advanced degree"}} 
                                          @else
                                          {{ "Any" }}  
                                          @endif
                                        @endfor  
                                       </span>
                                    </li>
                                    <li class="js-age-and-distance-control">
                                       <label>Ethnicity : </label>
                                       <span class="js-age-range-with-age-max">
                                        @for($j = 0; $j < count($ethnicity); $j++)
                                              @if($ethnicity[$j] == 1)
                                             {{ "Asian " }}
                                             @elseif($ethnicity[$j] == 2)
                                             {{ "Black/African " }}
                                             @elseif($ethnicity[$j] == 3)
                                             {{ "Latino/Hispanic " }}
                                             @elseif($ethnicity[$j] == 4)
                                             {{ "Middle Eastern " }}
                                             @elseif($ethnicity[$j] == 7)
                                             {{ "White/Caucasian "}} 
                                             @elseif($ethnicity[$j] == 8)
                                             {{ "Mixed/Other " }}
                                             @elseif($ethnicity[$j] == 9)
                                             {{ "Indian "}} 
                                             @else
                                             {{ "Any" }}  
                                             @endif
                                         @endfor
                                         </span>
                                       
                                    </li>
                                    <li class="js-age-and-distance-control">
                                       <label>Religion : </label>
                                       <span class="js-age-range-with-age-max">
                                       @for($j = 0; $j < count($religion); $j++)
                                            @if($religion[$j] == 1)
                                             {{ "Agnostic" }}
                                             @elseif($religion[$j] == 2)
                                             {{ "Atheist" }}
                                             @elseif($religion[$j] == 3)
                                             {{ "Buddhist" }}
                                             @elseif($religion[$j] == 4)
                                             {{ "Christian" }}
                                             @elseif($religion[$j] == 5)
                                             {{ "Christian - Catholic"}} 
                                             @elseif($religion[$j] == 6)
                                             {{ "Jewish" }}
                                             @elseif($religion[$j] == 7)
                                             {{ "Hindu"}} 
                                             @elseif($religion[$j] == 8)
                                             {{ "Muslim"}} 
                                             @elseif($religion[$j] == 9)
                                             {{ "Spiritual" }}
                                             @elseif($religion[$j] == 10)
                                             {{ "Other"}}  
                                             @else
                                             {{ "Any" }}  
                                             @endif 
                                       @endfor
                                       </span>
                                       
                                    </li>
                                    <li class="js-age-and-distance-control">
                                       <label>Body Type : </label>
                                       <span class="js-age-range-with-age-max">
                                    @for($j = 0; $j < count($body_type); $j++)                                     
                                       @if($body_type[$j] == 1)
                                       {{ "Slim" }}
                                       @elseif($body_type[$j] == 2)
                                       {{ "Athletic" }}
                                       @elseif($body_type[$j] == 3)
                                       {{ "Average" }}
                                       @elseif($body_type[$j] == 4)
                                       {{ "Curvy" }}
                                       @else
                                       {{ "Any" }}  
                                       @endif
                                   @endfor
                                   </span>
                                    </li>
                                    <li class="js-age-and-distance-control">
                                       <label>Smoking : </label>
                                       <span class="js-age-range-with-age-max">
                                       @for($j = 0; $j < count($smoking); $j++)  
                                          @if($smoking[$j] == 1)
                                          {{ "No" }}
                                          @elseif($smoking[$j] == 2)
                                          {{ "Yes, socially" }}
                                          @elseif($smoking[$j] == 3)
                                          {{ "Yes, regularly" }}
                                          @else
                                          {{ "Any" }}  
                                          @endif
                                       @endfor
                                        </span>
                                    </li>
                                 </ul>
                              </div>
                              <footer>
                                 <span class="js-button-search minor-button-confirm spin-control" style="-moz-user-select: none;" tabindex="0">
                                 <span><a href="{{url('/profile-search?id=')}}{{ $values->id }}&search={{$values->search_name}}"><button class="btn2">Search</button></a></span>
                                 </span>
                                 <span class="js-button-edit minor-button-v2">
                                 <span><button data-toggle="modal" data-target="#myModal_{{ $values->id }}" class="grey-btn">Edit</button></span></span>
                                 <!-- <form action="{{url('/search-edit')}}" id="formDeleteProduct" method="POST" >
                                 {{csrf_field()}}

                                 <input type="submit" class="deleteProduct" id="btnDeleteProduct" name="delete">
                               </form> -->
                                 
                              </footer>




                              <div id="myModal_{{ $values->id }}" class="modal fade" role="dialog">
                                   <div class="modal-dialog">

                                     <!-- Modal content-->
                                     <div class="modal-content">
                                       <div class="modal-header">
                                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                         <h4 class="modal-title" style="text-align: center">Edit Your Search</h4>
                                       </div>
                                         <div class="modal-body">
                                          
                                             <form method="post" action="{{url('/search-edit?id=')}}{{ $values->id }}">
                                             {{csrf_field()}}
                                                <input value="{{ Session::get('id')}}" type="hidden" name="user_id"> 
                                             <div id="tabs-1">
                                                      <div class="js-mod-body mod-body">
                                                         <div class="basic-search-options">
                                                            <h5>Searching for Women interested in Men</h5>
                                                            <div class="input" style="padding: 19px 25px 5px;" >
                                                               Ages 
                                                               <input class="js-criteria-age-min age-input" type="text" name="from_age" value="{{ $values->from_age }}"> 
                                                               to <input class="js-criteria-age-max age-input" value="{{ $values->to_age }}" name="to_age" type="text">
                                                            </div>
                                                            <div class="input" style="padding: 19px 25px 10px;">
                                                               Location:  <strong class="js-location-string">Sec-27 Noida</strong> (<a href="#">edit</a>)
                                                            </div>
                                                            <div class="input" style="padding: 19px 25px 20px;">
                                                               Search distance:  
                                                               <select  name="location" class="js-criteria-distance">
                                                                  <option value="{{ $values->location }}" selected="selected">{{ $values->location }} km</option>
                                                                  <option value="5">5 km</option>
                                                                  <option value="10">10 km</option>
                                                                  <option value="15">15 km</option>
                                                                  <option value="30">30 km</option>
                                                                  <option value="80">80 km</option>
                                                                  <option value="160">160 km</option>
                                                               </select>
                                                            </div>
                                                         </div>

                                                            <div class="height-option">
                                                               <div class="xyz" style="padding: 0px 25px ">
                                                                  Height between  
                                                                  <select class="js-criteria-height-min" name="from_height">
                                                                     <option value="0"> -- </option>
                                                                     @for ($i = 91; $i <= 241 ; $i++)
                                                                     <option selected="selected"  value="{{ $values->from_height }}"> {{ $values->from_height }} </option>
                                                                     @endfor  
                                                                  </select>
                                                                  and
                                                                  <select class="js-criteria-height-max" name="to_height">
                                                                     <option  value="0">--</option>
                                                                     @for ($i = 91; $i <= 241 ; $i++)
                                                                     <option selected="selected" value="{{ $values->to_height }}"> {{ $values->to_height }} </option>
                                                                     @endfor 
                                                                  </select>
                                                               </div>
                                                               <div class="input" style="padding: 19px 25px 10px;">
                                                                  Looking For:  
                                                                  <select name="looking_for" class="js-criteria-distance">
                                                                     <option value="0" > Looking For</option>
                                                                     <option value="male" @if($values->relationship == 1) selected @endif>Male</option>
                                                                     <option value="female" @if($values->relationship == 1) selected @endif>Female</option>
                                                       
                                                                  </select>
                                                               </div>

                                                               <div class="row">
                                                                  <div class="col-lg-4 edit-container">
                                                                     <h3 class="">Relationship</h3>
                                                                     <ul class="js-search-category">
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-relationship" name="relationship[]" value="1" @if($values->relationship == 1) checked @endif  type="checkbox" >
                                                                           <span class="label-text">Never married</span>
                                                                           </label>
                                                                        </div>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-relationship" name="relationship[]" value="2" @if($values->relationship == 2) checked @endif type="checkbox"><span class="label-text">Separated</span>
                                                                           </label>
                                                                        </div>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-relationship" name="relationship[]" value="3" @if($values->relationship == 3) checked @endif type="checkbox"><span class="label-text">Divorced</span>
                                                                           </label>
                                                                        </div>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-relationship" name="relationship[]" value="4" @if($values->relationship == 4) checked @endif type="checkbox"><span class="label-text">Widowed</span>
                                                                           </label>
                                                                        </div>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-relationship" name="relationship[]" value="5" @if($values->relationship == '5') checked @endif type="checkbox"><span class="label-text">Tell you later</span>
                                                                           </label>
                                                                        </div>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-any" value="any" @if($values->relationship == 'any') checked @endif name="relationship[]" type="checkbox"><span class="label-text">Any</span>
                                                                           </label>
                                                                        </div>
                                                                     </ul>
                                                                  </div>
                                                                  <div class="col-lg-4 edit-container">
                                                                     <h3 class="">Children</h3>
                                                                     <div class="js-search-category">
                                                                        <label>
                                                                        <input class="js-criteria-children" name="children[]" @if($values->children == 1) checked @endif value="1" type="checkbox"><span class="label-text">No</span>
                                                                        </label>
                                                                     </div>
                                                                     <div>
                                                                        <label>
                                                                        <input class="js-criteria-children" name="children[]" @if($values->children == 2) checked @endif value="2" type="checkbox"><span class="label-text">Yes, at home with me</span>
                                                                        </label>
                                                                     </div>
                                                                     <div>
                                                                        <label>
                                                                        <input class="js-criteria-children" name="children[]" @if($values->children == 3) checked @endif value="3" type="checkbox"><span class="label-text">Yes, but they don't live with me</span>
                                                                        </label>
                                                                     </div>
                                                                     <div>
                                                                        <label>
                                                                        <input class="js-criteria-any" value="any" name="children[]" @if($values->children == 'any') checked @endif  type="checkbox"><span class="label-text">Any</span></label>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-lg-4 edit-container">
                                                                     <h3 class="">Ethnicity</h3>
                                                                     @for($j = 0; $j < count($ethnicity); $j++)

                                                                     <div class="js-search-category">
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-ethnicity" name="ethnicity[]" @if($ethnicity[$j] == 7) checked @endif  value="7" type="checkbox"><span class="label-text">White/Caucasian</span>
                                                                           </label>
                                                                        </div>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-ethnicity" name="ethnicity[]" @if($ethnicity[$j] == 2) checked @endif value="2" type="checkbox"><span class="label-text">Black/African</span>
                                                                           </label>
                                                                        </div>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-ethnicity" name="ethnicity[]" value="3" @if($ethnicity[$j] == 3) checked @endif type="checkbox"><span class="label-text">Latino/Hispanic</span>
                                                                           </label>
                                                                        </div>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-ethnicity" name="ethnicity[]" @if($ethnicity[$j] == 1) checked @endif value="1" type="checkbox"><span class="label-text">Asian</span>
                                                                           </label>
                                                                        </div>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-ethnicity" name="ethnicity[]" @if($ethnicity[$j] == 9) checked @endif value="9" type="checkbox"><span class="label-text">Indian</span>
                                                                           </label>
                                                                        </div>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-ethnicity" name="ethnicity[]" @if($ethnicity[$j] == 4) checked @endif value="4" type="checkbox"><span class="label-text">Middle Eastern</span>
                                                                           </label>
                                                                        </div>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-ethnicity" name="ethnicity[]" @if($ethnicity[$j] == 8) checked @endif value="8" type="checkbox"><span class="label-text">Mixed/Other</span>
                                                                           </label>
                                                                        </div>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-any" @if($ethnicity[$j] == 'any') checked @endif value="any" name="ethnicity[]" type="checkbox"><span class="label-text">Any</span>
                                                                           </label>
                                                                        </div>
                                                                     </div>
                                                                     @endfor
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div  class="col-lg-4 edit-container">
                                                                     <h3 class="">Religion</h3>
                                                                     <ul class="js-search-category">
                                                                        <div><label><input class="js-criteria-redivgion" value="1" name="religion[]" @if($values->religion == 1) checked @endif type="checkbox"><span class="label-text">Agnostic</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-redivgion" name="religion[]" value="2" @if($values->religion == 2) checked @endif type="checkbox"><span class="label-text">Atheist</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-redivgion" name="religion[]" value="3" @if($values->religion == 3) checked @endif type="checkbox"><span class="label-text">Buddhist</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-redivgion" name="religion[]" value="4" @if($values->religion == 4) checked @endif type="checkbox"><span class="label-text">Christian</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-redivgion" name="religion[]" @if($values->religion == 5) checked @endif value="5" type="checkbox"><span class="label-text">Christian - Catholic</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-redivgion" name="religion[]" value="6" @if($values->religion == 6) checked @endif type="checkbox"><span class="label-text">Jewish</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-redivgion" name="religion[]" value="7" @if($values->religion == 7) checked @endif type="checkbox"><span class="label-text">Hindu</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-redivgion" name="religion[]" value="8" @if($values->religion == 8) checked @endif type="checkbox"><span class="label-text">Muslim</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-redivgion" name="religion[]" value="9" @if($values->religion == 9) checked @endif type="checkbox"><span class="label-text">Spiritual</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-redivgion" name="religion[]" value="10" @if($values->religion == 10 ) checked @endif type="checkbox"><span class="label-text">Other</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-any" value="any" name="religion[]" @if($values->religion == 'any') checked @endif type="checkbox"><span class="label-text">Any</span></label>
                                                                        </div>
                                                                     </ul>
                                                                  </div>
                                                                  <div  class="col-lg-4 edit-container">
                                                                     <div class="advanced-search-category">
                                                                        <h3 class="">Education</h3>
                                                                        <div>
                                                                           <label>
                                                                           <input class="js-criteria-education" value="6" @if($values->education == 6 ) checked @endif type="checkbox"><span class="label-text">No degree</span>
                                                                           </label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-education" name="education[]" value="1" @if($values->education == 1 ) checked @endif type="checkbox"><span class="label-text">High school graduate</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-education" name="education[]" value="2" @if($values->education == 2 ) checked @endif type="checkbox"><span class="label-text">Attended college</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-education" name="education[]" value="4" @if($values->education == 4 ) checked @endif type="checkbox"><span class="label-text">College graduate</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-education" name="education[]" value="5" @if($values->education == 5 ) checked @endif type="checkbox"><span class="label-text">Advanced degree</span></label>
                                                                        </div>
                                                                        <div><label><input value="any" @if($values->education == 'any' ) checked @endif
                                                                         class="js-criteria-any" name="education[]" type="checkbox"><span class="label-text">Any</span></label>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div  class="col-lg-4 edit-container">
                                                                     <h3 class="">Body Type</h3>
                                                                     <ul class="js-search-category">
                                                                        <div>
                                                                           <label><input class="js-criteria-body_type" name="body_type[]" value="1" @if($values->body_type == 1 ) checked @endif  type="checkbox"><span class="label-text">Slim</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-body_type" name="body_type[]" value="2" @if($values->body_type == 2 ) checked @endif  type="checkbox"><span class="label-text">Athletic</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-body_type" name="body_type[]" value="3" @if($values->body_type == 3 ) checked @endif  type="checkbox"><span class="label-text">Average</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-body_type" name="body_type[]" value="4" @if($values->body_type == 4 ) checked @endif  type="checkbox"><span class="label-text">Curvy</span></label>
                                                                        </div>
                                                                        <div><label><input class="js-criteria-any" name="smoking[]" value="any" @if($values->body_type == 'any' ) checked @endif  type="checkbox"><span class="label-text">Any</span></label>
                                                                        </div>
                                                                     </ul>
                                                                  </div>
                                                               </div>
                                                      <div class="row">
                                                         <div  class="col-lg-4 edit-container">
                                                            <div class="advanced-search-category">
                                                            <h3 class="">Smoking</h3>
                                                            <ul class="js-search-category">
                                                               <div>
                                                                  <label>
                                                                     <input class="js-criteria-smoking" name="smoking[]"  value="1" @if($values->smoking == 1 ) checked @endif  type="checkbox">
                                                                     <span class="label-text">
                                                                        No
                                                                     </span>
                                                                  </label>
                                                               </div>
                                                               <div>
                                                                  <label>
                                                                     <input class="js-criteria-smoking" name="smoking[]" value="2" @if($values->smoking == 2 ) checked @endif  type="checkbox"><span class="label-text">Yes, socially</span>
                                                                  </label>
                                                               </div>
                                                               <div>
                                                                  <label>
                                                                     <input class="js-criteria-smoking" name="smoking[]" value="3" @if($values->smoking == 3 ) checked @endif  type="checkbox">
                                                                     <span class="label-text">
                                                                        Yes, regularly
                                                                     </span>
                                                                  </label>
                                                               </div>
                                                               <div>
                                                                  <label>
                                                                     <input class="js-criteria-any" value="any" @if($values->smoking == 'any' ) checked @endif  name="smoking[]" type="checkbox">
                                                                     <span class="label-text">
                                                                        Any
                                                                     </span>
                                                                  </label>
                                                               </div>
                                                            </ul>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <!--/advanced-search-options-->
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="modal-footer" style="text-align: left !important">
                                             <div id="footer">
                                                <div class="paginate">
                                                   <p ><a href="#">Reset</a></p>
                                                   <div class="save-search-option js-save-this-search-container">
                                                      <p>
                                                         <input class="js-save-this-search-checkbox" id="show1"  name="save_me" type="checkbox"> Save this search
                                                      </p>
                                                      <div class="input-method"  id="save_for1" style="display: none">
                                                         <input maxlength="50" class="js-save-search-input-text save-search-field" placeholder="Enter search name" name="search_name" type="text">
                                                         <div class="js-error-empty-name form-error" style="display:none">Please enter a name for this saved search.</div>
                                                         <div class="js-error-exists-name form-error" style="display:none">You already have a search saved by this name.</div>
                                                         <div class="js-error-max-reached form-error" style="display:none">You have reached the maximum number of saved searches. To save this search, delete one from Saved Searches.</div>
                                                         <div id="submit" tabindex="0">
                                                            <input class="btn2" type="submit" name="save" id="save" value="Save and Search" >
                                                            <input class="btn2" type="Reset" value="Cancel">
                                                         </div>
                                                      </div>
                                                      <div  class="action-container" id="hide_for1">
                                                         <input class="btn2" type="submit" name="save" id="save" value="Search" >
                                                         <input class="btn2" type="Reset" value="Cancel">
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                       </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              @endfor
                           </div>
                        </div>
                        @endforeach
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
   $(document).ready(function(){
   
      $('.bxslider').bxSlider({
         nextSelector: '#slider-next',
         prevSelector: '#slider-prev',
         nextText: 'Next',
         prevText: 'Prev'
      });
      $('.bxslider2').bxSlider({
         nextSelector: '#slider-next2',
         prevSelector: '#slider-prev2',
         nextText: 'Next',
         prevText: 'Prev'
      });
   
   });
   
   $(function() {
   
      $( "#tabs" ).tabs();
   
   });
   
</script>
<script type="text/javascript">
   $(function () {
      $("#advance").click(function (){
         $("#advance").hide();
      });
   });
   
   
  $(function () {
      $("#show").click(function () {
          if ($(this).is(":checked")) {
              $("#save_for").show();
              $("#hide_for").hide();
              alert(this.val());
          } else {
              $("#save_for").hide();
              $("#hide_for").show();
          }
      });
  });

  $(function () {
      $("#show1").click(function () {
          if ($(this).is(":checked")) {
              $("#save_for1").show();
              $("#hide_for1").hide();
              alert(this.val());
          } else {
              $("#save_for1").hide();
              $("#hide_for1").show();
          }
      });
  });

</script>
<script type="text/javascript">
   $('.deleteProduct').on('click', function(e) {
    var inputData = $('#formDeleteProduct').serialize();

    var dataId = $('#btnDeleteProduct').attr('data-id');

    $.ajax({
        url: "{{ url('/search-edit') }}" + '/' + dataId,
        type: 'POST',
        data: inputData,
        success: function( msg ) {
            if ( msg.status === 'success' ) {
                toastr.success( msg.msg );
                setInterval(function() {
                    window.location.reload();
                }, 5900);
            }
        },
        error: function( data ) {
            if ( data.status === 422 ) {
                toastr.error('Cannot delete the category');
            }
        }
    });

    return false;
});
</script>
@stop