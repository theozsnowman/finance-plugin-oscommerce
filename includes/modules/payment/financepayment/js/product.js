$(document).ready(function() {
    var url = document.getElementsByTagName('base'),id = document.getElementsByName('products_id');	
    if(typeof url !== 'undefined' && typeof url[0] !== 'undefined' && url[0].href != '' && typeof id !== 'undefined' && typeof id[0] !== 'undefined' && id[0].value != '' ) {
        addHTML(id[0].value,url[0].href);
    }
})
function addHTML(id,url)
{
	$.ajax({
        type     : 'post',
        url      : url+'finance_main_handler.php',
        data     : {
        	action:'getCalculatorWidget',
        	products_id: id,
        },
        dataType : 'json',
        cache    : false,
        success: function(data) {
        	if(typeof data.js !== 'undefined') {
        		if(typeof data.widget !== 'undefined') {
        			$('.contentText').prepend(data.widget);
        		}
        		if(typeof data.calculator !== 'undefined') {
        			$('form[name="cart_quantity"]').append(data.calculator);
        		}
        		setTimeout(function(){
        			dividoKey = data.js;
        			var script = document.createElement('script');
					script.src = data.jsSrc;
					document.head.appendChild(script);
        		},100);
        	}
        }
    });
}