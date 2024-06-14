const flipbookClass = function () {

    this.config = function () {
        DFLIP.defaults.pdfjsSrc = "/bundles/flipbert/assets/dflip/js/libs/pdf.min.js";
        DFLIP.defaults.pdfjsCompatibilitySrc = "/bundles/flipbert/assets/dflip/js/libs/compatibility.js";
        DFLIP.defaults.pdfjsWorkerSrc = "/bundles/flipbert/assets/dflip/js/libs/pdf.worker.min.js";
        DFLIP.defaults.threejsSrc = "/bundles/flipbert/assets/dflip/js/libs/three.min.js";
        DFLIP.defaults.mockupjsSrc = "/bundles/flipbert/assets/dflip/js/libs/mockup.min.js";
        DFLIP.defaults.soundFile = "/bundles/flipbert/assets/dflip/sound/turn2.mp3";
        DFLIP.defaults.imagesLocation = "/bundles/flipbert/assets/dflip/images";
        DFLIP.defaults.imageResourcesPath = "/bundles/flipbert/assets/dflip/images/pdfjs/";
        DFLIP.defaults.cMapUrl = "/bundles/flipbert/assets/dflip/js/libs/cmaps/";
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
                    backgroundColor: backgroundColor,
                    hideControls: jQuery(this).data('hiddencontrolelements')
                }
            );
        });

        jQuery(window).on('popstate', function(e) {
           if(window.location.href.indexOf('#dflip-') > -1) {
               let hash = window.location.hash.split('/')[0].replace('dflip-', '');

               if(jQuery(hash).length > 0) {
                   jQuery('html, body').animate({
                       scrollTop: jQuery(hash).offset().top + 100
                   }, 800);
               }
           }
        });
        jQuery(window).trigger('popstate');

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
