jQuery(document).ready( function($) {
    const $allVideos = $("iframe[src^='https://www.youtube.com']");
    const $main = $("article.postclass");

    function fixYoutube() {
        const  newWidth = $main.width();
        // resize all videos according to their own aspect ratio
        $allVideos.each(function() {
            const $el = $(this);
            $el.width(newWidth).height(newWidth * $el.data('aspectRatio'));

        });
        // kick off one resize to fix all videos on page load
    }

    $allVideos.each(function() {
        $(this)
            .data('aspectRatio', this.height / this.width)
            // and remove the hard coded width/height
            .removeAttr('height')
            .removeAttr('width');
    });

    $(window).resize(fixYoutube);
    fixYoutube();
});