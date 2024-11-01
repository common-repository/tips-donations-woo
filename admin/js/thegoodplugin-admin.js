(function($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
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

    $(document).ready(function() {

        var thegoodpluginCurrency = thegoodplugin_currency_script.thegoodplugin_currency;

        $('.toplevel_page_crb_carbon_fields_container_thegoodplugin_opts #submitdiv h3').text('Preview');
        $('.text4field .cf-field__head label').append('<span class="subtext">Remove text in order to disable the title.</span>');
        $('.tip-box .cf-field__head').append('<span class="subtext">Find the perfect emoji for you and paste it <a href="emojipedia.org">emojipedia.org</a>.</span>');
        $('.toplevel_page_crb_carbon_fields_container_thegoodplugin_opts #publish.button').val('Update');

        var htmltext = '<div class="tips-and-more-wrapper"><div class="tips-inner"><h3 class="title-tips"></h3><div class="tips-description"></div><div class="give-tips"><div class="image-tips"><h4></h4></div><div class="input-tips"><div class="minus-tip"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="5" viewBox="0 0 8 5" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.77214 0.263502C7.99197 0.483327 7.99197 0.839735 7.77214 1.05956L4.77002 4.06168C4.55019 4.28151 4.19379 4.28151 3.97396 4.06168L0.971837 1.05956C0.752011 0.839734 0.752011 0.483327 0.971837 0.263502C1.19166 0.0436762 1.54807 0.0436762 1.76789 0.263502L4.37199 2.8676L6.97608 0.263502C7.19591 0.0436764 7.55232 0.0436764 7.77214 0.263502Z" fill="black"/></svg></div><input id="total_tip" class="total_tip" type="number" name="total_tip" value="0" min="0" step="1" readonly><div class="plus-tip"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="5" viewBox="0 0 8 5" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.971998 4.21672C0.752173 3.9969 0.752173 3.64049 0.971998 3.42066L3.97412 0.41854C4.19395 0.198715 4.55035 0.198715 4.77018 0.41854L7.7723 3.42066C7.99213 3.64049 7.99213 3.9969 7.7723 4.21672C7.55248 4.43655 7.19607 4.43655 6.97625 4.21672L4.37215 1.61263L1.76806 4.21672C1.54823 4.43655 1.19182 4.43655 0.971998 4.21672Z" fill="black"/></svg></div><input type="hidden" class="nominal-tip"><input type="hidden" class="currency-tip"><input type="hidden" class="thanks-tip"></div><div class="button-tips"><button class="btn-tips" type="button"><span class="nominal-text"></span></button></div></div></div></div>';
        $('#major-publishing-actions').prepend(htmltext);

        var theTitle = $('textarea[name="carbon_fields_compact_input[_thegoodplugin_box_title]"]').val();
        $('.title-tips').html(theTitle);

        var theDesc = $('textarea[name="carbon_fields_compact_input[_thegoodplugin_box_description]"]').val();
        $('.tips-description').html(theDesc);

        var theIcon = $('input[name="carbon_fields_compact_input[_thegoodplugin_emoji_icon]"]').val();
        $('.image-tips h4').html(theIcon);

        var theText = $('input[name="carbon_fields_compact_input[_thegoodplugin_button_text]"]').val();
        var thePrice = $('input[name="carbon_fields_compact_input[_thegoodplugin_amount]"]').val();
        $('.btn-tips').html(theText + '<span class="nominal-text"></span>');

        var thePrice = $('input[name="carbon_fields_compact_input[_thegoodplugin_amount]"]').val();
        $('.nominal-text').text(' (' + thegoodpluginCurrency + thePrice + ')');

        var theBgColor = $('input[name="carbon_fields_compact_input[_thegoodplugin_box_color]"]').val();
        $('.tips-and-more-wrapper .tips-inner').css('background-color', theBgColor);

        $('.inputemoji.tip-box').before('<h3 class="form-title">Settings</h3>');
    });

    tinymce.init({
        selector: ".textitle textarea",
        menubar: '',
        plugins: "textcolor",
        toolbar: 'bold italic forecolor',
    });

    tinymce.init({
        selector: ".textdesc textarea",
        menubar: '',
        plugins: "textcolor",
        toolbar: 'bold italic forecolor',
    });

})(jQuery);