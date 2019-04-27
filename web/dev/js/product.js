
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
        chkboxFormSubmit();
        categoryFormSubmit();

    };
    
    var initJs = function () {
        console.log('i am loaded');
    };

    var categoryFormSubmit = function(){
        $(document).on('click','.category-list', function(){
            var elem = $(this);
            var category = elem.text();
            $('#productsearch-category').val(category);
            $('#product-search-form').submit();
        })
    }

    var chkboxFormSubmit = function(){
        $(document).on('click','.store-chkbox', function(){
            $('#product-search-form').submit();
        })
    }

    return {
        init: function () {
            attachEvents();
        }
    };
}(jQuery));

