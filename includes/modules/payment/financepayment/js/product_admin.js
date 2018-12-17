$(document).ready(function() {
    var base_url = window.location.origin,href = window.location.href,regex = new RegExp(/(categories.php)(?=.*action=new_product)(?=.*pID=([0-9]+))/g),mat = regex.exec(href);
    if(mat !== null && mat.length > 0 && mat[0] !== undefined) {
        if(mat[1] !== undefined && mat[2] !== undefined) { //welcome to backend product edit page
            attachAdminHtml(mat[2],base_url);
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