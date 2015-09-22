$(document).ready(initGridView);

var masonryProps =       {
    itemSelector: '.cm-it-li',
    columnWidth: '.col-md-4'
};


function onClickThumbnail(eventObject) {

    var listItems = $('.cm-it-li').find('.collapse');
    listItems.each(function() {
        $(this).collapse('hide');
    });
    var collapsible =   $(this).parent().children('.collapse');
    collapsible.collapse('show');
};


function initGridView() {
    
    var listItems = $('.cm-it-li');
    var img = listItems.children('div').children('img');
    img.on('click',onClickThumbnail);

    var grid = $('.item-grid');
    var collapsibles = $('.cm-it-li').find('.collapse');

    var layoutGridInner = function() {
        grid.masonry(masonryProps);
    };

    collapsibles.each(function() {
        setCollapsibleEvents($(this),layoutGridInner);
    });

    grid.imagesLoaded(layoutGridInner);


}

function layoutGrid(itemGrid) {
    itemGrid.masonry(masonryProps);
}

function setCollapsibleEvents(collapsible,gridLayoutAction) {
    collapsible.on('shown.bs.collapse',gridLayoutAction);
    collapsible.on('hidden.bs.collapse',gridLayoutAction);
}
