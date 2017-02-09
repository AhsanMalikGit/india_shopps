$(function() {
    $("#autocomplete-ajax").autocomplete({
 source : function(request, response) {
            $.getJSON('/itemsearch.json?term=' + request.term, function(data) {
                var list = $.map(data.values, function(item, index) {
                    return {
                        label : item.name
                    };
                });
                response(list);
            })
        }
    });
})