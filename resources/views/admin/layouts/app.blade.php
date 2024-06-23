<!DOCTYPE html>
<html lang="en">
    <head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>@yield('title')</title>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1" />

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet" />
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/styles/core.css')}}" />
		<link
			rel="stylesheet"
			type="text/css"
			href="{{asset('admin/vendors/styles/icon-font.min.css')}}" />
		<link
			rel="stylesheet"
			type="text/css"
			href="{{asset('admin/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}" />
		<link
			rel="stylesheet"
			type="text/css"
			href="{{asset('admin/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/styles/style.css')}}" />
	</head>
<body>
    @include('admin.layouts.header')
    @include('admin.layouts.sider-bar')
    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            @yield('content')
            @include('admin.layouts.footer')
        </div>
    </div>
    
    <!-- js -->
		<script src="{{asset('admin/vendors/scripts/core.js')}}"></script>
		<script src="{{asset('admin/vendors/scripts/script.min.js')}}"></script>
		<script src="{{asset('admin/vendors/scripts/process.js')}}"></script>
		<script src="{{asset('admin/vendors/scripts/layout-settings.js')}}"></script>
		<script src="{{asset('admin/src/plugins/apexcharts/apexcharts.min.js')}}"></script>
		<script src="{{asset('admin/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
		<script src="{{asset('admin/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
		<script src="{{asset('admin/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
		<script src="{{asset('admin/vendors/scripts/dashboard3.js')}}"></script>
</body>
</html>