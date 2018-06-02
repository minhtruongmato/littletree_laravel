// Product management
window.onload = function(){
    var url = window.location.origin;
    // is_discount unchecked by default
    // so we need to disable 2 discount fields too
    // but enable in edit mode, and discount checkbox checked before
    if($('#is_discount').is(':checked')){
        $("#discount_percent").prop('disabled', false);
        $("#discount_price").prop('disabled', false);
    }else{
        $("#discount_percent").prop('disabled', true);
        $("#discount_price").prop('disabled', true);
    }

    // if($('#is_gift').is(':checked')){
    //     $("#gift").prop('disabled', false);
    // }else{
    //     $("#gift").prop('disabled', true);
    // }

    // enable 2 discount fields when is_discount checked, disable again when is_discount uncheck
    $('#is_discount').change(function(){
        if($(this).is(':checked')){
            $("#discount_percent").prop('disabled', false);

            $("#discount_price").prop('disabled', false);
        }else{
            $("#discount_percent").val('');
            $("#discount_percent").prop('disabled', true);

            $("#discount_price").val('');
            $("#discount_price").prop('disabled', true);
        }
    });

    // $('#trademark_id').change(function(){
    //     $('#category_id').html('');

    //     

    //     $.ajax({
    //         url: url + '/mmm/admin/category/fetchByTrademark/{trademark_id}',
    //         method: 'GET',
    //         data: {
    //             trademark_id: $('#trademark_id').val()
    //         },
    //         success: function(res){
    //             var categories = res.categories;
    //             $('#category_id').append('<option value="">Chọn danh mục</option>');
    //             $.each(categories, function(key, value){
    //                 $('#category_id').append('<option value="' + key + '">' + value + '</option>');
    //             });
    //             console.log(res.categories);
    //             res.categories
    //         },
    //         error: function(){
    //             alert('ERROR!');
    //         }
    //     })
    // });

    $('.type').each(function(){
        var type_id = $(this).val();
        var page = $(this).data('page');
        
        var check = '';
        $.ajax({
            url: url + '/hamruouthinh24/admin/product/fetchByType/{type_id}',
            method: 'GET',
            data: {
                type_id : type_id
            },
            success: function(res){
                var kinds = res.kinds;
                $.each(kinds, function(key, value){
                    $('.kind').append('<option value="' + key + '" >' + value + '</option>');
                    $(".kind").val(page);
                });
                console.log(res.kinds);
                res.kinds
            },
        })
    })



    $('.type').change(function(){
        var type_id = $(this).val();
        
        $.ajax({
            url: url + '/hamruouthinh24/admin/product/fetchByType/{type_id}',
            method: 'GET',
            data: {
                type_id : type_id
            },
            success: function(res){
                var kinds = res.kinds;
                $('.kind').html('');
                $('.kind').append('<option class="kind_option" value="">---------------------Chọn dòng sản phẩm---------------------</option>');
                $.each(kinds, function(key, value){
                    $('.kind').append('<option value="' + key + '">' + value + '</option>');
                });
                console.log(res.kinds);
                res.kinds
            },
        })
    })

    $('.kind').change(function(){
        var kind_id = $(this).val();
        
        $.ajax({
            url: url + '/hamruouthinh24/admin/product/fetchByKind/{kind_id}',
            method: 'GET',
            data: {
                kind_id : kind_id
            },
            success: function(res){
                var trademarks = res.trademarks;
                $('.trademark').html('');
                $('.trademark').append('<option class="trademark_option" value="">---------------------Chọn dòng sản phẩm---------------------</option>');
                $.each(trademarks, function(key, value){
                    $('.trademark').append('<option value="' + key + '">' + value + '</option>');
                });
                console.log(res.trademarks);
                res.trademarks
            },
        })
    })


    $('.kind').each(function(){
        var kind_id = $(this).data('id');
        
        var page = $(this).data('page');
        
        var check = '';
        $.ajax({
            url: url + '/hamruouthinh24/admin/product/fetchByKind/{kind_id}',
            method: 'GET',
            data: {
                kind_id : kind_id
            },
            success: function(res){
                var trademarks = res.trademarks;
                $.each(trademarks, function(key, value){
                    $('.trademark').append('<option value="' + key + '" >' + value + '</option>');
                    $(".trademark").val(page);
                });
                console.log(res.trademarks);
                res.trademarks
            },
        })

    })

    $('.remove-image').click(function(){
        var check = $(this);
        var image = $(this).data('image');
        var id = $(this).data('id');
        var token = $('#token').val();
        $.ajax({
            url: url + '/littletree_laravel/admin/product/deleteImage',
            method: 'POST',
            data: {
                image : image, id : id, _token : token
            },
            success: function(res){
                check.parent('div').fadeOut();
                console.log(res.image_json);
            },
        })
    });

}
