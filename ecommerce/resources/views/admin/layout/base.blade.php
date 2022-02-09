<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel - @yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/css/all.css">
<script src="https://use.fontawesome.com/0e86691b7f.js"></script>
</head>
<body data-page-id="@yield('data-page-id')">
	@include('includes.admin-sidebar')


	<div class="off-canvas-content admin_title_bar" data-off-canvas-content>
		<!-- Your page content lives here -->
		<div class="title-bar">
			<div class="title-bar-left">
				<button class="menu-icon hide-for-large" type="button"
					data-open="offCanvas"></button>
				<span class="title-bar-title">{{getenv('APP_NAME')}}</span>
			</div>


		</div>


		@yield('content')
	</div>


	<script src="/js/all.js"></script>

	<script
		src="https://cdn.jsdelivr.net/npm/foundation-sites@6.5.0-rc.3/dist/js/foundation.min.js"
		integrity="sha256-l1HhyJ0nfWQPdwsVJLNq8HfZNb3i1R9M82YrqVPzoJ4= sha384-NH8utV74bU+noXiJDlEMZuBe34Bw/X66sw22frHkgIs8R1QKWc8ckxYB4DheLjH4 sha512-JMs3Y+JjY+DhwVOPeJhkLM/0FeK9ANxvuYiHGpGp7Q2kMlmNEN/2v6TkrXdirxqB3DHxPlQ8iMxvb/eSPCF5CA=="
		crossorigin="anonymous"></script>

	<script>
$(document).ready(function() {
$(document).foundation();
});
</script>




</body>
</html>
