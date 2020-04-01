
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">

<!-- BEGIN VENDOR CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/vendors.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/ui/prism.min.css')}}">
<!-- END VENDOR CSS-->

<!-- BEGIN MODERN CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/app.css')}}">
<!-- END MODERN CSS-->

<!-- BEGIN Page Level CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/core/menu/menu-types/vertical-content-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/core/colors/palette-gradient.css')}}">
<!-- END Page Level CSS-->

<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/extensions/toastr.css') }}">

<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/tables/datatable/datatables.min.css') }}">

<!-- LOADERS -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/plugins/loaders/loaders.min.css') }}">

<!-- SELECT2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/forms/selects/select2.min.css') }}">

<!-- iCheck -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/forms/icheck/icheck.css') }}">

<!-- jQuery DateTimePicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />

<!-- Jquery UI -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/ui/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/plugins/ui/jqueryui.css') }}">

<!-- Sweet Alert -->
<link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/vendors/css/extensions/sweetalert.css') }}">

<!-- Loaders -->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('modern_admin_assets/css/plugins/loaders/loaders.min.css') }}"> -->

<style type="text/css">

	/* Parsley CSS */
	input:not([type=radio]).parsley-success,
	textarea.parsley-success,
	select.parsley-success {
		color: #468847;
		background-color: #DFF0D8;
		border: 1px solid #D6E9C6;
	}
	input:not([type=radio]).parsley-error,
	textarea.parsley-error,
	select.parsley-error {
		color: #B94A48;
		background-color: #F2DEDE;
		border: 1px solid #EED3D7;
	}
	.parsley-errors-list {
		color: red;
		margin: 2px 0 3px;
		padding: 0;
		list-style-type: none;
		font-size: 0.9em;
		line-height: 0.9em;
		opacity: 0;

		transition: all .3s ease-in;
		-o-transition: all .3s ease-in;
		-moz-transition: all .3s ease-in;
		-webkit-transition: all .3s ease-in;
	}
	.parsley-errors-list.filled {
		opacity: 1;
	}

	/* Absolute Center Spinner */
	.css_loader {
		position: fixed;
		z-index: 9999;
		height: 2em;
		width: 2em;
		overflow: visible;
		margin: auto;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		display: none;
	}

	/* Transparent Overlay */
	.css_loader:before {
		content: '';
		display: block;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0,0,0,0.3);
	}

	/* :not(:required) hides these rules from IE9 and below */
	.css_loader:not(:required) {
		/* hide "css_loader..." text */
		font: 0/0 a;
		color: transparent;
		text-shadow: none;
		background-color: transparent;
		border: 0;
	}

	.css_loader:not(:required):after {
		content: '';
		display: block;
		font-size: 10px;
		width: 1em;
		height: 1em;
		margin-top: -0.5em;
		-webkit-animation: spinner 1500ms infinite linear;
		-moz-animation: spinner 1500ms infinite linear;
		-ms-animation: spinner 1500ms infinite linear;
		-o-animation: spinner 1500ms infinite linear;
		animation: spinner 1500ms infinite linear;
		border-radius: 0.5em;
		-webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
		box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
	}

	/* Animation */
	@-webkit-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@-moz-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@-o-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	/*End Loader*/

	table:not(.txt-left) tr{
		text-align: center !important;
	}
	.no-wrap{
		white-space: nowrap;
	}

</style>