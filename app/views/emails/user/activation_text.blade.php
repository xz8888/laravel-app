{{ trans('email.thank register') }}
{{ trans('email.activation step')}}

<a href="http://juzi.ca/user/activation?email=<?php echo $email;?>&hash=<?php echo $activation_code;?>">http://juzi.ca/user/activation?email=<?php echo $email;?>&hash=<?php echo $activation_code;?></a>

 {{ trans('common.title') }} date('Y');