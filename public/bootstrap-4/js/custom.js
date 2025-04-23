

$(document).ready(function() {

    $('.button-minus').click(function () {

        var $input = $(this).parent().find("input[type='text']");

        var count = parseInt($input.val()) - 1;

        count = count < 1 ? 1 : count;

        $input.val(count);

        $input.change();

        return false;

    });

    $('.button-plus').click(function () {

        var $input = $(this).parent().find("input[type='text']");

        $input.val(parseInt($input.val()) + 1);

        $input.change();

        return false;

    });    
    

});



