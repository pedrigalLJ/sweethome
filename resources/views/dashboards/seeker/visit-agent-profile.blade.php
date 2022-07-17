@extends('dashboards.seeker.layouts.app')
@section('title', 'Seeker | Agent Profile')

@section('content')
    <div class="container">
		@include('dashboards.agent.errors')
		@include('dashboards.seeker.styles.style')
        <div class="row">
            <div class="col-md-3">
				<div class="card mb-2">
					<div class="card-body box-profile">
						<div class="text-center">
							<img class="rounded" width="100px;" height="100px;"
								src="{{ asset('/storage/images/'. $agents->image) }}"
								alt="User profile picture">
						</div>
						<h3 class="text-center">{{ $agents->given_name.' '.$agents->last_name }}</h3>
					</div>
                </div>
				
                <div class="card fixed-aboutMe">
					<div class="card-header bg-primary">
						<h3 class="card-title text-white">{{ _('About Me') }}</h3>
					</div>
					<div class="card-body">
						<p class="text-muted text-justify">
							<span class="teaser">{{ Str::limit($agents->about, 80, '...')  }}</span>
							@if (Str::length($agents->about) > 90)
							<span class="more" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $agents->about }}">
								Show all
							</span>
							@endif
						</p>
						<strong><i class="fas fa-birthday-cake text-danger mr-1"></i> {{ $agents->agent_verification->birthdate }}</strong>
						<p class="text-muted">
							{{ _('Birthdate') }}
						</p>

						<hr>

						<strong><i class="fas fa-map-marker-alt text-danger mr-1"></i> {{ $agents->city.', '.$agents->province }}</strong>
						<p class="text-muted">{{ _('Location') }}</p>
						<hr>
						

						<strong><i class="fas fa-user-tie text-danger mr-1"></i> {{ $agents->agent_verification->license_no }}</strong>
						<p class="text-muted">
							{{ _('License No.') }}
						</p><hr>
						<strong><i class="fas fa-id-badge text-danger mr-1"></i><a href="#" data-toggle="modal" data-target="#viewID">{{ Str::limit($agents->agent_verification->id_picture, 20, '...')  }}</a></strong>
						<p class="text-muted">
							{{ _('Professional ID Card') }}
						</p>
						<p class="text-muted">
							<div class="modal fade" id="viewID" tabindex="-1" role="dialog" aria-labelledby="setAppoinmentRequestLabel">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											{{ _('Professional ID Card') }}
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											  <span aria-hidden="true">&times;</span>
											</button>
										  </div>
										<div class="modal-body">
											<img src="{{ asset('/storage/agent-id-pictures/'. $agents->agent_verification->id_picture) }}" alt="" class="img-fluid">
										</div>
									</div>
								</div>
							</div>
						</p>
					</div>
                </div>
			</div>
			<div class="col-md-9">
				<div class="card fixed-height">
					<div class="card-header bg-white text-uppercase font-weight-bold text-danger">
						{{ _('Comments') }}	<div class="float-right" id="rateYo"></div>
						{{-- RATING --}}
						<div class="float-right">
							{{ $rating = round($average_of_ratings) }}
                            
                            @foreach(range(1,5) as $i)
                            <span class="fa-stack" style="width:1em">
                                <i class="far fa-star fa-stack-1x"></i>
                                
                                @if($rating > 0)
									@if($rating > 0.5)
									<i class="fas fa-star fa-stack-1x"></i>
									@else
									<i class="fas fa-star-half fa-stack-1x"></i>
									@endif
                                @endif
                                @php $rating--; @endphp
                            </span>
                            @endforeach
							@if ($count_ratings->count() > 0)
								<span class="text-secondary font-weight-normal">/</span>{{ $count_ratings->total() }} &nbsp;Ratings
							@else
								<span class="text-secondary font-weight-normal">/</span>
								<span class="text-danger font-weight-normal"> No Ratings </span>
							@endif
						</div>
					</div>
					@if (!$ratings) {{-- if authenticated user wala pa nakarate --}}
						<div class="container text-center p-3">
							<a href="#" class="text-center text-danger text-capitalize" data-toggle="modal" data-target="#rate"><i class="fas fa-star"></i> Rate here</a>
							<hr class="text-secondary">
							<div class="modal fade rating-css" id="rate" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header bg-primary">
											{{ $agents->given_name.' '.$agents->last_name }}
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form action="{{ route('seeker.add-rating') }}" method="post">
											@csrf
											<input type="hidden" name="agent_id" value="{{ $agents->id }}">
											<div class="modal-body rate-modal mt-n3 text-center">
												<input type="radio" name="rate_star" id="rating1" value="1" checked>
												<label for="rating1" class="fa fa-star"></label>
												<input type="radio" name="rate_star" id="rating2" value="2">
												<label for="rating2" class="fa fa-star"></label>
												<input type="radio" name="rate_star" id="rating3" value="3">
												<label for="rating3" class="fa fa-star"></label>
												<input type="radio" name="rate_star" id="rating4" value="4">
												<label for="rating4" class="fa fa-star"></label>
												<input type="radio" name="rate_star" id="rating5" value="5">
												<label for="rating5" class="fa fa-star"></label>
												<textarea class="form-control mt-4" name="comment" id="exampleFormControlTextarea1" rows="3" placeholder="Write a comment..."></textarea>
											</div>
											<div class="modal-footer mt-2">
												<button type="submit" class="btn btn-danger mt-2">Submit</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					@endif <br>
					@foreach ($count_ratings as $rating)
						<div class="container">
							<div class="card">
								<div class="card-header">
									Reviewed on {{ date(' d M Y | h:i a', strtotime($rating->created_at)) }}
									@if ($rating->user->id == Auth::id())
										<a href="#" class="text-primary float-right" data-toggle="modal" data-target="#editRate">Edit</a>
										<div class="modal fade rating-css" id="editRate" role="dialog">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header bg-primary">
														{{ $agents->given_name.' '.$agents->last_name }}
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form action="{{ route('seeker.add-rating') }}" method="post">
														@csrf
														<input type="hidden" name="agent_id" value="{{ $agents->id }}">
														<div class="modal-body rate-modal mt-n3 text-center">
															@for ($i = 1; $i <= $rating->star_rate; $i++)
																<input type="radio" name="rate_star" id="rating{{ $i }}" value="{{ $i }}" checked>
																<label for="rating{{ $i }}" class="fa fa-star"></label>
															@endfor
															@for ($j = $rating->star_rate+1; $j <= 5; $j++  )
																<input type="radio" name="rate_star" id="rating{{ $j }}" value="{{ $j }}">
																<label for="rating{{ $j }}" class="fa fa-star"></label>
															@endfor
															<textarea class="form-control mt-4" name="comment" id="exampleFormControlTextarea1" rows="3" placeholder="Write a comment...">{{ $rating->comment }}</textarea>
														</div>
														<div class="modal-footer mt-2">
															<button type="submit" class="btn btn-danger mt-2">Submit</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									@endif
								</div>
								<div class="card-body">
									@php
										$seeker_ratings = $rating->star_rate
									@endphp
									@for ($i = 1; $i <= $seeker_ratings; $i++)
										<i class="fa fa-star checked"></i>
									@endfor
									@for ($j = $seeker_ratings+1; $j <= 5; $j++)
										<i class="fa fa-star"></i>
									@endfor
									<blockquote class="blockquote mb-0">
										<p class="text-sm">
											{{ Str::limit($rating->comment, 110, '...')  }}
											@if (Str::length($rating->comment) > 110)
												<a href="#" class="text-danger" data-toggle="modal" data-target="#viewComment">Read</a>
											@endif
											<div class="modal fade" id="viewComment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
												<div class="modal-dialog">
												  <div class="modal-content">
													<div class="modal-header">
													  <h5 class="modal-title" id="staticBackdropLabel">{{ $rating->user->given_name.' '.$rating->user->last_name }}</h5>
													  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													  </button>
													</div>
													<div class="modal-body">
													  {{ $rating->comment }}
													</div>
													<div class="modal-footer">
													  <button type="button" class="btn btn-primary" data-dismiss="modal">Got it!</button>
													</div>
												  </div>
												</div>
											  </div>
										</p>
										<footer class="blockquote-footer text-danger">
											@if ($rating->user->id == Auth::id())
												Me
											@else
												{{ $rating->user->given_name.' '.$rating->user->last_name }}
											@endif
										</footer>
									</blockquote>
								</div>
							</div>
						</div>
					@endforeach
					<div class="container">{{$count_ratings->appends(['listings' => $listings->currentPage()])->links() }}</div>
				</div>
      		</div>
    	</div>
	</div>
	<div class="container pt-4" id="agents">
		<div class="col-md-12">
			<div class="card-header bg-transparent font-weight-bold text-uppercase text-success">
				{{ _('Properties') }}
			</div>
			<div class="row g-4 mt-1">
				<div class="card-deck">
					@forelse($listings as $listing)
						<div class="col">
							<div class="card">
								<img src="{{ asset('storage/properties/' .$listing->featured_image) }}" class="img-fluid" alt="...">
								<div class="card-body">
									<h5 class="card-title text-danger">{{ Str::limit($listing->title, 20, '...')  }}</h5>
									<p class="card-text">{{ Str::limit($listing->description, 35, '...')  }}</p>
									<a href="{{ route('seeker.view-property', $listing->id) }}" class="btn btn-primary">View Details</a>
								</div>
							</div>
						
						</div>
					@empty
						<div class="container text-center mt-5">
							<p class="text-muted text-md"> No Properties Found. </p>
						</div> 
					@endforelse
				</div>
			</div><br>
			<div class="container">{{ $listings->appends(['ratings' => $count_ratings->currentPage()])->links() }}</div>
		</div>
	</div>
@endsection
@section('javascripts')
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	@if (session('message'))
		<script>
			swal({
				text: "{{ session('message') }}",
				icon: "success",
			});
		</script>
	@endif
@endsection