
/*  image preview for add and edit form main category starts */

    function preview_image_add_main_catg(event) {
        var reader = new FileReader();
        reader.onload = function() {
            
            var output = document.getElementById('output_image_add_main_catg');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function preview_image_edit_main_catg(event) {
        var reader = new FileReader();
        reader.onload = function() {
            
            var output = document.getElementById('output_image_edit_main_catg');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

/*  image preview for add and edit form main category ends */


/*  image preview for add and edit form sub category starts */

function preview_image_add_sub_catg(event) {
    var reader = new FileReader();
    reader.onload = function() {
        
        var output = document.getElementById('output_image_add_sub_catg');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

function preview_image_edit_sub_catg(event) {
    var reader = new FileReader();
    reader.onload = function() {
        
        var output = document.getElementById('output_image_edit_sub_catg');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

/*  image preview for add and edit form sub category ends */


/*  edit main category form pop-up rendering starts */

    $(document).on('click', '.editMainCatg', function(){
        
        var main_catg_id;
        var base_url;

        main_catg_id = $(this).attr('id');
        base_url = $(this).attr('base_url');

        $('#'+main_catg_id+'main_catg_edit_link').hide();
        $('#'+main_catg_id+'main_catg_edit_waiting').show();

        $.ajax({
            url:base_url+'admin/Categories/fetchSingleMainCategory',
            method:"POST",
            data:{
                id:main_catg_id
            },
            dataType:"json",
            success:function(data){

                $('#editMainCatgModal').trigger("reset");
                $('#editMainCatgModal').modal('show');

                $('#'+main_catg_id+'main_catg_edit_link').show();
                $('#'+main_catg_id+'main_catg_edit_waiting').hide();

                $('#id_field').val(data.single_main_catg_data.id);
                $('#main_catg_edit_title_field').val(data.single_main_catg_data.main_catg_title);
                $('#main_catg_edit_status_field').val(data.single_main_catg_data.main_catg_status);            

                var image= base_url+'uploads/'+data.single_main_catg_data.main_catg_image;
                $("#output_image_edit_main_catg").attr("src",image);
                $('#main_catg_old_pic_field').val(data.single_main_catg_data.main_catg_image);
            }
        })
    });

/*  edit main category form pop-up rendering ends */


/*  edit main category form submission starts */

    $('#editMainCatgForm').on('submit', function(event){

        $(this).find('input[type=submit]').prop('disabled', true);

        var base_url = $('#base_url_field').val();
        event.preventDefault();

        $.ajax({
            
            url:base_url+'admin/Categories/updateMainCategory',
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success:function(data) {

                if(data.status){

                    location.reload();                                              
                }
                else{

                    location.reload();
                }   
            }
        })
    }); 

/*  edit main category form submission ends */


/*  edit sub category form pop-up rendering starts */

    $(document).on('click', '.editSubCatg', function(){
            
        var sub_catg_id;
        var base_url;

        sub_catg_id = $(this).attr('id');
        base_url = $(this).attr('base_url');

        $('#'+sub_catg_id+'sub_catg_edit_link').hide();
        $('#'+sub_catg_id+'sub_catg_edit_waiting').show();

        $.ajax({
            url:base_url+'admin/Categories/fetchSingleSubCategory',
            method:"POST",
            data:{
                id:sub_catg_id
            },
            dataType:"json",
            success:function(data){

                $('#editSubCatgModal').trigger("reset");
                $('#editSubCatgModal').modal('show');

                $('#'+sub_catg_id+'sub_catg_edit_link').show();
                $('#'+sub_catg_id+'sub_catg_edit_waiting').hide();

                $('#id_field').val(data.single_sub_catg_data.id);
                $('#sub_catg_edit_title_field').val(data.single_sub_catg_data.sub_catg_title);
                $('#main_catg_edit_field').val(data.single_sub_catg_data.main_catg_id);
                $('#sub_catg_edit_status_field').val(data.single_sub_catg_data.sub_catg_status);            

                var image= base_url+'uploads/'+data.single_sub_catg_data.sub_catg_image;
                $("#output_image_edit_sub_catg").attr("src",image);
                $('#sub_catg_old_pic_field').val(data.single_sub_catg_data.sub_catg_image);
            }
        })
    });

/*  edit sub category form pop-up rendering ends */


/*  edit sub category form submission starts */

    $('#editSubCatgForm').on('submit', function(event){

        $(this).find('input[type=submit]').prop('disabled', true);

        var base_url = $('#base_url_field').val();
        event.preventDefault();

        $.ajax({
            
            url:base_url+'admin/Categories/updateSubCategory',
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success:function(data) {

                if(data.status){

                    location.reload();                                              
                }
                else{

                    location.reload();
                }   
            }
        })
    }); 

/*  edit sub category form submission ends */
