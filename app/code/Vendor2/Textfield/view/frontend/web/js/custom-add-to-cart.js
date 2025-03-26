define(['jquery'], function($) {
    'use strict';
    
    return function(config, element) {
        $(element).submit(function(e) {
            var formData = $(this).data('mageCacheStorage').storage;
            console.log('--- ADD TO CART DEBUG ---');
            console.log('Full form data:', formData);
            console.log('Custom text value:', formData.custom_text || 'NOT FOUND');
            console.log('-----------------------');
        });
    };
});