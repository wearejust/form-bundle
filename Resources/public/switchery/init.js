(function(w, $) {

    'use strict';

    $(function() {
        $('.js-switchery').each(function() {
            new Switchery($(this)[0]);
        });
    });

})(window, jQuery);
