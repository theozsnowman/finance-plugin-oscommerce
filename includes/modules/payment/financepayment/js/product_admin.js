$(document).ready(function() {
    console.log('product admin');
    var base_url = window.location.origin,href = window.location.href,regex = new RegExp(/(categories.php)(?=.*action=new_product)(?=.*pID=([0-9]+))/g),mat = regex.exec(href);
    var regex1 = new RegExp(/(orders.php)(?=.*action=edit)(?=.*oID=([0-9]+))/g),mat1 = regex1.exec(href);
    var regex2 = new RegExp(/(modules.php)(?=.*module=(financepayment))(?=.*action=(edit))(?=.*set=(payment))/g),mat2 = regex2.exec(href);
    if(mat !== null && mat.length > 0 && mat[0] !== undefined) {
        if(mat[1] !== undefined && mat[2] !== undefined) { //welcome to backend product edit page
            attachAdminHtml(mat[2],base_url);
        }
    }
    console.log(mat1,mat2);
    if(mat1 !== null && mat1.length > 0 && mat1[0] !== undefined) {
        if(mat1[1] !== undefined && mat1[2] !== undefined) { //welcome to backend order edit page
            attachOrderStatusUpdateEvent(mat1[2],base_url);
        }
    }
    if(mat2 !== null && mat2.length > 0 && mat2[0] !== undefined) {
        if(mat2[1] !== undefined && mat2[2] !== undefined && mat2[3] !== undefined && mat2[4] !== undefined) { //welcome to backend order edit page
            var e = $('td.infoBoxContent:contains(Product price minimum)'), h = e.html(), ns = h.replace('<strong>Product price minimum</strong><br>Product price minimum<br><input type="text" name="configuration[MODULE_PAYMENT_FINANCEPAYMENT_MIN_PRODUCT]" value="'+$('input[name="configuration[MODULE_PAYMENT_FINANCEPAYMENT_MIN_PRODUCT]"]')[0].value+'"><br>','<div class="product_min"><strong>Product price minimum</strong><br>Product price minimum<br><input type="text" name="configuration[MODULE_PAYMENT_FINANCEPAYMENT_MIN_PRODUCT]" value="'+$('input[name="configuration[MODULE_PAYMENT_FINANCEPAYMENT_MIN_PRODUCT]"]')[0].value+'"></div>');
            e.html(ns);
            var ec = $('input[name="configuration[MODULE_PAYMENT_FINANCEPAYMENT_PRODUCT_SELECTION]"]');
            function selectionChanged()
            {
                var pm = $('.product_min');
                ($('input[name="configuration[MODULE_PAYMENT_FINANCEPAYMENT_PRODUCT_SELECTION]"]:checked').val() == 'Products above minimum value') ? pm.show('slow') : pm.hide('slow');
            }
            ec.on('change',selectionChanged);
            selectionChanged();
        }
    }
    $(document).on("click","input[name=\'MODULE_PAYMENT_FINANCEPAYMENT_PRODUCT_FINANACE_PLANS\']",function() {
        var plans = [];
        $("input[name=\'MODULE_PAYMENT_FINANCEPAYMENT_PRODUCT_FINANACE_PLANS\']:checked").each(function() {
          plans.push($(this).val());
        });
        plans = plans.join(",");
        $("input#financepayment").val(plans);
        updateData(base_url,mat[2],plans);
    })
})
function attachAdminHtml(id,url)
{
	$.ajax({
        type     : 'post',
        url      : url+'/finance_main_handler.php',
        data     : {
        	action:'getAdminProductForm',
        	pID: id,
        },
        dataType : 'json',
        cache    : false,
        success: function(data) {
            $('form[name="new_product"] table').eq(2).append(data.html);
        }
    });
}

function attachOrderStatusUpdateEvent(order_id,url)
{
    $.ajax({
        type     : 'post',
        url      : url+'/finance_main_handler.php',
        data     : {
            action:'CheckFinanceActiveCall',
            oID: order_id,
        },
        dataType : 'json',
        cache    : false,
        success: function(data) {
            console.log('booom');
        }
    });
}
function updateData(base_url,id,plans)
{
    $.ajax({
        type     : 'post',
        url      : base_url+'/finance_main_handler.php',
        data     : {
            action:'updateProductPlans',
            pID: id,
            plans: plans
        },
        dataType : 'json',
        cache    : false,
        success: function(data) {
        }
    });
}