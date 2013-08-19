<div class="full-screen-module grey-box">
	<div class="container">
		<div class="row">

		   <!--register box starts -->
	       <div class="col-3 col-lg-3">
	          <div class="register-box green-box">
	          	   <a href="/user/register">
	          	      {{ trans('user.register welcome')}}
	          	   </a>
	          </div>
	       </div>
	       <!--register box ends -->

	       <div class="col-offset-6 col-lg-offset-6">
	           	   @include('home.forms.mini_login_form')
	       </div>
		</div>
    </div>
</div>