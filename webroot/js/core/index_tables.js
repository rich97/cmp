index = {
    tsbtn: $('#toggleselect_button'),
    dbtn: $('a#delete_button'),
    searchInput: $('#searchInput'),
    selected: 0,
    init: function() {
		index.toggleSelect();
		index.deleteSubmit();
		index.search();
    },
    toggleSelect: function() {
		index.tsbtn.click(function(e)
		{
			e.preventDefault();
			var checkboxes = index.tsbtn
				.parents()
				.filter('thead')
				.eq(0)
				.siblings('tbody')
				.eq(0)
				.find('input[type=checkbox]');
			var checked = (index.selected % 2 == 0) ? true : false;
			index.selected++;
			$.each (checkboxes, function(i, val) {
				$(val).attr('checked', checked);
			});
		});
    },
    deleteSubmit: function() {
		index.dbtn.click(function(e) {
			e.preventDefault();
			if ($('#delete_form').length) {
				var rel = 'Are you sure?';
				if (index.dbtn.attr('rel')) {
					rel = index.dbtn.attr('rel');
				}

				if(confirm(rel)) {
					$('#delete_form').submit();
				}
			}
		});
    },
    search: function() {
		if (index.searchInput.length) {
			var original = index.searchInput.val();
			var last = original;
	
			index.searchInput.focus(function() {
				if (last == original) {
					index.searchInput.val('');
				}
			});
	
			index.searchInput.blur(function() {
				if (index.searchInput.val() === '') {
					index.searchInput.val(original);
				}
				last = index.searchInput.val();
			});
		}
    }
}
$(document).ready(function() {
    index.init();
});