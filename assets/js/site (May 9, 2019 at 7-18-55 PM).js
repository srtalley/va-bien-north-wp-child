// added by Jared

var _InitialSiteLoad;
var _BraSizeCalculator;

jQuery(document).ready(function () {
    //_InitialSiteLoad.init();
    _BraSizeCalculator.init();
});

(function ($) {

    'use strict';

    _InitialSiteLoad = {

        init: function () {

        }
    };

    _BraSizeCalculator = {

        init: function () {

            var bcEl = $('.bc-container');

            _BraSizeCalculator.calc(bcEl);

            var popup = $('.popup-bc-calculator');

            if (popup.length > 0) {

                popup.on('click', function (e) {

                    var popbcEl = $('.pum-content .bc-container');

                    _BraSizeCalculator.calc(popbcEl);
                });
            }

            var bcLink = $('#popup-bc-calculator');

            if (bcLink.length > 0) {

                bcLink.magnificPopup({
                    type: 'inline',
                    preloader: false
                });

            }
        },

        calc: function (bcEl) {


            if (bcEl.length > 0) {

                var inputEls = bcEl.find('input[name="band_size"], input[name="bust_size"] '),
                    band = bcEl.find('input[name="band_size"]'),
                    bust = bcEl.find('input[name="bust_size"]'),
                    result = bcEl.find('.bc-result');

                result.html('');

                inputEls.on('input', function (e) {

                    result.html('');

                    inputEls.each(function () {

                        var inputEl = $(this),
                            size = parseInt(inputEl.val());

                        var isnum = /^\d+$/.test(size);

                        if (isnum && size > 20 && size < 50) {
                            inputEl.next().hide();
                        } else if (inputEl.val().length > 1) {
                            inputEl.next().show();
                        }

                    });

                    // do the actual calculation
                    var band_val = 2 * Math.round(Math.round(band.val()) / 2);
                    var bust_val = Math.round(bust.val());
                    // are they both numbers
                    var is_band_num = /^\d+$/.test(band_val);
                    var is_bust_num = /^\d+$/.test(bust_val);

                    if (!is_band_num) {
                        return false;
                    }

                    if (!is_bust_num) {
                        return false;
                    }

                    if (band_val < 30 || band_val > 50) {
                        return false;
                    }

                    if (bust_val < 30 || bust_val > 50) {
                        return false;
                    }

                    if ((band_val > bust_val) || (band_val == bust_val)) {
                        result.html('Band size cannot be the same or bigger than bust size');
                        result.addClass('error');
                        result.show();
                        return false;
                    }

                    var diff = (bust_val - band_val) - 1;
                    var keyArray = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];

                    if (diff >= 0 && diff <= 8) {
                        result.removeClass('error');
                        result.html(band_val + keyArray[diff]);

                    } else {
                        result.addClass('error');
                        result.html('No result found');
                    }
                });
            }


        }
    };

})(jQuery);