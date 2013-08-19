<script type="text/javascript">
   $(document).ready(function(){

      var theDate = $('.datepicker').datepicker({format: 'yyyy-mm-dd'}).on('changeDate', function(ev){
          $(this).datepicker('hide');
      })
   });
</script>
<div class="create-form white-box">
    <div class="row">
        <div class="col-lg-12">
        {{ Form::open(array('url' => 'share')) }}
          <legend> <i class="icon-pencil"></i> {{ trans('immigration.create') }}</legend>

          <div class="row">

            <!-- first part started !-->
            <div class="col-lg-3">
                <div class="form-group">
                 {{ Form::label('type', Lang::get('immigration.type')) }}
                     <div class="row">
                        <div class="col-lg-5">
                         {{ Form::select('type', array('unknown' => '', 'pnp' => Lang::get('immigration.pnp'), 
                                         'cec' => Lang::get('immigration.cec'), 
                                         'sponsor' => Lang::get('immigration.sponsor')), array('class' => 'form-control'))
                         }}
                        </div>
                      </div>
                </div>

                <div class="form-group">
                   {{ Form::label('office', Lang::get('immigration.office')) }}
                    <div class="row">
                        <div class="col-lg-5">
                        {{ Form::select('office', array('unknown' => '', 'ottawa' => Lang::get('immigration.ottawa'), 
                                              'buffalo' => Lang::get('immigration.buffalo'),
                                              'beijing' => Lang::get('immigration.beijing')), array('class' => 'datepicker form-control')) }}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('transfer', Lang::get('immigration.transfer')) }}
                    <div class="row">
                        <div class="col-lg-5">
                            {{ Form::select('transfer', array('unknow' =>'' , 'ottawa' => Lang::get('immigration.ottawa'), 
                                              'buffalo' => Lang::get('immigration.buffalo'),
                                              'beijing' => Lang::get('immigration.beijing')), array('class' => 'datepicker form-control')) }}
                        </div>
                    </div>
                </div>
            </div>

            <!--second part started !-->
            <div class="col-lg-3">
              <div class="form-group">
                {{ Form::label('sent_date', Lang::get('immigration.sent_date')) }}
                <div class="row">
                    <div class="col-lg-12">
                       {{ Form::text('sent', '', array('class' => 'datepicker form-control', 'placeholder' => trans('immigration.required'))) }}
                   </div>
                </div>
             </div>

             <div class="form-group">
                {{ Form::label('co', Lang::get('immigration.co')) }}
                  <div class="row">
                    <div class="col-lg-12">
                        {{ Form::text('co', '', array('class' => 'datepicker form-control', 'placeholder' => trans('immigration.cash_out_time'))) }}
                    </div>
                </div>
             </div>

             <div class="form-group">
                {{ Form::label('fn', Lang::get('immigration.fn')) }}
                  <div class="row">
                    <div class="col-lg-12">
                        {{ Form::text('fn', '', array('class' => 'datepicker form-control', 'placeholder' => trans('immigration.file_number_time'))) }}
                    </div>
                </div>
             </div>

             <div class="form-group">
                {{ Form::label('me', Lang::get('immigration.me')) }}
                  <div class="row">
                    <div class="col-lg-12">
                        {{ Form::text('me', '', array('class' => 'datepicker form-control', 'placeholder' => trans('immigration.medical_exam_time'))) }}
                    </div>
                </div>
             </div>
            </div>

            <!-- third part started !-->
            <div class="col-lg-3">
                            <div class="form-group">
                {{ Form::label('mes', Lang::get('immigration.mes')) }}
                  <div class="row">
                    <div class="col-lg-12">
                        {{ Form::text('mes', '', array('class' => 'datepicker form-control', 'placeholder' => trans('immigration.medical_send_time'))) }}
                    </div>
                </div>
             </div>

             <div class="form-group">
                {{ Form::label('mer', Lang::get('immigration.mer')) }}
                  <div class="row">
                    <div class="col-lg-12">
                        {{ Form::text('mer', '', array('class' => 'datepicker form-control', 'placeholder' => trans('immigration.medical_receive_time'))) }}
                    </div>
                </div>
             </div>

              <div class="form-group">
                {{ Form::label('pr', Lang::get('immigration.pr')) }}
                  <div class="row">
                    <div class="col-lg-12">
                        {{ Form::text('pr', '', array('class' => 'datepicker form-control', 'placeholder' => trans('immigration.permanent_residence_time'))) }}
                    </div>
                </div>
             </div>

          </div>

          <div class="col-lg-3">
             <div class="form-group">
                    {{ Form::label('comment', Lang::get('immigration.comment')) }}
                    <div class="row">
                        <div class="col-lg-12">
                        {{ Form::textarea('comment', '', array('class' => 'form-control')) }}
                        </div>
                    </div>
                </div>
            </div>
          </div>
         

          {{ Form::token() }}
          
          {{ Form::submit(Lang::get('common.submit'), array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
        </div>
    </div>
</div>
