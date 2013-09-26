@extends('layouts.juzi_admin')

@section('content')
<div class="container">
	<div class="row">
		<ul>
			<li><a href = "/admin/applications/add">Create a new application</a></li>
		</ul>
	</div>
</div>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <h1 class="title">{{ trans('immigration.application_time')}}</h1>
      </div>
   </div>
   <div class="row">
   	 <div class="col-md-12">
	   	 <table class="table table-striped table-hover">
	   	 	<tr>
	   	 		<th>
	   	 			id
	   	 		</th>
	   	 		<th>
	   	 			{{ trans('immigration.sent') }}
	   	 		</th>
	            <th>
	            	{{ trans('immigration.fn')}}
	            </th>
	            <th>
	            	{{ trans('immigration.me') }}
	            </th>
	            <th>
	            	{{ trans('immigration.pr') }}
	            </th>
	            <th>
	            	{{ trans('immigration.office') }}
	            </th>
	            <th>
	            	{{ trans('immigration.type') }}
	            </th>
	            <th>
	            	Actions
	            </th>
	   	 	</tr>
	   	 	<?php foreach($applications as $application):?>
	           <tr>
	           	  <td>{{ $application->id }}</td>
	              <td>@if ($application->sent != '0000-00-00' && $application->sent != '1970-00-00')
	              	   {{ $application->sent }}
                      @else
                       {{ trans('common.unknown') }}
                      @endif
	              </td>
	               <td>@if ($application->fn != '0000-00-00' && $application->fn != '1970-00-00')
	              	   {{ $application->fn }}
                      @else
                       {{ trans('common.unknown') }}
                      @endif
	              </td>
	               <td>@if ($application->me != '0000-00-00' && $application->me != '1970-00-00')
	              	   {{ $application->me }}
                      @else
                       {{ trans('common.unknown') }}
                      @endif
	              </td>
	              <td>@if ($application->pr != '0000-00-00' && $application->pr != '1970-00-00')
	              	   {{ $application->pr }}
                      @else
                       {{ trans('common.unknown') }}
                      @endif
	              </td>
	              <td>{{ $application->office }}</td>
	              <td>{{ $application->type }}</td> 
	              <td>
	              	 <ul>
	              	 	<li><a href="/admin/applications/delete/{{ $application->id }}">Delete</a></li>
	              	 </ul>
	              </td>
	           </tr>
	   	    <?php endforeach;?>

	   	 </table>
   	 </div>
   </div>
</div>

<div class="container">
   <div class="row">
       <div class="col-md-12">
         <?php echo $applications->links(); ?>
       </div>
   </div>
</div>

@stop