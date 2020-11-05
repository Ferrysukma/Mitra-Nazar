function resetForm(form)
{
    $("#"+form).find('.is-invalid').removeClass("is-invalid");
    $("#"+form).find('.is-valid').removeClass("is-valid");
    $("#"+form)[0].reset();
    $('#'+form).validate().resetForm();
    $('#'+form).find('input:text, input:password, input:file, select, textarea, input:hidden').val('');
    $('#'+form).find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}

function populateForm($form, data)
{
    resetForm($form);
    $.each(data, function(key, value) {
        var $ctrl = $form.find('[name='+key+']');
        if ($ctrl.is('select')){
            $('option', $ctrl).each(function() {
                if (this.value == value)
                    this.selected = true;
            });
        } else if ($ctrl.is('textarea')) {
            $ctrl.val(value);
        } else {
            switch($ctrl.attr("type")) {
                case "text":
                case "hidden":
                    $ctrl.val(value);   
                    break;
                case "checkbox":
                    if (value == '1')
                        $ctrl.prop('checked', true);
                    else
                        $ctrl.prop('checked', false);
                    break;
            } 
        }
    });
};

$.fn.buttonLoader = function(action = 'hide' ,text = null){
    if(action == 'show'){
        
        if(text == null){
            defaultText     = 'Saving....';
        }else{
            defaultText     = text;
        }
        $(this).attr('disabled','true');
        $(this).html(defaultText+ ' <span class="fa fa-circle-notch fa-spin"></span>');

    }else if(action == 'hide'){

        if(text == null){
            defaultText     = 'Save';
        }else{
            defaultText     = text;
        }

        $(this).removeAttr('disabled','true');
        $(this).html(defaultText);
    }

    return $(this);

}

function showModal(modal, form) {
    if (form != null) {
        resetForm(form);        
    }
    
    $('#'+modal).modal({backdrop: 'static', keyboard: false});
    $('#'+modal).modal('show');
}

function modalSelect2(modal) {
    $('#'+modal).find('select').select2({
        theme: 'bootstrap4',
        dropdownParent: '#'+modal
    });
}

function formatNumberSen(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.
    
    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") { return; }
    
    // original length
    var original_len = input_val.length;

    // initial caret position 
    var caret_pos = input.prop("selectionStart");
    
    // check for decimal
    if (input_val.indexOf(",") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(",");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumberSen(left_side);

        // validate right side
        right_side = formatNumberSen(right_side);
        
        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
            right_side += "00";
        }
        
        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = left_side + "," + right_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumberSen(input_val);
        input_val = input_val;
        
        // final formatting
        if (blur === "blur") {
            input_val += ",00";
        }
    }
    
    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function formatNumber(num) {
    return accounting.formatNumber(num, 2, ".", ",");
}

$('.amount').on({
    keyup: function() {
        formatCurrency($(this));
    },
    blur: function() { 
        formatCurrency($(this), 'blur');
    }
});

$('select').select2({
    theme: 'bootstrap4',
});

$('.only-number').keypress(function(event){
    if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
        event.preventDefault();
    }
});

function number_format(number) {
    return accounting.formatNumber(number, 2, ".", ",");
}

function notif(type, title, info) {
    Swal.fire({
        icon    : type,
        type    : type,
        title   : title,
        text    : info,
        timer   : 4000,
    });
}

function preventFormSubmit(idForm){
    $(idForm).submit(function(e){
        e.preventDefault();
    });
}

function resetFormAndValidation(idForm){
    $(idForm)[0].reset();

    var input = $('input, select, textarea');
    $.each(input, function(i, v){
        $(v).removeClass('is-valid is-invalid');
    });
    
    $(idForm).find('.invalid-feedback').remove();
}

function defaultValidateOptions(){
    var opt = {
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        focusInvalid: false,
        
        highlight: function (e) {
            $(e).closest('.form-control').removeClass('is-valid').addClass('is-invalid');
        },

        success: function (e) {
            $(e).parent().find('.form-control').removeClass('is-invalid').addClass('is-valid');
            $(e).remove();
        },

        errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2-hidden-accessible')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else if(element.parent().is('.input-group')) {
                error.insertAfter(element.parent());
            }
            else error.insertAfter(element);
        },
    };
    
    return opt;
}

function initAdvanceSearch(width, maxHeight){
    if(typeof width === 'undefined') var width = '300px';
    if(typeof maxHeight === 'undefined') var maxHeight = '400px';
    
    $('.dropdown-menu.advance-filter').css({
        "width": width,
        "max-height":maxHeight,
        "overflow-y":"auto"
    });
}

function showDropdown(button) {
    if ($('#'+button).hasClass('show')) {
        $('#'+button).toggle('hide');
    } else {
        $('#'+button).toggle('show');
    }
}

$(document).ready(function (){
    
    /* advance search */
    $('.dropdown-menu.keep-open').on('click', function (e) {
        e.stopPropagation();
    });

    $('.dropdown-menu').find('select').on('select2:open', function (e) {
        $('.select2-search__field').on('click', function (e) {
            e.stopPropagation();
        });
    });
});