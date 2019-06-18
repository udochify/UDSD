<div id="archiveCollection">
	<div id="archiveMonth4" class="archive_level_2">
		@forelse($sortedPosts as $key=>$value)

		<div id="monthHeader4" class="archive_level_3">
			<div class="archiveIcon"></div>
			<p>{{ $key }} ({{ count($sortedPosts[$key]) }})</p>					
		</div>
		<ul id="">         
			@forelse($value as $post)
			<li>
				<p>
					<a href="{{ route('blog.show', ['blog'=>$post, 'sortBy'=>$sortBy, 'currentFloater'=>'archive', 'showFloater'=>$showFloater]) }}">
						<span class="arcTitle">
						{{ $post->shorttitle }}
						</span>
						<span class="arcDate">
						{{ date("M Y", unixtime($post->created_at)) }}
						</span>
    					<span class="posttype" style='display: none;'>{{ $post->posttype }}</span>
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
