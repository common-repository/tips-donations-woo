(function($) {
    'use strict';

    $(document).ready(function() {
        if ($('#tipfilter').length) {
            $('#tipfilter').on('change', function() {
                var thegoodpluginTime = $('#tipfilter').val();
                $.ajax({
                    url: thegoodplugin_ajax_object.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'thegoodplugin_change_filter',
                        tiptime: thegoodpluginTime
                    },
                    success: function(response) {
                        console.log(thegoodpluginTime);
                        $('.stats-table').html(response);
                    }
                });
            });
        }
    });

})(jQuery);