const flipbookClass = function () {

    this.config = function () {
        DFLIP.defaults.pdfjsSrc = "/bundles/duncrowflipbert/assets/dflip/js/libs/pdf.min.js";
        DFLIP.defaults.pdfjsCompatibilitySrc = "/bundles/duncrowflipbert/assets/dflip/js/libs/compatibility.js";
        DFLIP.defaults.pdfjsWorkerSrc = "/bundles/duncrowflipbert/assets/dflip/js/libs/pdf.worker.min.js";
        DFLIP.defaults.threejsSrc = "/bundles/duncrowflipbert/assets/dflip/js/libs/three.min.js";
        DFLIP.defaults.mockupjsSrc = "/bundles/duncrowflipbert/assets/dflip/js/libs/mockup.min.js";
        DFLIP.defaults.soundFile = "/bundles/duncrowflipbert/assets/dflip/sound/turn2.mp3";
        DFLIP.defaults.imagesLocation = "/bundles/duncrowflipbert/assets/dflip/images";
        DFLIP.defaults.imageResourcesPath = "/bundles/duncrowflipbert/assets/dflip/images/pdfjs/";
        DFLIP.defaults.cMapUrl = "/bundles/duncrowflipbert/assets/dflip/js/libs/cmaps/";
    };

    this.init = function () {
        jQuery(".flipbook").each(function () {
            jQuery(this).flipBook(
                jQuery(this).data('source'),
                {
                    height: jQuery(this).data('height'),
                    controlsPosition: jQuery(this).data('controlsposition'),
                    paddingTop: 50,
                    paddingLeft: 50,
                    paddingRight: 50,
                    paddingBottom: 50
                }
            );
        });

        jQuery(".flipbook-row ._df_thumb").on('click', function () {
            setTimeout(function () {
                if(jQuery(".df-lightbox-wrapper:visible").length > 0) {
                    jQuery('body').addClass('flipbook-lightbox-open');

                    jQuery(".df-lightbox-wrapper .df-lightbox-close").on('click', function () {
                        jQuery('body').removeClass('flipbook-lightbox-open');
                    });
                }
            }, 500);
        });
    };

};

const flipbook = new flipbookClass();

jQuery(function () {
    flipbook.config();
    flipbook.init();
});
