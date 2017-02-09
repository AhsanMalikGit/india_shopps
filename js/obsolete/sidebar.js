// Scrolling sidebar for your website
// Downloaded from Marcofolio.net
// Read the full article: http://www.marcofolio.net/webdesign/create_a_sticky_sidebar_or_box.html

window.onscroll = function()
{
	if( window.XMLHttpRequest ) {
		if (document.documentElement.scrollTop > 221 || self.pageYOffset > 221) {
			$('filter').style.position = 'fixed';
			$('filter').style.top = '350px';

		} else if (document.documentElement.scrollTop < 221 || self.pageYOffset < 221) {
			$('filter').style.position = 'absolute';
			$('filter').style.top = '221px';
		}
	}
}

window.onscroll = function()
{
	if( window.XMLHttpRequest ) {
		if (document.documentElement.scrollTop > 221 || self.pageYOffset > 221) {
			$('filter').style.position = 'fixed';
			$('filter').style.bottom = '700px';
			
		} else if (document.documentElement.scrollTop < 221 || self.pageYOffset < 221) {
			$('filter').style.position = 'absolute';
			$('filter').style.bottom = '221px';
		}
	}
}