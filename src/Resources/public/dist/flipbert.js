const flipbookClass = function () {

    this.config = function () {
        DFLIP.defaults.pdfjsSrc = "/bundles/duncrowgmbhflipbert/assets/dflip/js/libs/pdf.min.js";
        DFLIP.defaults.pdfjsCompatibilitySrc = "/bundles/duncrowgmbhflipbert/assets/dflip/js/libs/compatibility.js";
        DFLIP.defaults.pdfjsWorkerSrc = "/bundles/duncrowgmbhflipbert/assets/dflip/js/libs/pdf.worker.min.js";
        DFLIP.defaults.threejsSrc = "/bundles/duncrowgmbhflipbert/assets/dflip/js/libs/three.min.js";
        DFLIP.defaults.mockupjsSrc = "/bundles/duncrowgmbhflipbert/assets/dflip/js/libs/mockup.min.js";
        DFLIP.defaults.soundFile = "/bundles/duncrowgmbhflipbert/assets/dflip/sound/turn2.mp3";
        DFLIP.defaults.imagesLocation = "/bundles/duncrowgmbhflipbert/assets/dflip/images";
        DFLIP.defaults.imageResourcesPath = "/bundles/duncrowgmbhflipbert/assets/dflip/images/pdfjs/";
        DFLIP.defaults.cMapUrl = "/bundles/duncrowgmbhflipbert/assets/dflip/js/libs/cmaps/";
    };

    this.init = function () {
        jQuery(".flipbook").each(function () {

            let backgroundColor = jQuery(this).data('backgroundcolor');
            if(backgroundColor !== 'transparent') backgroundColor = '#' + backgroundColor;

            jQuery(this).flipBook(
                jQuery(this).data('source'),
                {
                    height: jQuery(this).data('height'),
                    controlsPosition: jQuery(this).data('controlsposition'),
                    paddingTop: 50,
                    paddingLeft: 50,
                    paddingRight: 50,
                    paddingBottom: 50,
                    backgroundColor: backgroundColor
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
