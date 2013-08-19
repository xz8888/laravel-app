	
<script type="text/javascript">
$(document).ready(function(){
	$('.stats_popover').popover(
     {
     	trigger: "hover"
     }
	);
})
</script>

<div class="applicants-stats-module white-box">
   <h1 class="title">
    {{ trans('common.current_month') }}{{ trans('immigration.applicants_stats')}}
   </h1>
   <ul class="stats-list medium-text">
      <li>
      	<div class="row">
          <div class="col-lg-2">
          	<span class="stats_popover" data-toggle="popover"  data-placement="left" data-content = "{{ trans('immigration.co_explain') }}" title="{{ trans('immigration.co') }}" >CO:</span>
          </div>
          <div class="col-lg-6">
             <span class="red-text"> <?php echo $stats['sent_total']; ?> <i class="icon-male"></i></span> 
          </div>
      	</div>
      </li>

      <li>
       <div class="row">
          <div class="col-lg-2">
      	     <span class="stats_popover" data-toggle="tooltip" data-placement="left" data-content = "{{ trans('immigration.fn_explain') }}" title="{{ trans('immigration.fn')  }}" >FN:</span> 
          </div>
          <div class="col-lg-6">
      	     <span class="red-text"><?php echo $stats['cash_out_total'];?> <i class="icon-male"></i></span> 
      	  </div>
      </li>

      <li>
       <div class="row">
          <div class="col-lg-2">
      	     <span class="stats_popover" data-toggle="tooltip" data-placement="left" data-content = "{{ trans('immigration.me_explain') }}" title="{{ trans('immigration.me')  }}" >ME:</span> 
      	  </div>
          <div class="col-lg-6">
      	     <span class="red-text"><?php echo $stats['me_total'];?> <i class="icon-male"></i></span> 
      	  </div>
      </li>

      <li>
      	<div class="row">
          <div class="col-lg-2">
      	     <span class="stats_popover" data-toggle="tooltip" data-placement="left" data-content = "{{ trans('immigration.pr_explain') }}" title="{{ trans('immigration.pr') }}" >PR:</span> 
      	 </div>
         <div class="col-lg-6">
      	     <span class="red-text"><?php echo $stats['pr_total'];?> <i class="icon-male"></i></span> 
      	 </div>
      </li>
   </u>
</div>