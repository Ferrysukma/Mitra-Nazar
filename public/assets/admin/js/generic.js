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

$('select').select2({
    theme: 'bootstrap4',
});

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