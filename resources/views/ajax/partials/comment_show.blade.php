<div class='showed-comment ajax-comment'>
    <div class="pastcomment" id="inactive">
        <p><span><b>{{ $comment->commenter }}</b>&nbsp;says:</span>{{ $comment->comment }}</p>
        <p class="commentdate">on {{ date("D j M Y h:i:s A", unixtime($comment->created_at)) }} GMT</p>
    </div>
</div>