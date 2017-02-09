if (document.location.hostname == "localhost")
    var url = '/indiashopps_new/';
else
    var url = '/';

if( !$.isFunction( $.fn.autocomplete ) )
{ 
    jQuery.getScript("http://code.jquery.com/ui/1.10.1/jquery-ui.min.js")
        .done(function() {
            /* yay, all good, do something */
            add_autocomplete();
        })
        .fail(function() {
            /* boo, fall back to something else */
    });
}
else
{
    add_autocomplete();
}

function add_autocomplete()
{
    $("#coupon-search").autocomplete({
        source : function(request, response) 
        {   
            $.getJSON( url+"js/coupon-search.json?term=" + request.term, function(data)
            {
                var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );

                response( $.grep( data, function( value )
                    {                           
                        value = value.label || value.value || value;
                        $(".search-loader").hide()
                        return matcher.test( value );
                    }
                ) );
            })

            
        },
        search  : function() { $(".search-loader").show() },
        minLength: 2,
        delay: 200
    });
}

$(document).ready(function(){
    
    $(document).on('click','a',function(){

        var offer_page = $(this).attr('offer-page');

        // For some browsers, `attr` is undefined; for others, `attr` is false. Check for both.
        if (typeof offer_page !== typeof undefined && offer_page !== false) {
          // Element has this attribute
          var r = new RegExp('^(?:[a-z]+:)?//', 'i');

            if( r.test(offer_page) )
            {
                location.href = offer_page;
                return true;
            }
        }
    });
});