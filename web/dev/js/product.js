
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
        getRangeSliderValue()

    };
    
    var initJs = function () {
        console.log('i am loaded');
    };

    var getRangeSliderValue = function(){
        $(document).on('change','.discount-range', function(){
            $('#discount-span').text($(this).val());
            $('#product-search-form').submit();
        })
    }
    var categoryFormSubmit = function(){
        $(document).on('click','.category-list', function(){
            var elem = $(this);
            var category = elem.text();
            $('#productsearch-category').val(category.trim());
            $('#product-search-form').submit();
        })
    }

    var chkboxFormSubmit = function(){
        $(document).on('click','.store-chkbox', function(){
            $('#productsearch-category').val('');
            $('#product-search-form').submit();
        })
    }

    return {
        init: function () {
            attachEvents();
        }
    };
}(jQuery));

