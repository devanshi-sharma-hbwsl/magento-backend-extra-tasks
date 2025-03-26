define([
    'jquery'
], function ($) {
    'use strict';
    
    return function (config, element) {
        $(element).on('click', function(e) {
            if ($(this).hasClass('disabled')) {
                e.preventDefault();
                return false;
            }
            
            if (config.products.length < 2) {
                e.preventDefault();
                return false;
            }
            
            return true;
        });
    };
});