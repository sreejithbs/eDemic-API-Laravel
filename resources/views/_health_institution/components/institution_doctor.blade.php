<div class="card-content text-center mt-5 mb-5">
    <div class="card-body">
        <h3>Your limit exceeded. Please buy more connects to create doctor profiles.</h3>
        <div class="row justify-content-md-center mt-1 mb-1">
            <div class="col-md-3">
                <input type="number" id="no_doctors" class="form-control" placeholder="Enter No. of Doctors" name="no_doctors">
            </div>
        </div>
        <h5><strong> Fee per Doctor : $50 </strong></h5>
        <a href="javascript:void(0);" id="purchase" class="btn btn-info"> Buy Connects </a>
    </div>
</div>

@push('page_scripts')

	<script type="text/javascript">
	    $("document").ready(function(){
	        $('#purchase').on('click', function(event) {
	        	document.cookie = "role=doctor; Path=/;";
	        	document.cookie = "doctors=" + $("#no_doctors").val() + "; Path=/;";

	        	location.href= "{{ URL::route('institution_checkout.create', 'doctor') }}";
	        });
	    });
	</script>

@endpush