<div class="create-form white-box">
    <div class="row">
        <div class="col-md-9">
        {{ Form::open(array('url' => 'admin/questions-create')) }}
          <legend> <i class="icon-pencil"></i>{{ trans('question.create') }}</legend>
          <div class="form-group">
             {{ Form::label('title', Lang::get('question.create-title')) }}
             {{ Form::text('title', '', array('placeholder' => trans('question.create'), 'class' => 'form-control')) }}
          </div>
          <div class="form-group">
             {{ Form::label('content', Lang::get('question.content')) }}
             {{ Form::textarea('content', '', array('class' => 'form-control')) }}
         </div>
          <div class="form-group">
              {{ Form::label('username', Lang::get('common.username')) }}
              {{ Form::text('username', '', array('class' => 'form-control')) }}
          </div>
          <div class="form-group">
              {{ Form::label('tags', Lang::get('common.tags')) }}
              {{ Form::text('tags', '', array('class' => 'form-control')) }}
         </div>
          {{ Form::token() }}
          
          {{ Form::submit(Lang::get('common.submit'), array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
        </div>
    </div>
</div>