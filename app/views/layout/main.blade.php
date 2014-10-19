<!DOCTYPE html>
<html>
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ Config::get('app.website_name') }}</title>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>  
        {{ HTML::style('assets/css/style.css') }}     
        {{ HTML::style('assets/css/datepicker3.css') }}
        {{ HTML::script('assets/js/jquery-1.11.1.min.js') }}
        {{ HTML::script('assets/js/bootstrap.min.js') }}
        {{ HTML::script('assets/js/bootstrap-filestyle.min.js') }}
        {{ HTML::script('assets/js/spin.min.js') }}
        {{ HTML::script('assets/js/bootstrap-datepicker.js') }}       
        {{ HTML::script('assets/js/jquery-birthday-picker.min.js') }}      
  
        
        <script>
        $("#demo").birthdayPicker();   	
        $(function() {           
        	$("#carousel").carousel();
        	$(":file").filestyle(); 
		

        	var opts = {
        			  lines: 13, // The number of lines to draw
        			  length: 20, // The length of each line
        			  width: 10, // The line thickness
        			  radius: 30, // The radius of the inner circle
        			  corners: 1, // Corner roundness (0..1)
        			  rotate: 0, // The rotation offset
        			  direction: 1, // 1: clockwise, -1: counterclockwise
        			  color: '#000', // #rgb or #rrggbb or array of colors
        			  speed: 1, // Rounds per second
        			  trail: 60, // Afterglow percentage
        			  shadow: false, // Whether to render a shadow
        			  hwaccel: false, // Whether to use hardware acceleration
        			  className: 'spinner', // The CSS class to assign to the spinner
        			  zIndex: 2e9, // The z-index (defaults to 2000000000)
        			  top: 'auto', // Top position relative to parent in px
        			  left:'auto' // Left position relative to parent in px
        			};

        			var target = document.getElementById('searching_spinner_center');
        			var spinner = new Spinner(opts).spin(target);

        			
        });
        
        </script> 
    </head>

    <body>
    	<div class="wrapper">
	    	<div class="header-top"></div>    	
		    	<div class="container clearfix">        	  
				        @include('layout.navigation')
				        @if(Session::has('global'))
				        <div>{{ Session::get('global')}}</div>
				        @endif
				        
				        @yield('content')				   
		        </div>  
		              
  		 </div>
  		 
  	 <footer id="main-footer" class="site-footer clearfix">
    <div class="container">
        <div class="row">

            <div class=" col-lg-3 col-md-3 col-sm-6  ">
                <section id="text-2" class="widget animated fadeInLeft widget_text"><h3 class="title">About MedicalPress</h3>			<div class="textwidget"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>
