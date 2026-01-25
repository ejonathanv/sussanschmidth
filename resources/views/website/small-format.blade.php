<x-website-layout description="{{ $smallFormat->title }}">
	@if($next != null)
	<a href="{{route('small-format', $next->slug)}}" class="control prev"><i class="ion-ios-arrow-left"></i></a>
	@endif
	@if($prev != null)
	<a href="{{route('small-format', $prev->slug)}}" class="control next"><i class="ion-ios-arrow-right"></i></a>
	@endif
	<div class="archive">
		<div class="image">
			@php
				$imageUrl = $smallFormat->image ?: 'https://placehold.co/1600x900';
			@endphp
			<div class="zoom-img" data-modal="{{asset($imageUrl)}}">
				<img src="{{asset($imageUrl)}}" alt="{{ $smallFormat->description ?? $smallFormat->title }}">
			</div>
			<p>{{$smallFormat->title}}, {{$smallFormat->year}}. {{$smallFormat->category}}, {{$smallFormat->height}} x {{$smallFormat->width}} cms.</p>
			
			@if($smallFormat->digital_info)
				{!! $smallFormat->digital_info !!}
			@endif
		</div>
		<div class="helper"></div>
	</div>

	@push('scripts')
	<script src="{{asset('assets/js/jquery.zoom.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			var screen_size = $(window).width();

			if(screen_size > 1024){

				$('.zoom-img').zoom(
					{
						url: '{{asset($imageUrl)}}',
						on: 'mouseover'
					}
				);
				
			}

		});
	</script>
	@endpush
</x-website-layout>