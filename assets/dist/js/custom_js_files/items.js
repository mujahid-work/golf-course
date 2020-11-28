/*  image preview for add and edit form Item starts */

function preview_image_add_item(event) {
    var reader = new FileReader();
    reader.onload = function() {
        
        var output = document.getElementById('output_image_add_item');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

function preview_image_edit_item(event) {
    var reader = new FileReader();
    reader.onload = function() {
        
        var output = document.getElementById('output_image_edit_item');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

/*  image preview for add and edit form Item ends */


/*  edit Item form pop-up rendering starts */

    $(document).on('click', '.editItem', function(){
            
        var item_id;
        var base_url;

        item_id = $(this).attr('id');
        base_url = $(this).attr('base_url');
        
        $('#'+item_id+'item_edit_link').hide();
        $('#'+item_id+'item_edit_waiting').show();

        $.ajax({
            url:base_url+'admin/Items/fetchSingleItem',
            method:"POST",
            data:{
                id:item_id
            },
            dataType:"json",
            success:function(data){

                $('#editItemForm').trigger("reset");
                $('#editItemModal').modal('show');

                $('#'+item_id+'item_edit_link').show();
                $('#'+item_id+'item_edit_waiting').hide();

                $('#id_field').val(data.single_item_data.id);
                $('#item_edit_title_field').val(data.single_item_data.item_title);
                $('#item_edit_main_catg_field').val(data.single_item_data.main_catg_id);
                $('#item_edit_sub_catg_field').val(data.single_item_data.sub_catg_id);
                $('#item_edit_description_field').val(data.single_item_data.item_description);
                $('#item_edit_price_field').val(data.single_item_data.item_price);
                $('#item_edit_availability_field').val(data.single_item_data.item_availability);
                $('#item_edit_status_field').val(data.single_item_data.item_status);            

                var image= base_url+'uploads/'+data.single_item_data.item_image;
                $("#output_image_edit_item").attr("src",image);
                $('#item_old_pic_field').val(data.single_item_data.item_image);
            }
        })
    });

/*  edit Item form pop-up rendering ends */


/*  edit Item form submission starts */

    $('#editItemForm').on('submit', function(event){

        $(this).find('input[type=submit]').prop('disabled', true);

        var base_url = $('#base_url_field').val();
        event.preventDefault();

        $.ajax({
            
            url:base_url+'admin/Items/updateItem',
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

/*  edit Item form submission ends */