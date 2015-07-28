window.onload = function() {
    var query = window.location.search;
    query = query.substr(1, query.length);
    console.log(query);
    $("#"+query).toggleClass("hidden", true);
};

var visible = false;

$('img').on({

    mouseenter: function() {
        var id = $(event.target).prop('id');
        var element = $('#stats-'+id);


        if (!visible) {
            element.fadeIn("fast");
            visible = true;
            var pos = $(this).position();

// .outerWidth() takes into account border and padding.
            var width = $(this).outerWidth();

//show the menu directly over the placeholder

            element.css({
                position: "absolute",
                top: pos.top + "px",
                left: (pos.left + width) + "px"
            }).show();
        }


    },
    mouseleave: function() {
        var id = $(event.target).prop('id');
        $('#stats-'+id).fadeOut("fast");
        visible = false;
    }
});