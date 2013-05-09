<table class="table table-bordered table-striped">
   <tr>
       <th>{{ trans('immigration.type') }}</th>
       <th>{{ trans('immigration.sent') }}</th>
       <th>{{ trans('immigration.co') }}</th>
       <th>{{ trans('immigration.fn') }}</th>  
       <th>{{ trans('immigration.me') }}</th>  
       <th>{{ trans('immigration.mes') }}</th>
       <th>{{ trans('immigration.mer') }}</th>
       <th>{{ trans('immigration.pr') }}</th>
       <th>{{ trans('immigration.office') }}</th>
   </tr>
   @foreach ($applications as $app)
   <tr>
      <td>
         {{ $app->type }}
      </td>
      <td>
         @if ( $app->sent == '1970-01-01' )
              N/A 
         @elseif ( $app->sent == '0000-00-00' )
              N/A 
         @else
             {{ $app->sent }}
         @endif
      </td>
      <td>
         @if ( $app->co == '1970-01-01' )
              N/A
         @elseif ($app->co == '0000-00-00')
              N/A 
         @else
             {{ $app->co }}
         @endif
      </td>
      <td>
         @if ( $app->fn == '1970-01-01' )
             N/A 
         @elseif ( $app->fn == '0000-00-00' )
             N/A
         @else
             {{ $app->fn }}
         @endif
      </td>
      <td>
         @if ( $app->me == '1970-01-01' )
              N/A
         @elseif ( $app->me == '0000-00-00' )
              N/A 
         @else
             {{ $app->fn }}
         @endif
      </td>
      <td>
         @if ( $app->mes == '1970-01-01' )
             N/A 
         @elseif ( $app->mes == '0000-00-00' )
             N/A
         @else
             {{ $app->fn }}
         @endif
      </td>
      <td>
        @if ( $app->mer == '1970-01-01' )
            N/A 
         @elseif ( $app->mer == '0000-00-00' )
            N/A  
         @else
             {{ $app->fn }}
         @endif
      </td>
      <td>
         @if ( $app->pr == '1970-01-01' )
             N/A 
         @elseif ( $app->pr == '0000-00-00' )
             N/A 
         @else
             {{ $app->fn }}
         @endif
      </td>
      <td>
         {{ $app->office }}
      </td>
   </tr>
   @endforeach
</table>
<!-- pagination -->
{{ $applications->links() }}