<?php
$sortBy = 'category';
$currentDate = "";
$sortedPost = [];

if(isset($_GET['sortBy']))
{
	$sortBy = $_GET['sortBy'];
}

if(count($widgetPosts) > 0) 
{
	if($sortBy == 'category')
	{
		$widgetPosts = $widgetPosts->groupBy('posttype');

	}
	else if($sortBy == 'date')
	{
		$widgetPosts = $widgetPosts->groupBy(function($item, $key)
		{
			return date("M Y", unixtime($item['created_at']));
		});

	}
}
?>

<div id="archiveCollection">
	<div id="archiveMonth4" class="archive_level_2">
		@forelse($widgetPosts as $key=>$value)

		<div id="monthHeader4" class="archive_level_3">
			<div class="archiveIcon"></div>
			<p>{{ $key }} ({{ count($widgetPosts[$key]) }})</p>					
		</div>
		<ul id="">         
			@forelse($value as $post)
			<li>
				<p>
					<a href="{{ route('blog.get', ['blog'=>$post]) }}">
						<span class="arcTitle">
						{{ $post->shorttitle }}
						</span>
						<span class="arcDate">
						{{ date("M Y", unixtime($post->created_at)) }}
						</span>
					</a>
				</p>
			</li>
			@empty
			@endforelse
		</ul>
		@empty
		@endforelse
	</div>
</div>
