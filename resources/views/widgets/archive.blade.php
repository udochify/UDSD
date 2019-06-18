<div class="widget_archive widget_parent">
	<div class="archive_level_1 widget_level_1 widget_header">
		<p>Archives</p>
		<div class="widget_option_btn" title="archive options"></div>
	</div>
	<div class="widget_options widget_level_1">
		<div class="ajax_select">
			{!! Form::open(['route' => 'archive.index']) !!}
				{!! Form::select('sortBy', [
						'date'=>'date',
						'category'=>'category'
					], $sortBy, ['class'=>'sort_by']) 
				!!}
				<noscript>
				{!! Form::submit('OK',
					[
						'class' => 'btn btn-info btn-lg',
					])
				!!}
				</noscript>
			{!! Form::close() !!}
			<!-- <span class="option_text">Sort&nbsp;by:&nbsp;</span> -->
		</div>
	</div>
	<div class="archive_level_1 widget_level_1 widget_content">
		<div class='ajax_content ajax_content_archive'>
			@include('partials.archive_index')
		</div>
	</div>
	<div class="archive_level_1 widget_level_1 widget_tail">
	</div>
</div>

