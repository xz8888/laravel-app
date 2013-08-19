<h4 class="title">{{ trans('immigration.progress') }}</h4>
<script>
//initialize the javascript 
$(document).ready(function(){
   $('#navigation_tab a:first').tab('show');

   $('#navigation_tab a').click(function(e){
       e.preventDefault();
       $(this).tab('show');
   })
})
</script>

<div>
	<ul class="nav nav-pills juzi-nav-pills" id="navigation_tab">
		<li class="active"><a data-toggle="tab" href="#cec">{{ trans('immigration.cec') }}</a></li>
	    <li><a data-toggle="tab"  href="#pnp">{{ trans('immigration.pnp') }}</a></li>
	    <li><a data-toggle="tab"  href="#fsw">{{ trans('immigration.fsw') }}</a></li>
	    <li><a data-toggle="tab"  href="#marriage">{{ trans('immigration.marriage') }}</a></li>
	</ul>
</div>

<div class="tab-content">
	<?php foreach($time_stats as $index => $time_stat):?>
	<div class="time-stats-box tab-pane clearfix <?php if($index == 0) echo "active in"; else echo "fade"; ?>" id="{{ $time_stat->type }}">
	    <ul>
	    	<li>
	    		<h5>{{ trans('immigration.co')}}</h5>
	            <span class="large-text">{{ $time_stat->cash_out_time}}{{ trans('immigration.days') }}</span>
	    	</li>

	        <li>
	        	<h5>{{ trans('immigration.fn')}}</h5>
	        	<span class="large-text"> {{ $time_stat->fn_time }}{{ trans('immigration.days') }}</span>
	        </li>
	    	<li>
	           <h5>{{ trans('immigration.me')}}</h5>
	           <span class="large-text">{{ $time_stat->medical_exam_request_time + $time_stat->medical_sent_time + $time_stat->medical_receive_time }}{{ trans('immigration.days') }}</span>
	    	</li>
	        <li>
	           <h5>{{ trans('immigration.pr')}} </h5>
	           <span class="large-text">{{ $time_stat->pr_time }}{{ trans('immigration.days') }}</span>
	        </li>
	        <li>
	           <h5>{{ trans('immigration.total')}}</h5>
	           <span class="large-text">{{ $time_stat->total_wait_time }}{{ trans('immigration.days') }}</span>
	        </li>
	    </ul>
	</div>
	<?php endforeach;?>
</div>