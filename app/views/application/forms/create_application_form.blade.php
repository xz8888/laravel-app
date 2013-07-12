<script type="text/javascript">
   $(document).ready(function(){

      $('.datepicker').datepicker({format: 'yyyy-mm-dd'})
   });
</script>
{{ Form::open(array('url' => 'share')) }}
  <?php
     
     //echo Form::label('title', Lang::get('answer.title'));

     echo Form::label('type', Lang::get('application.type'));
     echo Form::select('type', array('pnp' => Lang::get('application.pnp'), 
                                     'cec' => Lang::get('application.cec'), 
                                     'sponsor' => Lang::get('application.sponsor')));

     echo Form::label('sent_date', Lang::get('application.sent_date'));
     echo Form::text('sent_date', '', array('class' => 'datepicker'));

     echo Form::label('co', Lang::get('application.co'));
     echo Form::text('co', '', array('class' => 'datepicker'));

     echo Form::label('fn', Lang::get('application.fn'));
     echo Form::text('fn', '', array('class' => 'datepicker'));

     echo Form::label('me', Lang::get('application.me'));
     echo Form::text('me', '', array('class' => 'datepicker'));
   
     echo Form::label('mes', Lang::get('application.mes'));
     echo Form::text('mes', '', array('class' => 'datepicker'));

     echo Form::label('mer', Lang::get('application.mer'));
     echo Form::text('mer', '', array('class' => 'datepicker'));

     echo Form::label('pr', Lang::get('application.pr'));
     echo Form::text('pr');

     echo Form::label('office', Lang::get('application.office'));
     echo Form::select('office');
 
     echo Form::label('transfer', Lang::get('application.transfer'));
     echo Form::select('transfer');
     
     echo Form::label('comment', Lang::get('application.comment'));
     echo Form::textarea('comment');
     
     echo "<br />";

     echo Form::token();
     echo Form::submit(Lang::get('common.submit'), array('class' => 'btn'));

  ?>

{{ Form::close() }}