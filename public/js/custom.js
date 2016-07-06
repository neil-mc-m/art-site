/**
 * Created by neil on 26/06/2016.
 */
$(document).ready(function(){
    var $grid = $('.grid').imagesLoaded( function() {
        // init Masonry after all images have loaded
        $grid.masonry({
            itemSelector: '.grid-item',
            // use element for option
            columnWidth: '.grid-sizer',
            percentPosition: true,
            isFitWidth: true,
            gutter: '.gutter-sizer'
        });
    });
});
