(function(w, $) {

    'use strict';

    $(function() {
        $('.cropper').each(function() {
            new Cropper($(this));
        });

        $('.cropper-canvas-container').on('click', function(){
            $('.cropper-local button').click();
        });

    });

})(window, jQuery);