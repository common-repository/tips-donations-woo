(function($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    $(document).on('ready', function() {

        var thegoodpluginBtnText = thegoodplugin_currency_script.thegoodplugin_tiptext,
            thegoodpluginCurrency = thegoodplugin_currency_script.thegoodplugin_currency,
            thegoodpluginPrice = thegoodplugin_currency_script.thegoodplugin_price;

        if ($('.btn-tips').length) {
            $('.btn-tips').on('click', function(event) {
                var thanksMessage = $('.thanks-tip').val();

                if (thanksMessage != "") {
                    thanksMessage = thanksMessage;
                } else {
                    thanksMessage = "Thank you!";
                }

                $('body').trigger('update_checkout');
                $('.btn-tips').text(thanksMessage);

                function btnPriceFunction() {
                    myVar = setTimeout(btnTriggerFunc, 2000);
                }

                var $qty = $('.give-tips-wrap .total_tip').val();

                var priceAfterThank = thegoodpluginPrice * $qty;

                function btnTriggerFunc() {
                    $('.btn-tips').html(thegoodpluginBtnText + '<span class="nominal-text">(' + thegoodpluginCurrency + priceAfterThank + ')</span>');
                }

                btnPriceFunction();
            });
        }

        if ($('.hidden_nominal_tip #nominal_tip')) {
            var hidden_nominal_tip = $('.hidden_nominal_tip #nominal_tip').val();
            var currency = $('.currency-tip').val();
            var nominalTip = $('.input-tips').find('.nominal-tip').val();

            if (hidden_nominal_tip != "") {
                var $totalTip = hidden_nominal_tip * nominalTip;

                $('.input-tips').find('.total_tip').val(hidden_nominal_tip);
                $(".nominal-text").text('(' + currency + $totalTip + ')');
            }
        }

        if ($('.tips-and-more-wrapper .input-tips').length) {
            var $qty = $(this).parent().find('.total_tip'),
                currentVal = parseFloat($qty.val());
            var currency = $('.currency-tip').val();
            var nominalTip = $('.input-tips').find('.nominal-tip').val();

            // Format values
            if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 1;

            $('.total_tip').val(currentVal);
            $(".nominal-text").text('(' + currency + nominalTip + ')');

            $(document).on('click', '.tips-and-more-wrapper .input-tips .plus-tip[class!="disabled"], .tips-and-more-wrapper .input-tips .minus-tip[class!="disabled"]', function() {
                // Get values
                var $qty = $(this).parent().find('.total_tip'),
                    currentVal = parseFloat($qty.val()),
                    max = parseFloat($qty.attr('max')),
                    min = parseFloat($qty.attr('min')),
                    step = $qty.attr('step'),
                    nominalTip = $(this).parent().find('.nominal-tip').val(),
                    hidden_nominal_tip = $('.hidden_nominal_tip #nominal_tip');

                // Format values
                if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 1;
                if (max === '' || max === 'NaN') max = '';
                if (min === '' || min === 'NaN') min = 1;
                if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = '1';

                // Change the value
                if ($(this).is('.plus-tip')) {
                    if (max && (max == currentVal || currentVal > max)) {
                        $qty.val(max);
                        hidden_nominal_tip.val(max);

                        var $totalTip = max * nominalTip,
                            currency = $('.currency-tip').val();

                        $(".nominal-text").text('(' + currency + $totalTip + ')');
                    } else {
                        $qty.val(currentVal + parseFloat(step));
                        hidden_nominal_tip.val(currentVal + parseFloat(step));

                        var getValNum = currentVal + parseFloat(step),
                            $totalTip = getValNum * nominalTip,
                            currency = $('.currency-tip').val();

                        $(".nominal-text").text('(' + currency + $totalTip + ')');
                    }
                } else {
                    if (min && (min == currentVal || currentVal < min)) {
                        $qty.val(min);
                        hidden_nominal_tip.val(min);

                        var $totalTip = min * nominalTip,
                            currency = $('.currency-tip').val();

                        $(".nominal-text").text('(' + currency + $totalTip + ')');
                    } else if (currentVal > 0) {
                        $qty.val(currentVal - parseFloat(step));
                        hidden_nominal_tip.val(currentVal - parseFloat(step));

                        var getValNum = currentVal - parseFloat(step),
                            $totalTip = getValNum * nominalTip,
                            currency = $('.currency-tip').val();

                        $(".nominal-text").text('(' + currency + $totalTip + ')');
                    }
                }

                // Trigger change event
                hidden_nominal_tip.trigger('change');
                $qty.trigger('change');
            });
        }

    });

})(jQuery);