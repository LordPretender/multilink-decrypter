<!doctype html>
<!--[if IE 8]> <html class="no-js ie8" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
<head>
	<title>{meta_title}</title>
	<meta name="description" content="{meta_desc}" />
	<meta name="keywords" content="{meta_keys}">
	<meta name="author" content="LordPretender">

	<meta charset="utf-8">
	<meta name="viewport" id="view" content="width=device-width,maximum-scale=1" />

	<link rel="shortcut icon" href="{assets}core/images/favicon.ico" />
	<link rel="apple-touch-icon" href="{assets}core/images/apple-touch-icon.png" />

	<link rel="stylesheet" href="{assets}style.css" />
	<link rel="stylesheet" href="{assets}core/styles/default/default.css" />

	<script src="{assets}core/js/libs/modernizr-2.0.6.min.js"></script>
	<script src="{assets}core/js/libs/jquery-1.6.2.min.js"></script>
	<script src="{assets}core/js/libs/jquery.easing.js"></script>
	<script src="{assets}core/js/libs/jquery.color.js"></script>
	<script src="{assets}core/js/fancybox/jquery.fancybox.pack.js"></script>
	<script src="{assets}core/js/mylibs/layout.js"></script>
	<script src="{assets}core/js/libs/head.min.js"></script>
	<script src="{assets}core/js/libs/underscore-min.js"></script>
	<script src="{assets}core/js/libs/underscore.string.js"></script>
	<script src="{assets}core/js/mylibs/rising.js"></script>
	<script src="{assets}core/js/main.js"></script>
	<script src="{assets}core/js/mylibs/responsive.js"></script>
	
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-32301432-9', 'multilinks-decrypter.fr');
		ga('send', 'pageview');
	</script>
	
	{script_foot}
</head>
<body id="page">
<div id="wrap">

<!-- + -->

<header role="banner">
	<section id="site-logo"><a href="/">MultiLinks Decrypter</a></section>
	
	<section id="nav-wrap">
		<div class="bg"><span class="tip left"></span><span class="tip right"></span></div>
		
		<a class="button home" href="/"><span></span></a>
		<nav role="navigation">
			{menu}
		</nav>
	</section><!-- navigation -->
</header><!-- header -->

<!-- + -->

<div id="content" role="main">

<hgroup id="page-title">
	<div class="pub_728">
	    <script type="text/javascript"><!--
	        google_ad_client = "ca-pub-5126470956370561";
	        google_ad_slot = "4372856667";
	        google_ad_width = 728;
	        google_ad_height = 90;
	        //-->
	    </script>
	    <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
	</div>
	
	<div class="pub_468">
		<script type="text/javascript"><!--
			google_ad_client = "ca-pub-5126470956370561";
			/* 468x60 */
			google_ad_slot = "4505704041";
			google_ad_width = 468;
			google_ad_height = 60;
			//-->
		</script>
		<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
	</div>
</hgroup><!-- page-title -->

<div id="content-wrap" class="clearfix">
<div id="main" data-align="left">

	<div class="post page">
		<div class="content excerpt">
		
			{contenu}

		</div><!-- .content -->
	</div><!-- .post -->

</div><!-- main -->

<!-- + -->

<div id="secondary">

	<aside class="widget widget_pub300">
        <script type="text/javascript"><!--
                google_ad_client = "ca-pub-5126470956370561";
                google_ad_slot = "0129757549";
                google_ad_width = 300;
                google_ad_height = 250;
        //-->
        </script>
        <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
	</aside><!-- .widget -->

	<aside class="widget">
		<h2 class="title"><span>Les partenaires</span></h2>
		<ul>
			<li><a href="http://www.youtube-rank.fr/">YoutubeRank</a></li>
			<li><a href="http://www.formulaire-de-contact.net/">Formulaire de contact</a></li>
			<li><a href="http://www.forum-remunere.fr/">Forum rémunéré</a></li>
		</ul>
	</aside><!-- .widget -->
</div><!-- .secondary -->

<div class="sbg"></div>
</div><!-- content-wrap -->

</div><!-- content -->

<!-- + -->

<footer role="contentinfo">
	<small>&copy;2013 <a href="http://www.duy-pham.fr">Duy PHAM</a>. Page chargée en {elapsed_time} secondes.</small>
	
	<ul class="social-icons">
		<li><a title="Twitter" href="https://twitter.com/LordPretender"><img alt="twitter" src="{assets}core/images/social/twitter.png" /></a></li>
		<li><a title="Facebook" href="https://www.facebook.com/LePretender"><img alt="facebook" src="{assets}core/images/social/facebook.png" /></a></li>
	</ul>
</footer><!-- footer -->

</div><!-- wrap -->

<script>
Rising.theme = 'default';
Rising.colors = {
	postTitleHover: '#EB5426',
	footerLinkHover: '#FF973F',
	frameHover: '#EA7716',
	lightboxBg: '#F7F7F7',
	sourceCodeBg: '#FCFCFC'
};
</script>

<!-- Analytics -->
</body>
</html>