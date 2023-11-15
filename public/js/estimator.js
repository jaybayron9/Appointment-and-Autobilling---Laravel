let row = '';
let totalItems = 0;
let totalPrice = 0;
var estimator_div = $('#estimator-page');
var checkout_div = $('#checkout-page');

$('.add-cart-btn').click(function() {  
    let val = $(this).data('row-data').split('~'); 
    let id = val[0];
    let product = val[1];
    let price = parseFloat(val[2]);
    let img = val[3];

    const hmr_price = price.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    }); 

    row = '<tr class="border-b border-slate-400 hover:bg-blue-200">'
            row += '<td class="font-semibold text-lg">' + product + '</td>';
            row += '<td class="font-semibold text-lg whitespace-nowrap text-gray-700">₱ <span>'+ hmr_price +'</span></td>';
            row += '<td class="text-right">';
                row += '<button data-row-data="'+ id +'" class="remove-added mt-2 px-2 text-gray-500">';
                    row += '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">';
                    row += '<path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />';
                row += '</svg>';
            row += '</td>';
        row += '</tr>'; 
    $('#added-list').append(row);

    $('#product_'+id).hide();
    $('#after-add'+id).show(); 

    totalItems++;
    totalPrice += price;
    total_items(); 
    total_price();
    check_added_list();
});

$(document).on('click', '.remove-added', function() {
    $(this).closest('tr').remove();
    let id = $(this).data('row-data');
    $('#product_'+id).show();
    $('#after-add'+id).hide(); 

    totalItems--;
    let price = parseFloat($(this).closest('tr').find('span').text().replace(/,/g, ''));
    totalPrice -= price;
    total_items(); 
    total_price(); 
    check_added_list();
});

function total_items() {
    $('#total-items').text(totalItems + ' Item(s)');
}

function total_price() {
    const hmr_total_price = totalPrice.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
    $('#total-price').text('₱ ' + hmr_total_price);
    $('.total-price').text('₱ ' + hmr_total_price);
}

function check_added_list() {
    const rowCount = $('#added-list tr').length; 
    const btn = $('#checkout-btn');
    return rowCount != 0 ? btn.removeClass('hidden') : btn.addClass('hidden');
} check_added_list(); 

function tableData() {
    var data = []; 
    $('tbody tr').each(function () {
        var product = $(this).find('td:first-child').text();
        var price = $(this).find('td:nth-child(2)').text(); 
        data.push({
            product: product,
            price: price, 
        });
    });   

    return data;
}

$('#checkout-btn').click(() => {  
    var data = tableData();
    data.forEach(value => {
        row = '<tr class="border-b-2 border-gray-300">';
            row += '<td>' + value.product + '</td>';
            row += '<td class="text-center">1</td>';
            row += '<td class="text-right">'+ value.price +'</td>';
        row += '</tr>'; 

        $('#quantity-summary').html($('#total-items').text());
        $('#total-summary').html($('#total-price').text());
        $('#checkout-summary').append(row);
    });

    checkout_div.removeClass('animate__backOutRight');
    setTimeout(() => {
        checkout_div.addClass('hidden animate__bounceInRight');
    }, 500);
    estimator_div.addClass('animate__bounceOutLeft');
    setTimeout(() => {
        checkout_div.addClass('hidden');
        estimator_div.addClass('hidden animate__bounceInLeft');
        checkout_div.removeClass('hidden');  
    }, 500);
}); 

function back_btn() {
    checkout_div.removeClass('animate__bounceInRight');
    checkout_div.addClass('animate__backOutRight'); 
    estimator_div.removeClass('animate__bounceOutLeft');
    setTimeout(() => {
        checkout_div.addClass('hidden');
        estimator_div.addClass('animate__bounceInLeft')
        estimator_div.removeClass('hidden');
    }, 300);  

    $('#checkout-summary').html('')
}

$('#back-btn').click(() => {  
    back_btn();
});