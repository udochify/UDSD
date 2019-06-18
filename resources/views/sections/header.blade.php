<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<script type="text/javascript" src="/jquery/jquery-3.4.0.min.js"></script>
@if($usertype == 'activeadmin')
<link href="/tinymce/skins/content/default/content.min.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/admin/components.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/edit-form.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/post-edit-form.css" type="text/css" rel="stylesheet" media="all" />
<link href="/prism/prism.css" type="text/css" rel="stylesheet" media="all" />
<script type="text/javascript" src="/prism/prism.js"></script>
<script type="text/javascript" src="/tinymce/tinymce.min.js"></script>
@endif
<script type="text/javascript" src="/js/ud_scripts/main.js"></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="/css/ud_css/main.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/dashboard.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/menu.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/floater.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/logo.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/navbar.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/sidenav.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/subnav.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/content.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/blog.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/sidebar.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/comment-form.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/widget-common.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/widget-archive.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/widget-calendar.css" type="text/css" rel="stylesheet" media="all" />
<link href="/css/ud_css/stack.css" type="text/css" rel="stylesheet" media="all" />
<noscript>
	<style>
		.show-comments {
			display: none !important;
		}
	</style>
</noscript>
<title>{{ $pageTitle }}</title>