/*  image preview for add and edit form seat types starts */

    function preview_image_add_seat_type(event) {
        var reader = new FileReader();
        reader.onload = function() {
            
            var output = document.getElementById('output_image_add_seat_type');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function preview_image_edit_seat_type(event) {
        var reader = new FileReader();
        reader.onload = function() {
            
            var output = document.getElementById('output_image_edit_seat_type');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

/*  image preview for add and edit form seat types ends */



/*  image preview for add and edit form areas starts */

    function preview_image_add_area(event) {
        var reader = new FileReader();
        reader.onload = function() {
            
            var output = document.getElementById('output_image_add_area');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function preview_image_edit_area(event) {
        var reader = new FileReader();
        reader.onload = function() {
            
            var output = document.getElementById('output_image_edit_area');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

/*  image preview for add and edit form areas ends */



/*  edit seat form pop-up rendering starts */

    $(document).on('click', '.editSeat', function(){
            
        var seat_id;
        var base_url;

        seat_id = $(this).attr('id');
        base_url = $(this).attr('base_url');

        $('#'+seat_id+'seat_edit_link').hide();
        $('#'+seat_id+'seat_edit_waiting').show();

        $.ajax({
            url:base_url+'admin/Seats/fetchSingleSeat',
            method:"POST",
            data:{
                id:seat_id
            },
            dataType:"json",
            success:function(data){

                $('#editSeatModal').trigger("reset");
                $('#editSeatModal').modal('show');

                $('#'+seat_id+'seat_edit_link').show();
                $('#'+seat_id+'seat_edit_waiting').hide();

                $('#id_field').val(data.single_seat_data.id);
                $('#seat_no_edit_field').val(data.single_seat_data.seat_no);
                $('#area_edit_field').val(data.single_seat_data.area_id);
                $('#seat_type_edit_field').val(data.single_seat_data.seat_type);
            }
        })
    });

/*  edit seat form pop-up rendering ends */


/*  edit seat form submission starts */

    $('#editSeatForm').on('submit', function(event){

        $(this).find('input[type=submit]').prop('disabled', true);

        var base_url = $('#base_url_field').val();
        event.preventDefault();

        $.ajax({
            
            url:base_url+'admin/Seats/updateSeat',
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

/*  edit seat form submission ends */


/*  edit seat type form pop-up rendering starts */

    $(document).on('click', '.editSeatType', function(){
                
        var seat_type_id;
        var base_url;

        seat_type_id = $(this).attr('id');
        base_url = $(this).attr('base_url');

        $('#'+seat_type_id+'seat_type_edit_link').hide();
        $('#'+seat_type_id+'seat_type_edit_waiting').show();

        $.ajax({
            url:base_url+'admin/Seats/fetchSingleSeatType',
            method:"POST",
            data:{
                id:seat_type_id
            },
            dataType:"json",
            success:function(data){

                $('#editSeatTypeModal').trigger("reset");
                $('#editSeatTypeModal').modal('show');

                $('#'+seat_type_id+'seat_type_edit_link').show();
                $('#'+seat_type_id+'seat_type_edit_waiting').hide();

                $('#id_field').val(data.single_seat_type_data.id);
                $('#seat_type_title_edit_field').val(data.single_seat_type_data.seat_type_title);
                $('#area_edit_field').val(data.single_seat_type_data.area_id);

                var image= base_url+'uploads/'+data.single_seat_type_data.seat_type_image;
                $("#output_image_edit_seat_type").attr("src",image);
                $('#seat_type_old_pic_field').val(data.single_seat_type_data.seat_type_image);
            }
        })
    });

/*  edit seat Type form pop-up rendering ends */


/*  edit seat Type form submission starts */

    $('#editSeatTypeForm').on('submit', function(event){

        $(this).find('input[type=submit]').prop('disabled', true);

        var base_url = $('#base_url_field').val();
        event.preventDefault();

        $.ajax({
            
            url:base_url+'admin/Seats/updateSeatType',
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

/*  edit seat Type form submission ends */



/*  edit area form pop-up rendering starts */

    $(document).on('click', '.editArea', function(){
                    
        var area_id;
        var base_url;

        area_id = $(this).attr('id');
        base_url = $(this).attr('base_url');

        $('#'+area_id+'area_edit_link').hide();
        $('#'+area_id+'area_edit_waiting').show();

        $.ajax({
            url:base_url+'admin/Seats/fetchSingleArea',
            method:"POST",
            data:{
                id:area_id
            },
            dataType:"json",
            success:function(data){

                $('#editAreaModal').trigger("reset");
                $('#editAreaModal').modal('show');

                $('#'+area_id+'area_edit_link').show();
                $('#'+area_id+'area_edit_waiting').hide();

                $('#id_field').val(data.single_area_data.id);
                $('#area_title_edit_field').val(data.single_area_data.area_title);

                var image= base_url+'uploads/'+data.single_area_data.area_image;
                $("#output_image_edit_area").attr("src",image);
                $('#area_old_pic_field').val(data.single_area_data.area_image);
            }
        })
    });

/*  edit area form pop-up rendering ends */


/*  edit area form submission starts */

    $('#editAreaForm').on('submit', function(event){

        $(this).find('input[type=submit]').prop('disabled', true);

        var base_url = $('#base_url_field').val();
        event.preventDefault();

        $.ajax({
            
            url:base_url+'admin/Seats/updateArea',
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

/*  edit area form submission ends */