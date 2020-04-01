@can('hasLicencePurchased')
	<div class="alert bg-success alert-icon-left mb-2" role="alert">
	    <span class="alert-icon"><i class="la la-check-circle"></i></span>
	    <strong>Welcome to e-Demic</strong>
	    <p class="mb-0 mt-1">You have successfully logged in!</p>
	</div>
@else
	<div class="alert bg-info alert-icon-left mb-2" role="alert">
	    <span class="alert-icon"><i class="la la-info"></i></span>
	    <strong>Welcome to e-Demic</strong>
	</div>

	<div class="row">
		<div class="col-md-12 text-center">
		    <div class="card text-center">
		        <div class="card-content">
		            <div class="card-body">
		                <h4 class="card-title">Purchase your License to use e-Demic</h4>
		                <h5><strong> Basic Package : $999/Year </strong></h5>
		                <a href="javascript:void(0);" id="purchase" class="btn btn-info">Purchase Now</a>
                      </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
@endcan

@push('page_scripts')

	<script type="text/javascript">
	    $("document").ready(function(){
	        $('#purchase').on('click', function(event) {
	        	document.cookie = "role=countryhead";

	        	location.href= "{{ URL::route('institution_checkout.create') }}";
	        });
	    });
	</script>

@endpush