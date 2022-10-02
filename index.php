
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" ">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <title>Blog Cuisine</title>
</head>

    <div class="container">
        <span id="message"></span>
               <button type="button" name="add" class="btn btn-primary" id="add">
                   Add Neue Eintrage
               </button>


                <table id="onTouchCarrier" class="table table-bordered table-striped" style="width: 600px!important;">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>kundennummer</th>
                                <th>name</th>
                                <th>urlsc</th>
                                <th>rufnummersc</th>
                                <th>urlcc</th>
                                <th>rufnummercc</th>
                                <th>auftragsart</th>
                                <th></th>

                            </tr>
                        </thead>
                </table>
        </div>

<!--</div>
<style>
    show {
        display: block;
    }

</style>
-->
        <div id="carrierModal" class="modal fade"  tabindex="-1">
            <div class="modal-dialog">
                <form method="post" id="carrierForm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span id="message"></span>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Edit User</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group"
                            <label for="kundennummer" class="control-label">kundennummer</label>
                            <input type="text" class="form-control" id="kundennummer" name="kundennummer" placeholder="kundennummer" >
                            <span class="error" id="kundennummer_erro"> </span>
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="name" >
                            <span class="error" id="name_erro"> </span>
                        </div>
                        <div class="form-group">
                            <label for="urlSc" class="control-label">urlSc</label>
                            <input type="url" class="form-control"  id="urlSc" name="urlSc" placeholder="urlSc" >
                        </div>
                        <div class="form-group">
                            <label for="rufnummerSc" class="control-label">rufnummerSc</label>
                            <input type="tel" class="form-control"  id="rufnummerSc" name="rufnummerSc">
                            <span class="error" id="rufnummerSc_erro"> </span>
                        </div>
                        <div class="form-group">
                            <label for="urlCc" class="control-label">urlCc</label>
                            <input type="url" class="form-control" id="urlCc" name="urlCc" placeholder="urlCc">
                        </div>
                        <div class="form-group">
                            <label for="$rufnummerCc" class="control-label">rufnummerCc</label>
                            <input type="tel" class="form-control" id="rufnummerCc" name="rufnummerCc" placeholder="rufnummerCc">
                        </div>

                        <div class="form-group">
                            <label for="auftraggsart" class="control-label">auftragsart</label>
                            <input type="text" class="form-control" id="auftraggsart" name="auftraggsart" placeholder="auftragsart">
                            <span class="error" id="auftraggsart_error"> </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="action" id="action" value="" />
                        <input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>


