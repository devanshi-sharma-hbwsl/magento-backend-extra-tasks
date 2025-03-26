// app/code/Vendor2/Textfield/view/frontend/web/js/view/custom-text-area.js
define([
    'ko',
    'uiComponent',
    'jquery',
    'Magento_Catalog/js/product/storage/storage-service'
], function (ko, Component, $, storageService) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Vendor2_Textfield/custom-text-area'
        },
        initialize: function () {
            this._super();
            this.customText = ko.observable('');
        },
        
        // New method to handle form updates
        updateFormData: function() {
            var form = $('#product_addtocart_form');
            if (!form.length) return;
            
            // Get the current form data
            var formData = form.data('mageCacheStorage') || {storage: {}};
            
            // Update with custom text
            formData.storage.custom_text = this.customText();
            console.log('Custom text updated:', this.customText());
            
            // Store back in form
            form.data('mageCacheStorage', formData);
            
            // Also add to browser storage as fallback
            storageService.set('custom_text_data', {
                custom_text: this.customText(),
                product_id: formData.storage.product || $('#product_addtocart_form input[name="product"]').val()
            });
        }
    });
});