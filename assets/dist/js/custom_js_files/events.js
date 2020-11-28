/*  image preview for add and edit form Event starts */

function preview_image_add_event(event) {
    var reader = new FileReader();
    reader.onload = function() {
        
        var output = document.getElementById('output_image_add_event');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

function preview_image_edit_event(event) {
    var reader = new FileReader();
    reader.onload = function() {
        
        var output = document.getElementById('output_image_edit_event');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

/*  image preview for add and edit form Event ends */


/*  edit Event form pop-up rendering starts */

    $(document).on('click', '.editEvent', function(){
            
        var event_id;
        var base_url;

        event_id = $(this).attr('id');
        base_url = $(this).attr('base_url');

        $('#'+event_id+'event_edit_link').hide();
        $('#'+event_id+'event_edit_waiting').show();

        $.ajax({
            url:base_url+'admin/events/fetchSingleEvent',
            method:"POST",
            data:{
                id:event_id
            },
            dataType:"json",
            success:function(data){

                $('#editEventForm').trigger("reset");
                $('#editEventModal').modal('show');

                $('#'+event_id+'event_edit_link').show();
                $('#'+event_id+'event_edit_waiting').hide();

                $('#id_field').val(data.single_event_data.id);
                $('#event_edit_title_field').val(data.single_event_data.event_title);
                $('#event_edit_description_field').val(data.single_event_data.event_description);
                $('#event_edit_date_field').val(data.single_event_data.event_date);
                $('#event_edit_status_field').val(data.single_event_data.event_status);            

                var image= base_url+'uploads/'+data.single_event_data.event_image;
                $("#output_image_edit_event").attr("src",image);
                $('#event_old_pic_field').val(data.single_event_data.event_image);
            }
        })
    });

/*  edit Event form pop-up rendering ends */


/*  edit Event form submission starts */

    $('#editEventForm').on('submit', function(event){

        $(this).find('input[type=submit]').prop('disabled', true);

        var base_url = $('#base_url_field').val();
        event.preventDefault();

        $.ajax({
            
            url:base_url+'admin/events/updateEvent',
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

/*  edit Event form submission ends */