<script>


    //// C'est quand la page a ete charge que le script doit etre utiliser
    $(document).ready( function ()
    {

        $.noConflict();
        $.extend( $.fn.DataTable.ext.classes, {
            sWrapper: "dataTables_wrapper container-fluid dt-bootstrap4",
        } );
        $('#onTouchCarrier').DataTable( {
            "lengthChange": true,
            //bAutoWidth": false,
            "paging":true,
            // "processing": true,
            //"paging": true,
            ajax: {
                url: "ajax_action.php" , dataSrc: '',
                type: "POST",
                dataType: "json",
                data:"data",
                "contentType":'application/json; charset=utf-8',
            },
            columns: [
                { data: "id" },
                { data: "kundennummer" },
                { data: "name"},
                { data: "urlSc" },
                { data: "rufnummerSc" },
                { data: "urlCc" },
                { data: "rufnummerCc" },
                { data: "auftraggsart" },
                {
                    'data': null,
                    'render': function (data, type, row) {
                        return '<button  type="button" name="edit" class="btn btn-primary edit" id="' + row.id +'" data-toggle="modal" data-target="#carrierModal">Edit</button>'
                    }
                },
                //{defaultContent :'<button type="button" name="edit"    class="btn btn-primary edit" data-toggle="modal" data-target="#carrierModal" >Edite</button>'}
            ],
            "pageLength": 10
        });
        $("#onTouchCarrier").css("width","600px")

        $("#carrierModal").submit(function (event)
        {
            event.preventDefault();
            console.log('submit');
            $('#save').attr('disabled', 'disabled');
           /* $('#kundennummer').on('input', function() {*/
            /*    checkckundennummer();

            });

            $('#name').on('input', function() {
                checkcname();
            });

            $('#rufnummerSc').on('input', function() {
                checkRufnummerSc();
            });


            $('#auftraggsart').on('input', function() {
                checkauftragsart();
                $('#auftraggsart_erro').css('color','red ');
            });


            if ( !checkckundennummer() && !checkcname() && !checkauftragsart()  ) {

                $("#message").html('<div class="alert alert-warning">die drei felter sind plicht felder</div>');


            }
*/
           /* else if ( !checkckundennummer() || !checkcname() || !checkauftragsart()  )

            {
                $("#message").html('<div class="alert alert-warning">die drei felter sind plicht felder</div>');


            }
            else {*/
            var formData = $(this).serialize();
            $.ajax({
                url: "ajax_action.php",
                method: "POST",
                data: formData,
                dataType:'json',
                beforeSend: function() {
                   $('#save').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                  $('#save').css({
                      "border-radius": "50%"
                    });
                 },
                success: function (data) {
                    //var dateroor = JSON.parse(data)
                    if (data.error)
                    {
                        console.log(data.error);
                      /*  jQuery.each( data.error, function( i, val ) {
                            $("#" + val).text("Mine is " + val + ".");
                        });
                            console.log('salut');
                        $('#kundennummer_erro').html('<div class="alert alert-danger"> data.error </div>');*/

                   /* if(response.type === 'kundennummer')
                    { //load json data from server and output message
                        $('#kundennummer_erro').html(response.text);
                    }
                       else if (response.type === 'name')
                    {
                        $('#name_erro').html(response.text);
*/
                       /* $('#kundennummer_erro').html(response.text);
                        output = '<div class="error">'+data.text+'</div>';
                        $('#name_erro').css('border','red 1px solid');
                        $("#carrierForm  input[required=true], #carrierForm input[required=true]").val('');
                        //$("#carrierForm ").slideUp(); //hide form after success
                        $('#save').attr('disabled', true);*/
                    }
                    else
                    {
                        output = '<div class="success">'+data.text+'</div>';
                        //reset values in all input fields
                        $('#carrierModal').modal('hide');
                        $('#save').attr('disabled', true);
                        //$('#save').attr('disabled', false);
                        $("#message").html('<div class="success" > Ihre Daten wurd elfogreich gesende</div>');
                        $('#carrierForm')[0].reset();
                    }

                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }

            });
            //}

        });




  // togler modal
        $('#add').click(function ()
        {
            $('#carrierModal').modal('show');
            console.log('ouvre le modale ');
        });



        $('#carrierModal').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
            //$(':input', this).val('');
            //console.log('modsl form clearn');
        });



    });



    function checkckundennummer() {

        var kundennummer = $('#kundennummer').val();

        if ( kundennummer === '' ) {
            $('#kundennummer_erro').html('kundennunner est obligatoire et doit pas etre vide ');
            $('#kundennummer_erro').css('color', 'red ');
            $('#kundennummer').css('border', 'red 1px solid ');
            return false;
        }

        else if ( !kundennummer.match(/^\d+$/) ) {
            //it's all digits
            $('#kundennummer_erro').html('kundennunner doit avoir des chiffres ');
            $('#kundennummer_erro').css('color', 'red ');

        } else if ($('#kundennummer').val().length < 4) {
            $('#kundennummer_erro').html('le numero de client doit avoir plus de 4 caractere');
            return false;

        }
        else {
            $('#kundennummer_erro').html('');
            //$('#kundennummer').css('border', 'green 1px solid');
            return true;
        }
    }

    function checkcname() {

        var name = $('#name').val();

        if (name === '') {
            $('#name_erro').html('name is Field is required');
            $('#name_erro').css('color', 'red ');
            $('#name').css('border', 'red 1px solid ');
            return false;
        }

        else if ($('#name').val().length < 4)
        {
            $('#name_erro').html('nane soll große als  4');
            return false;
        }

        //else if (!name.match(/^[a-z]+$/i))
        else if (!name.match(/\d/))

            ///[a-z]+/g
        {
            $('#name_erro').html('il ne doit pas comporter de chiffre dans cette field ');
            $('#name').css('border', 'red 1px solid ');
        }
        else
        {
            $('#name_erro').html('');
            //$('#name').css('border','green 1px solid ');
            return true;
        }
    }


    function checkauftragsart() {

        var pattern = /^[A-Za-z0-9]+$/;
        var auftraggsart = $('#auftraggsart').val();


        if (auftraggsart === '') {
            $('#auftraggsart_error').html('Auftragsart est obligatoire  et doit etre des nomm pas de chiffre');
            $('#auftraggsart').css('border','red 1px solid ');
            $('#auftraggsart_error').css('color','red ');
            return false;
        } else if ($('#auftraggsart').val().length < 1)
        {
            $('#auftraggsart_error').html('auftragsart doit au mimunum 2 ou bien plus ');
            $('#auftraggsart_error').css('color','red ');
            return false;
        }
        else if (!auftraggsart.match(/^[a-z]+$/i))
            ///[a-z]+/g
        {
            $('#auftraggsart_erro').html('il ne doit pas comporter de chiffre dans cette field ');
            $('#auftraggsart').css('border', 'red 1px solid ');
        }
        else {
            $('#auftraggsart_error').html('');
            //$('#auftraggsart').css('border', 'green 1px solid');
            return true;
        }
    }

    function  checkRufnummerSc()
    {

        var rufnummerSc = $('#rufnummerSc').val();


        if (!rufnummerSc === '' ) {
            $('#rufnummerSc').html('nur telephone nummer');
            $('#rufnummerSc').css('border','red 1px solid ');
            $('#rufnummerSc_erro').css('color','red ');
            return false;
        }

        else if (!rufnummerSc.match(/08(?:\s*(?:\d\s*){5,18})?$/))

        {
            $('#rufnummerSc_erro').html('JAIN BESOIN DES NUMMERO VALIDE');
            $('#rufnummerSc').css('border', 'red 1px solid ');
        }
        else {
            $('#rufnummerSc').html('');
            $('#rufnummerSc').css('border', 'green 1px solid');
            $('#rufnummerSc_erro').css('display', 'none');
            return true;
        }

    }

    // update function
    $("#onTouchCarrier ").on('click', '.edit', function(e)
    {
        var table = $('#onTouchCarrier').DataTable();
        console.log(parent);
        var row  = $(this).parents('tr')[0];
        console.log(row);
        var rowData = table.row(row).data();
        /*$('#onTouchCarrier tbody').on( 'click', 'tr', function () {
            console.log( table.row( this ).data() );
        } );*/
            console.log(rowData);
        $('#kundennummer').val(rowData.kundennummer);
        $('#name').val(rowData.name);
        $('#urlSc').val(rowData.urlSc);
        $('#rufnummerSc').val(rowData.rufnummerSc);
        $('#urlCc').val(rowData.urlCc);
        $('#rufnummerCc').val(rowData.rufnummerCc);
        $('#auftraggsart').val(rowData.auftraggsart);


        var id = $(this).attr("id");
        var action = 'getRecord';
        $.ajax({
           /* "url": "update_action.php",
            method:"GET",
            data:'id='+id ,*/
            "url": "update_action.php",
            method:"POST",
             //data:{rowData,id:id}
            data: {id: id, action: action},
            dataType: "json",
            success:function(response){
                //var response = JSON.parse(data);
                //console.log(response.name);
                /*$('#carrierModal').modal('show');
                $('#kundennummer').val(response.kundennummer);
                $('#name').val(response.name);
                $('#urlSc').val(response.urlSc);
                $('#rufnummerSc').val(response.rufnummerSc);
                $('#urlCc').val(response.urlCc);
                $('#rufnummerCc').val(response.rufnummerCc);
                $('#auftraggsart').val(response.auftraggsart);*/
                $('.modal-title').html("<i class='fa fa-plus'></i> Edit ontouchcarrier");
                $('#action').val('updateOnTouchCarrier');
                $('#save').val('Update');
            },
            error: function (request, status, error) {
                alert(error.data);
            }
        })
        e.preventDefault();
    });
</script>
</body>
</html>
