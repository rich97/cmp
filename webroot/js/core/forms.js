$(document).ready(function() {

    var counters = [];
    var fieldsets = $('.checkbox_list fieldset');


    $('.checkbox_select_all').click(function(e) {
        e.preventDefault();
        var container = $(this).parents('.checkbox_list');
        var previous = container
            .prevAll()
            .filter('.checkbox_list');
        if (counters[previous.length] === undefined) {
            counters[previous.length] = 0;
        }
        var checkboxes = container
            .find('.checkbox_options input[type=checkbox]');
        var checked = (counters[previous.length] % 2 == 0) ? true : false;
        $.each (checkboxes, function(i, val) {
            $(val).attr('checked', checked);
        });
        counters[previous.length]++;
    });
});