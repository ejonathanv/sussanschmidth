<x-website-layout description="{{ $archive->title }}">
	@if($next != null)
	<a href="{{route('archive', [$startYear, $endYear, $next->slug])}}" class="control prev"><i class="ion-ios-arrow-left"></i></a>
	@endif
	@if($prev != null)
	<a href="{{route('archive', [$startYear, $endYear, $prev->slug])}}" class="control next"><i class="ion-ios-arrow-right"></i></a>
	@endif
	<div class="archive">
		<div class="image">
			<div class="zoom-img" data-modal="{{asset($archive->image)}}">
				<img src="{{asset($archive->image)}}" alt="{{ $archive->description }}">
			</div>
			<p>{{$archive->title}}, {{$archive->year}}. {{$archive->category}}, {{$archive->height}} x {{$archive->width}} cms.</p>
			@if($archive->status != 'null' && $archive->status != '')
			<p>{{$archive->status}}</p>
			@endif
			@if($archive->digital_info)
				{!! $archive->digital_info !!}
			@endif
		</div>
		<div class="helper"></div>
	</div>

	@push('scripts')
	<script src="{{asset('js/jquery.zoom.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			var screen_size = $(window).width();

			if(screen_size > 1024){

				$('.zoom-img').zoom(
					{
						url: '{{asset($archive->image)}}',
						on: 'mouseover'
					}
				);
				
			}

		});
	</script>
	@endpush
</x-website-layout>