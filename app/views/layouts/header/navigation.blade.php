<div class="container">
  <div class="navbar navigation-bar-juzi">
		  <ul class="nav navbar-nav">
		      <li><a href="/"><i class="icon-home"></i> {{  trans('navigation.top_menu home') }} </a> </li>
		      <li><a href="/applications"><i class="icon-globe"></i> {{  trans('navigation.top_menu immigration') }} </a> </li>
              <li><a href="/question"><i class="icon-key"></i> {{  trans('navigation.top_menu question') }} </a> </li>

		  </ul>	
		  <ul class="nav navbar-nav pull-right">
			 <?php 
			  if(Sentry::check()):
			     $user = Sentry::getUser();
			  ?>
			  <li class="dropdown pull-right ">
			      <a href="/my" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="icon-user"></i> {{ $user->username; }}</a>
			      <ul class="dropdown-menu" role="menu">
			          <li>
			             <a href="/my"><i class="icon-cog"></i> {{ trans('user.setting')}}</a>
			          </li>
			          <li>
			             <a href="/my"><i class="icon-folder-close"></i> {{ trans('common.my_application') }}</a>
			          </li>

			      </ul>
			  </li>
			  <li>
			       <a href="/user/logout"><i class="icon-folder-close"></i> {{ trans('user.logout') }}</a>
			  </li>
			  <?php else:?>
			  <li><a href="/user/login"><i class="icon-user"></i> {{ trans('user.login') }}</a></li>
			  <?php endif;?>
	       </ul> 
  </div>
</div>
