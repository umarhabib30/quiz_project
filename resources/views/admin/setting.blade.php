@extends('layouts.admin')
@section('content')
<div class="page-body">
	<div class="container-xl">
		<div class="card">
			<div class="row g-0">
				<div class="col d-flex flex-column">
					<div class="card-body">
						<div class="container">
							<h2>Admin Settings</h2>

							@if(session('success'))
							<div class="alert alert-success">{{ session('success') }}</div>
							@endif

							<form method="post" action="{{ route('admin.settings.update') }}">
								@csrf
								<div class="form-group">
									<div class="form-label" for="stripe_key">Stripe Key:</div>
									<input type="text" class="form-control" id="stripe_key" name="stripe_key" value="{{ $stripeKey }}">
								</div>
								<div class="form-group">
									<div class="form-label" for="stripe_secret">Stripe Secret:</div>
									<input type="text" class="form-control" id="stripe_secret" name="stripe_secret" value="{{ $stripeSecret }}">
								</div>
								<div class="form-group">
									<div class="form-label" for="paypal_key">PayPal Key:</div>
									<input type="text" class="form-control" id="paypal_key" name="paypal_key" value="{{ $paypalKey }}">
								</div>
								<div class="form-group">
									<div class="form-label" for="paypal_secret">PayPal Secret:</div>
									<input type="text" class="form-control" id="paypal_secret" name="paypal_secret" value="{{ $paypalSecret }}">
								</div>
								<div class="mt-3">
										<button type="submit" class="btn btn-primary">
											Update 
										</button>
								</div>
								{{-- <button type="submit" class="btn btn-primary">Update</button> --}}
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection