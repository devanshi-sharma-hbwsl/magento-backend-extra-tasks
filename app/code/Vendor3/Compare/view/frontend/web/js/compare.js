define([
    'jquery',
    'Magento_Customer/js/customer-data'
], function ($, customerData) {
    'use strict';
    
    $.widget('vendor3.compare', {
        options: {
            compareButtonSelector: '.compare-actions',
            checkboxSelector: '.compare-checkbox'
        },
        
        _create: function () {
            this._bind();
            this._updateCompareButton();
        },
        
        _bind: function () {
            var self = this;
            $(document).on('change', this.options.checkboxSelector, function() {
                self._updateCompareProducts();
            });
        },
        
        _updateCompareProducts: function () {
            var selectedProducts = [];
            $(this.options.checkboxSelector + ':checked').each(function() {
                if(selectedProducts.length < 2) {
                    selectedProducts.push($(this).val());
                } else {
                    $(this).prop('checked', false);
                }
            });
            this._updateCompareButton(selectedProducts);
        },
        
        _updateCompareButton: function (selectedProducts) {
            var compareContainer = $(this.options.compareButtonSelector);
            var compareLink = compareContainer.find('a.compare');
            var count = selectedProducts.length;
            
            // Update URL
            var baseUrl = compareLink.attr('href').split('?')[0];
            compareLink.attr('href', baseUrl + '?products[]=' + selectedProducts.join('&products[]='));
            
            // Toggle visibility and state
            if (count === 2) {
                compareContainer.show();
                compareLink.removeClass('disabled').prop('disabled', false);
            } else if (count > 2) {
                compareContainer.show();
                compareLink.addClass('disabled').prop('disabled', true);
            } else {
                compareContainer.hide();
            }
        }
    });
    
    return $.vendor3.compare;
});