<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
</div>
		</section>            </div>

            <div class=" col-lg-3 col-md-3 col-sm-6  ">
                <section id="displaytweetswidget-2" class="widget animated fadeInLeft widget_displaytweetswidget"><h3 class="title">Latest Tweets</h3><p>Top selling real estate theme on themeforest 'Real Homes - WordPress Real Estate Theme' <a href="http://t.co/zxfOrA4kAv" target="_blank">http://t.co/zxfOrA4kAv</a><br /><small class="muted">- Friday Aug 8 - 1:24pm</small></p><p>Real Homes is now number one selling real estate theme on themeforest <a href="http://t.co/yB3oePzJvN" target="_blank">http://t.co/yB3oePzJvN</a><br /><small class="muted">- Friday Jun 6 - 5:35am</small></p><p>Check Out MedicalPress Email Campaign - <a href="http://t.co/vE5XXq6fi3" target="_blank">http://t.co/vE5XXq6fi3</a><br /><small class="muted">- Thursday May 29 - 8:28am</small></p></section>            </div>

            <div class="clearfix visible-sm"></div>

            <div class=" col-lg-3 col-md-3 col-sm-6  ">
                		<section id="recent-posts-3" class="widget animated fadeInLeft widget_recent_entries">		<h3 class="title">Recent Posts</h3>		<ul>
					<li>
				<a href="http://inspirythemesdemo.com/medicalpress/image-post-format/">Image Post Format</a>
						</li>
					<li>
				<a href="http://inspirythemesdemo.com/medicalpress/quote-post-format/">Quote Post Format</a>
						</li>
					<li>
				<a href="http://inspirythemesdemo.com/medicalpress/gallery-post-format/">Gallery Post Format</a>
						</li>
					<li>
				<a href="http://inspirythemesdemo.com/medicalpress/how-to-live-a-healthier-life/">How to Live a Healthier Life</a>
						</li>
					<li>
				<a href="http://inspirythemesdemo.com/medicalpress/the-hero-in-all-of-us/">The Hero In All Of Us</a>
						</li>
				</ul>
		</section>            </div>

            <div class=" col-lg-3 col-md-3 col-sm-6  ">
                <section id="wp_email_capture_widget_class-2" class="widget animated fadeInLeft widget_wp_email_capture_widget_class"><h3 class="title">Newsletter Sign Up </h3><div class="textwidget">Stay updated with latest news from Medical Press.</div> <div id="wp_email_capture" class="wp-email-capture wp-email-capture-widget wp-email-capture-widget-worldwide"><form name="wp_email_capture" method="post" action="http://inspirythemesdemo.com/medicalpress/">

 	
	<label class="wp-email-capture-name wp-email-capture-label wp-email-capture-widget-worldwide wp-email-capture-name-widget wp-email-capture-name-label wp-email-capture-name-label-widget" for="wp-email-capture-name-widget">Name:</label> <input name="wp-email-capture-name" id="wp-email-capture-name-widget" type="text" class="wp-email-capture-name wp-email-capture-input wp-email-capture-widget-worldwide wp-email-capture-name-widget wp-email-capture-name-input wp-email-capture-name-input-widget" title="Name" /><br/>

	<label class="wp-email-capture-email wp-email-capture-label wp-email-capture-widget-worldwide wp-email-capture-email-widget wp-email-capture-email-label wp-email-capture-email-label-widget"  for="wp-email-capture-email-widget">Email:</label> <input name="wp-email-capture-email" id="wp-email-capture-email-widget" type="text" class="wp-email-capture-email wp-email-capture-input wp-email-capture-widget-worldwide wp-email-capture-email-widget wp-email-capture-email-input wp-email-capture-email-input-widget" title="Email" /><br/>

	<input type="hidden" name="wp_capture_action" value="1" />

<input name="Submit" type="submit" value="Submit" class="wp-email-capture-submit wp-email-capture-widget-worldwide" />

</form>

</div>

</section>            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="footer-bottom animated fadeInDown clearfix">
                    <div class="row">
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 ">
                                <p>© Copyright 2014. All Rights Reserved by Medical Press</p>
                            </div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12  clearfix">
                                <ul class="footer-social-nav">
                                    <li><a target="_blank" href="https://twitter.com/InspiryThemes"><i class="fa fa-twitter"></i></a></li><li><a target="_blank" href="https://www.facebook.com/InspiryThemes"><i class="fa fa-facebook"></i></a></li><li><a target="_blank" href="https://plus.google.com/105667798414314247471"><i class="fa fa-google-plus"></i></a></li><li><a target="_blank" href="#linkedin"><i class="fa fa-linkedin"></i></a></li><li><a target="_blank" href="#instagram"><i class="fa fa-instagram"></i></a></li><li><a target="_blank" href="#youtube"><i class="fa fa-youtube"></i></a></li><li><a target="_blank" href="skype:skypeusername?add"><i class="fa fa-skype"></i></a></li><li><a target="_blank" href="http://inspirythemesdemo.com/medicalpress/feed/"><i class="fa fa-rss"></i></a></li>                                </ul>
                            </div>
                                            </div>
                </div>
            </div>
        </div>
    </div>
</footer>
  		 
    </body>


</html>