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
        $(".flipbook").each(function () {
            $(this).flipBook(
                $(this).data('source'),
                {
                    height: $(this).data('height'),
                    controlsPosition: $(this).data('controlsposition'),
                    paddingTop: 50,
                    paddingLeft: 50,
                    paddingRight: 50,
                    paddingBottom: 50
                }
            );
        });


    };

};

const flipbook = new flipbookClass();

$(function () {
    flipbook.config();
    flipbook.init();
});
