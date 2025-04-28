function init_fancybox()
{
    Fancybox.bind('[data-fancybox="gallery"]', {
        Thumbs: {type: "modern"},
        Toolbar: {
            display: {
                left: ["infobar"],
                middle: ["prev", "infobar", "next", "zoomIn", "zoomOut", "toggle1to1", "rotateCCW", "rotateCW", "flipX", "flipY"],
                right: ["download", "iterateZoom", "slideshow", "fullscreen", "thumbs", "close"],
            }
        }
    });
}
