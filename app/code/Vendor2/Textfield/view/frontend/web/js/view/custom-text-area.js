define([
    'ko',
    'uiComponent',
    'jquery'
], function (ko, Component, $) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Vendor2_Textfield/custom-text-area',
            maxLength: 200
        },

        initialize: function () {
            this._super();
            this.customText = ko.observable('');
            this.charCount = ko.observable(0);
            this.errorMessage = ko.observable('');
            
            this.limitReached = ko.computed(function() {
                return this.charCount() >= this.maxLength;
            }, this);
        },

        handleInput: function(data, event) {
            var text = event.target.value;
            
            if (text.length > this.maxLength) {
                text = text.substring(0, this.maxLength);
                event.target.value = text;
                this.errorMessage('TraineeName has reached character limit');
            } else {
                this.errorMessage('');
            }
            
            this.customText(text);
            this.charCount(text.length);
            this.updateFormData();
        },

        updateFormData: function() {
            var form = $('#product_addtocart_form');
            if (form.data('mageCacheStorage')) {
                form.data('mageCacheStorage').storage.custom_text = this.customText();
                form.data('mageCacheStorage').storage.custom_text_length = this.charCount();
            }
        }
    });
});