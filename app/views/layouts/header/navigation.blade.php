<div class="container">
  <div class="navbar  navbar-orange">
	  <div class="navbar-inner">
		  <ul class="nav">
		      <li><a href="/"><i class="icon-home"></i>{{  trans('navigation.top_menu home') }} </a> </li>
		  </ul>	
		  <ul class="nav nav-pills pull-right">
			 <?php 
			  if(Sentry::check()):
			     $user = Sentry::getUser();
			  ?>
			  <li class="dropdown pull-right">
			      <a href="/user/my" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="icon-user"></i>{{ $user->username; }}</a>
			      <ul class="dropdown-menu" role="menu">
			          <li>
			             <a href="/user/edit"><i class="icon-cog"></i>{{ trans('user.setting')}}</a>
			          </li>
			          <li>
			             <a href="/user/edit"><i class="icon-folder-close"></i>{{ trans('common.my_application') }}</a>
			          </li>

			      </ul>
			  </li>
			  <li>
			       <a href="/user/logout"><i class="icon-folder-close"></i>{{ trans('user.logout') }}</a>
			  </li>
			  <?php else:?>
			  <li><a href="/user/login"><i class="icon-user"></i>{{ trans('user.login') }}</a></li>
			  <?php endif;?>
	       </ul> 
	  </div>
  </div>
</div>
<div class="container">
   <div class="row">
     <div class="span3">
        <div class="logo">
            <img src="/img/logo.png" />
         </div>
     </div>
     <div class="span9">
     </div>
   </div>
</div>