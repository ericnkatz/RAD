<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>RAD</title>
	<link rel='stylesheet' href='/css/main.css'>
</head>
<body>

	<div id='fb-root'></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1495315797377628&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<header>
		<h1 class='logo'><img src='/images/reallyawesomedevelopers.png' alt='{{ $group['name'] }}'></h1>
		<p class='description'>{{ nl2br( $group['description'] ) }}</p>
	</header>
	<article>
		<?php 
		// ini_set('xdebug.var_display_max_depth', -1);
		// ini_set('xdebug.var_display_max_children', -1);
		// ini_set('xdebug.var_display_max_data', -1);
		// dd($feed); 
		$count = 0;
		?>
		@foreach($feed as $obj)
			@if ( property_exists($obj, 'message') )
			<?php

			$count++;

			$pattern = new \RedeyeVentures\GeoPattern\GeoPattern();
			$pattern->setString($obj->from->name);
	//		$pattern->setColor('#cccccc');
			if($count % 2 == 0) {
				$pattern->setBaseColor('#efefef');
				$pattern->setColor('#fefefe');
			}
		//	$pattern->setGenerator('sine_waves');
			$dataURL = $pattern->toDataURL();

			?>
		<div class='status @if( $count === 1) open @endif'>
			<div class='post post-{{ $obj->id }} {{ ($count % 2 == 0) ? 'odd' : '' }}' style='background-image: {{ $dataURL }}'>
				<img src='https://graph.facebook.com/{{ $obj->from->id }}/picture?type=large&height=150&width=150' title='{{ $obj->from->name }}' alt='{{ $obj->from->name }}' style='background-image: {{ $dataURL }}'>
				<div class='meta'>
					<p class='author'>{{ $obj->from->name }}</p>
					@if( property_exists($obj, 'likes') )
						<a href='#' class='likes'>
							<i class='fa fa-thumbs-up'></i> {{ count( $obj->likes->data ) }}
						</a>
					@else
						<a href='#' class='likes'><i class='fa fa-thumbs-o-up'></i> Like</a>
					@endif
					<time class='timestamp' datetime='{{ $obj->created_time }}'>
						{{ \Carbon\Carbon::createFromTimeStamp(strtotime($obj->created_time))->diffForHumans() }}
					</time>

				</div>
				<p class='message'>
					{{ nl2br($obj->message) }}
				</p>
				@if( property_exists($obj, 'comments') )
					
					<a href='#' class='more-comments'>
						@if( ! isset( $obj->comments->data[1] ) )
							<i class='fa fa-comment'></i> View 1 comment.
						@else 
							<i class='fa fa-comments'></i> View {{ count( $obj->comments->data ) }} comments.
						@endif
					</a>

					<ul class='comments'>
					@foreach($obj->comments->data as $comment)
						<li class='comment'>
							<img src='https://graph.facebook.com/{{ $comment->from->id }}/picture?type=square' title='{{ $comment->from->name }}' alt='{{ $comment->from->name }}'>
							<div class='comment-meta'>
								<p class='author'>{{ $comment->from->name }}</p>
								<time class='timestamp' datetime='{{ $comment->created_time }}'>
									{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_time))->diffForHumans() }}
								</time>

							</div>
							{{ nl2br( $comment->message ) }}

								<a href='#' class='likes'> 
									@if ( $comment->like_count > 0 )
										<i class='fa fa-thumbs-up'></i> {{ $comment->like_count }}
									@else
										
									@endif
								</a>
						</li>
					@endforeach
					</ul>
				@else 
					<a href='#' class='more-comments'><i class='fa fa-comment-o'></i> No comments yet.</a>
				@endif
			</div>
			<div class='drawer'>
				<a class='external' href='{{ $obj->actions[0]->link }}' target='_blank'><i class='fa fa-external-link'></i></a>
				@if( property_exists($obj, 'likes') )
					<a href='#' class='likes'><i class='fa fa-thumbs-up'></i> 
						@if( ! isset( $obj->likes->data[1] ) )
							{{ $obj->likes->data[0]->name }} likes this.
						@else
							{{ count($obj->likes->data) }} people like this.
						@endif
					</a>
				@else 
					<a href='#' class='likes'><i class='fa fa-thumbs-o-up'></i> 
						Like.
					</a>
				@endif
			</div>
		</div>
			@endif
		@endforeach
	</article>
	<script src='//code.jquery.com/jquery-2.1.1.min.js'></script>
	<script>
	$(function() {
		$('.post').click(function(e) {
			e.preventDefault();
			if(!$(this).parent().hasClass('open')) {
				$('.status.open').removeClass('open');
			}
			$(this).parent().toggleClass('open');
		})
		$('.more-comments').click(function(e) {
			e.preventDefault();
			$(this).closest('.status').toggleClass('show-comments');
		});
	});
	</script>
</body>
</html>