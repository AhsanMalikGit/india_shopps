@if ($breadcrumbs)	
	<ul class="breadcrumb">
	<?php //print_r($breadcrumbs);exit;?>	
		@if($breadcrumbs[0]->title == "amp")
			@foreach ($breadcrumbs as $breadcrumb)	
				@if ($breadcrumb->url && !$breadcrumb->last && !$breadcrumb->first)
					<li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}&raquo;</a></li>
				@elseif(!$breadcrumb->first)
					<li class="active"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].str_replace("/amp","",$_SERVER['REQUEST_URI']); ?>">{{ $breadcrumb->title }}</a></li>
				@endif
			@endforeach	
		@else
			@foreach ($breadcrumbs as $breadcrumb)	
				@if ($breadcrumb->url && !$breadcrumb->last)
					<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{{ $breadcrumb->url }}}" itemprop="url">
						<span itemprop="title">{{ $breadcrumb->title }}</span>
					</a></li>
				@else
					<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="active"><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" itemprop="url"><span itemprop="title">{{ $breadcrumb->title }}</span></a></li>
				@endif	
			@endforeach	
		@endif	
	
	</ul>
@endif
