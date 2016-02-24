
(function($) {
    
    var eventTags = $('#tagUrl');
    var addEvent = function(text) {
            $('#imagesContainer').append(text + '<br>');
        };
        
    eventTags.tagit({
        
        afterTagAdded: function(evt, ui) {
            if (!ui.duringInitialization) {
                addEvent('<img src="' + eventTags.tagit('tagLabel', ui.tag) + '" />');
            }
        },        
        afterTagRemoved: function(evt, ui) {
            
            jQuery.each(jQuery('#imagesContainer img'), function( index, value ) {
                if( jQuery(this).attr('src') === eventTags.tagit('tagLabel', ui.tag) ){
                     jQuery(this).remove();
                }
            });
            
        },
        
    });
    
    
    
    $('#tagValues, #tagUrl').tagit({
        allowSpaces: true
    });
    
    $("#colorPickerFull").spectrum({
        
        showInput: true,
        className: "full-spectrum",
        showInitial: true,
        showPalette: true,
        showSelectionPalette: true,
        maxSelectionSize: 10,
        preferredFormat: "hex",
        localStorageKey: "spectrum.demo",
        move: function (color) {

        },
        show: function () {

        },
        beforeShow: function () {

        },
        hide: function () {

        },
        change: function() {

        },
        palette: [
            ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)",
            "rgb(204, 204, 204)", "rgb(217, 217, 217)","rgb(255, 255, 255)"],
            ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
            "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"], 
            
        ]
    });
    
    
})(jQuery);     

      
        