
var ProductController = (function($) {
     return {
        createUpdate: function () {
            ProductController.CreateUpdate.init();
        }
    };
}(jQuery));

ProductController.CreateUpdate = (function ($) {
    var attachEvents = function () {
        initJs();

    };
    
    var initJs = function () {
        console.log('i am loaded');
    };
    
    return {
        init: function () {
            attachEvents();
        }
    };
}(jQuery));

