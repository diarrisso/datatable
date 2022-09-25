
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" ">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">



    <title>Blog Cuisine</title>
</head>


<body>
<div class="container">


    <div class="panel-heading mt-4" style="float: right>
            <div class="row">

    <div class="col-md-2" ">
    <!--                    <button type="button" name="add" id="addEmployee" class="btn btn-success btn-xs">Add Employee</button>-->
    <button type="button" name="add" class="btn btn-primary" data-toggle="modal" data-target="#carrierModal" >Add Neue Eintrage</button>
</div>
</div>
</div>
<table id="onTouchCarrier" class="table table-bordered table-striped">
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
        <th></th>
    </tr>
    </thead>
</table>
</div>

<style>
    show {
        display: block;
    }

</style>

<div id="carrierModal" class="modal fade">
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
    </div>
    </form>
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
        $('#onTouchCarrier').DataTable( {
            "lengthChange": true,
            "processing": true,
            "serverSide": true,
            'serverMethod': 'post',
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
                {defaultContent :'<button type="button" name="edit"    class="btn btn-primary" data-toggle="modal" data-target="#carrierModal" >Edite</button>'}
            ],
            "pageLength": 10
        });


        $("#carrierModal").on('submit', '#carrierForm', function (event) {
            event.preventDefault();
            $('#kundennummer').on('input', function() {

                checkckundennummer();

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


            if ( !checkckundennummer() && !checkcname() && !checkauftragsart() || !checkRufnummerSc() ) {

                $("#message").html('<div class="alert alert-warning">die drei felter sind plicht felder</div>');
            }

            else if ( !checkckundennummer() || !checkcname() || !checkauftragsart() || checkRufnummerSc() )

            {
                $("#message").html('<div class="alert alert-warning">die drei felter sind plicht felder</div>');

            }

            $('#save').attr('disabled', 'disabled');
            var formData = $(this).serialize();


            $.ajax({
                url: "ajax_action.php",
                method: "POST",
                data: formData,

                // beforeSend: function() {
                //     $('#save').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                //     $('#save').attr("disabled", true);
                //     $('#save').css({
                //         "border-radius": "50%"
                //     });
                // },
                success: function (data) {
                    if(data.type === 'error')
                    { //load json data from server and output message
                        output = '<div class="error">'+data.text+'</div>';
                        $('span').html('Hello world. Ce texte est affiché par jQuery.');
                        console.log('hier ');

                            $('#name_erro').css('border','red 1px solid');
                        $("#carrierForm  input[required=true], #carrierForm input[required=true]").val('');
                        $("#contact_form #contact_body").slideUp(); //hide form after success
                        $('#save').attr('disabled', 'disabled');
                    }else{
                        output = '<div class="success">'+data.text+'</div>';
                        //reset values in all input fields

                       /* $('#carrierForm')[0].reset();
                        $('#carrierModal').modal('hide');
                         $('#save').attr('disabled', false)*/
                    }

                    // $('#carrierForm')[0].reset();
                    // $('#carrierModal').modal('hide');
                    // $('#save').attr('disabled', false);
                    //dataRecords.ajax.reload();
                }
            });

        });

    } );



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
            $('#kundennummer').css('border', 'green 1px solid');
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
            $('#name').css('border','green 1px solid ');
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
            $('#auftraggsart').css('border', 'green 1px solid');
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



















</script>





</body>
</html>
