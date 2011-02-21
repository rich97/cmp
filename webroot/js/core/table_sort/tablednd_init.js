dndInit = {
    dndTable: $('#drag_drop'),
    submitTo: $('#drag_drop').attr('title'),
    init: function() {
		if (dndInit.dndTable.length) {
			dndInit.dndTable.tableDnD ({
				onDrop: function(table, row) {
				    $.post(dndInit.submitTo, $.tableDnD.serialize());
				    var rows = dndInit.dndTable.find('tbody tr');
				    var count = 1;
				    var rowclass = null;
				    $.each (rows, function(i, val) {
						rowclass = (count % 2 == 0) ? 'odd_row' : 'even_row';
						$(val).attr('class', rowclass);
						count++;
				    });
				},
				dragHandle: "fam_table_sort"
		    });
		}
    }
}
$(document).ready(function()
{
    dndInit.init();
});
