$(function() {

	var nnSelector        = ".tx_nnaddress_search form select[name=tx_nnaddress_abclist\\[group\\]],.tx_nnaddress_search form select[name=tx_nnaddress_list\\[group\\]]" + 
	                        ",.tx_nnaddress_search form select[name=tx_nnaddress_abclist\\[group\\]\\[\\]],.tx_nnaddress_search form select[name=tx_nnaddress_list\\[group\\]\\[\\]]",
	    nnSelectorLast    = ".tx_nnaddress_search form select[name=tx_nnaddress_abclist\\[group\\]]:last,.tx_nnaddress_search form select[name=tx_nnaddress_list\\[group\\]]:last" + 
			                    ",.tx_nnaddress_search form select[name=tx_nnaddress_abclist\\[group\\]\\[\\]]:last,.tx_nnaddress_search form select[name=tx_nnaddress_list\\[group\\]\\[\\]]:last",
			nnSelectorForm    = '.tx_nnaddress_search form',
			nnSelectorFormSel = "select[name=tx_nnaddress_abclist\\[group\\]],select[name=tx_nnaddress_list\\[group\\]]" + 
			                    ",select[name=tx_nnaddress_abclist\\[group\\]\\[\\]],select[name=tx_nnaddress_list\\[group\\]\\[\\]]";
	
	function loadOptions(el) {
		var curUrl = window.location.pathname;// + window.location.search;
		var selVal = $(el).val();
		
		if ( selVal <= 0 ) {
			el.nextAll('select[name="' + el.attr('name') + '"]').remove();
			return;
		}
		
		$(el).addClass('loading');
		
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: curUrl,
			data: {
				'type': 9323,
				'tx_nnaddress_list[group]': selVal,
			}
		}).done(function(data) {
			el.nextAll('select[name="' + el.attr('name') + '"]').remove();
			
			$(el).removeClass('loading');
			
			if ( data.length <= 0 ) return;
			
			var newEl = el.clone().insertAfter(el);
			newEl.find('option[value!=0]').remove();
			
			$(data).each(function(key, optData) {
				newEl.append(new Option(optData.title, optData.uid));
			});
			
			newEl.on('change', function() {
				loadOptions($(this));
			});
		});
	};

	$(nnSelector).on('change', function() {
			loadOptions($(this));
	});
	
	$(nnSelectorForm).submit(function(evt) {
		$(evt.target).find(nnSelectorFormSel).each(function(key, el) {
			if ( key > 0 ) {
				var selEl = $(el);
				if ( selEl.val() <= 0 ) selEl.attr('name', 'disabled');
			}
		});
	});
	
	loadOptions($(nnSelectorLast));
});