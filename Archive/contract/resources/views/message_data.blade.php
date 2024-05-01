<!-- Alert messages code start here -->		
@if ($errors->any())
				<div class="alert alert-danger mb-4 alertmsg" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i data-feather="x" class="close"></i></button>
					<i data-feather="alert-circle"></i> <strong>Error! </strong>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			@if(session()->get('success'))          
				<div class="alert alert-success mb-4 alertmsg" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i data-feather="x" class="close"></i></button>
					<i data-feather="check"></i> <strong>Success! </strong> {{ session()->get('success') }}
				</div>
			@endif

			@if(session()->get('error'))            
				<div class="alert alert-danger mb-4 alertmsg" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i data-feather="x" class="close"></i></button>
					<i data-feather="alert-circle"></i> <strong>Error! </strong>{{ session()->get('error') }}
				</div>
			@endif
			<!-- Alert messages code end here -->