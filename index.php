
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" ">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <title>Blog Cuisine</title>
</head>
<body>
<div class="container">
    <span id="message"></span>
    <button type="button" name="add" class="btn btn-primary mt-3 mb-3" id="add">
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
                    <span class="invalid-feedback" id="kundennummer_erro"> </span>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="name" >
                    <span class="invalid-feedback" id="name_erro"> </span>
                </div>
                <div class="form-group">
                    <label for="urlSc" class="control-label">urlSc</label>
                    <input type="text" class="form-control"  id="urlSc" name="urlSc" placeholder="urlSc" >
                    <span class="invalid-feedback" id="urlSc_erro"> </span>
                </div>
                <div class="form-group">
                    <label for="rufnummerSc" class="control-label">rufnummerSc</label>
                    <input type="tel" class="form-control"  id="rufnummerSc" name="rufnummerSc">
                    <span class="invalid-feedback" id="rufnummerSc_erro"> </span>
                </div>
                <div class="form-group">
                    <label for="urlCc" class="control-label">urlCc</label>
                    <input type="text" class="form-control" id="urlCc" name="urlCc" placeholder="urlCc">
                    <span class="invalid-feedback" id="urlCc_erro"> </span>
                </div>
                <div class="form-group">
                    <label for="$rufnummerCc" class="control-label">rufnummerCc</label>
                     <input type="tel" class="form-control" id="rufnummerCc" name="rufnummerCc" placeholder="rufnummerCc">
                     <span class="invalid-feedback" id="rufnummerCc_erro"> </span>
                </div>

                <div class="form-group">
                    <label for="auftragsart" class="control-label">auftragsart</label>
                    <input type="text" class="form-control" id="auftragsart" name="auftragsart" placeholder="auftragsart">
                    <span class="invalid-feedback" id="auftragsart_error"> </span>
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
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" ></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

<script>


    //// C'est quand la page a ete charge que le script doit etre utiliser
    $(document).ready( function ()
    {
        $.noConflict();
      /*  $.extend( $.fn.DataTable.ext.classes, {
            sWrapper: "dataTables_wrapper container-fluid dt-bootstrap4",
        } );*/
        $('#onTouchCarrier').DataTable( {
            //searchDelay: 5000,
            "processing": true,
            "serverSide": true,
            "paging":true,
            responsive: true,
            ajax: {
                url: "ajax_action.php" , dataSrc: "data",
                type: "POST",
                dataType: "json",
            },
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
                ],
            columns: [
                { data: "DT_RowId" },
                { data: "kundennummer" },
                { data: "name"},
                {
                    data: 'urlSc',
                    render : function(data, type, row, meta) {return'<a href="' + data + '">' + data + '</a>';},
                },

                { data: "rufnummerSc" },

                {
                    data:"urlCc",
                    render : function(data, type, row, meta) {return'<a href="' + data + '">' + data + '</a>';},
                },
                { data: "rufnummerCc" },
                { data: "auftragsart" },
                {
                    'data': null,
                    'render': function (data, type, row) {
                        return '<button  type="button" name="edit" class="btn btn-primary edit" id="' + row.id +'" data-toggle="modal" data-target="#carrierModal" title="Edit">' +
                            '<i class="fa fa-edit" style="font-size:24px"></i>' +
                            '</button>'
                    }
                },
            ],
            "pageLength": 10
        });
        $("#onTouchCarrier").css("width","600px")

        $("#carrierModal").on('submit','#carrierForm', function(event)
        {
            event.preventDefault();
            var  save = $('#save').val();

            if (save === 'Save')
            {
                $('#action').val('addData');
            } else {
                $('#action').val('updateOnTouchCarrier');
            }
            // live validierung Frontend
            /* $('#kundennummer').on('input', function() {checkckundennummer()});
             $('#name').on('input', function() {checkcname();});
             $('#rufnummerSc').on('input', function() {checkRufnummerSc()});
             $('#urlCc').on('input', function() {checkURLCc()} );
             $('#urlSc').on('input', function() {checkURLSc()});
             $('#auftraggsart').on('input', function() {checkauftragsart()});
            */
            // variable parametter
            let rufnummerSC = $('#rufnummerSc');
            let rufnummerSCValue = $('#rufnummerSc').val();
            let rufnummerSCError = $('#rufnummerSc_erro');
            let rufnummerCC = $('#rufnummerCc');
            let rufnummerCCValue = $('#rufnummerCc').val();
            let rufnummerCCError = $('#rufnummerCc_erro');
            if ( !checkckundennummer() && !checkcname() && !checkauftragsart()  ) {
                $('.invalid-feedback').css('display', 'block');
            }
             else if ( !checkckundennummer() || !checkcname() || !checkauftragsart() || !checkRufnummer(rufnummerSC,rufnummerSCValue,rufnummerSCError) || !checkURLCc() || !checkURLSc()
            || ! checkRufnummer(rufnummerCC,rufnummerCCValue,rufnummerCCError)){
                $('.invalid-feedback').css('display', 'block');
            }
             else {
            var formData = $(this).serialize();
            $.ajax({
                url: "ajax_action.php",
                method: "POST",
                data: formData,
                dataType:'json',
                beforeSend: function() {
                    $('#save').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                },
                success: function (data) {
                    if (data.error) {
                        console.log(data.error);

                        if (data.error.kundennummer)
                        {
                            $('#kundennummer_erro').html(data.error.kundennummer);
                            $('.invalid-feedback').css('display', 'block');
                        }

                        if (data.error.urlCc)
                        {
                            $('#urlCc_erro').html(data.error.urlCc);
                            $('#urlCc').addClass('is-invalid');

                            console.log(data.error.urlCc);
                        }

                        if (data.error.urlSc)
                        {
                            $('#urlSc_erro').html(data.error.urlSc);
                            $('#urlCc').addClass('is-invalid');
                            console.log(data.error.urlSc);
                        }

                        if (data.error.name)
                        {
                            $('#name_erro').html(data.error.name);
                            $('#name').addClass('is-invalid');
                        }


                        if (data.error.rufnummerCc)
                        {
                            $('#rufnummerCc_erro').html(data.error.rufnummerCc);

                            $('#rufnummerCc').addClass('is-invalid');
                        }

                        if (data.error.rufnummerSc)
                        {
                            $('#rufnummerSc_erro').html(data.error.rufnummerSc);
                            $('#rufnummerCc').addClass('is-invalid');
                        }


                        if (data.error.auftragsart) {
                            $('#auftragsart_error').html(data.auftragsart);
                            $('#auftragsart').addClass('is-invalid');
                        }


                            output = '<div class="error">' + data.text + '</div>';
                            $("#carrierForm  input[required=true], #carrierForm input[required=true]").val('');

                    }
                    else
                    {
                        output = '<div class="success">'+data.text+'</div>';
                        //reset values in all input fields
                        $('#carrierForm')[0].reset();
                        $('#carrierModal').modal('hide');
                        $('#save').attr('disabled', false);
                        $('#onTouchCarrier').DataTable().ajax.reload();

                        if (data.Msg)
                        {
                            $("#message").html('<div class=" alert alert-success" id="success-alert"> '+data.Msg+'</div>');
                        } else
                        {
                            $("#message").html('<div class=" alert alert-success" id="success-alert"> '+data.Update+'</div>');
                        }

                        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {$("#success-alert").slideUp(500);});
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                    console.log(error);
                    console.log(status);
                }
            });
            }
        });

        //search option custom
        /*// Call datatables, and return the API to the variable for use in our code
        // Binds datatables to all elements with a class of datatable
        var dtable = $("#onTouchCarrier").dataTable().api();

        // Grab the datatables input box and alter how it is bound to events
        $(".dataTables_filter input")
        .unbind() // Unbind previous default bindings
        .bind("input", function(e) { // Bind our desired behavior
            // If the length is 3 or more characters, or the user pressed ENTER, search
            if(this.value.length >= 3 || e.keyCode === 13) {
                // Call the API search function
                dtable.search(this.value).draw();
            }
            // Ensure we clear the search if they backspace far enough
            if(this.value === "") {
                dtable.search("").draw();
            }
            return;
        });*/
        // after 2 seconde
        var suche = null;
        $(".dataTables_filter input")
        .unbind()
        .bind("input", function() {
            // interrompt le délai et l'exécution du code associé à ce délai.
            clearTimeout(this);
            // action à exécuter et un délai avant son exécution
            suche = setTimeout(function(){
                var dtable = $("#onTouchCarrier").dataTable().api();
                var item = $(".dataTables_filter input");
                return dtable.search($(item).val()).draw();
            }, 2000);
            console.log(this);
        });

        // Moggler Modal
        $('#add').click(function () {$('#carrierModal').modal('show');});
        $('#carrierModal').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
        });

        // update scripts
        $("#onTouchCarrier ").on('click', '.edit', function(e)
        {
            e.preventDefault();
            var table = $('#onTouchCarrier').DataTable();
            var row  = $(this).parents('tr')[0];
            var rowData = table.row( row ).data();
            console.log(rowData);
            $('#kundennummer').val( rowData.kundennummer );
            $('#name').val( rowData.name );
            $('#urlSc').val( rowData.urlSc );
            $('#rufnummerCc').val( rowData.rufnummerSc );
            $('#urlCc').val( rowData.urlCc );
            $('#rufnummerCc').val( rowData.rufnummerCc );
            $('#auftragsart').val( rowData.auftragsart );
            $('#save').val('Update');
            $('.modal-title').html("<i class='fa fa-plus'></i> Editer");
            $('#action').val('updateOnTouchCarrier');
             var Id = $(this).attr("id");
             $('#id').val(rowData.DT_RowId);
        });
    });

    function checkckundennummer() {

        var kundennummer = $('#kundennummer').val();

        if ( kundennummer === '' ) {
            $('#kundennummer_erro').html('kundennunner est obligatoire et doit pas etre vide ');
            $('#kundennummer').addClass('is-invalid');
            return false;
        }
        //SABINA  SARAN  DIARRISSO

        else if ( !kundennummer.match(/^\d+$/) ) {
            //it's all digits
            $('#kundennummer_erro').html('kundennunner doit avoir des chiffres ');
            $('#kundennummer').addClass('is-invalid');

        } else if ($('#kundennummer').val().length < 4) {
            $('#kundennummer_erro').html('le numero de client doit avoir plus de 4 caractere');
            $('#kundennummer').addClass('is-invalid');
            return false;

        }
        else {
            $('#kundennummer_erro').html('');
            $('#kundennummer').removeClass('is-invalid');
            return true;
        }
    }

    function checkcname() {

        var name = $('#name').val();

        if (name === '') {
            $('#name_erro').html('name is Field is required');
            $('#name').addClass('is-invalid');
            return false;
        }

        else if ($('#name').val().length < 4)
        {
            $('#name_erro').html('nane soll große als  4');
            return false;
        }
        else
        {
            $('#name_erro').html('');
            $('#name').removeClass('is-invalid');
            return true;
        }
    }
    function checkauftragsart() {

        var regex = /^[a-zA-Z ]*$/ ; // cool
        var auftragsart = $('#auftragsart').val();


        if (auftragsart === '') {
            $('#auftragsart_error').html(' Frondend : Auftragsart est obligatoire  et doit etre des nomm pas de chiffre');
            $('#auftragsart').addClass('is-invalid');
            return false;

        } else if ( $('#auftragsart').val().length < 2)
        {
            $('#auftragsart_error').html('Frontend:  auftragsart doit au mimunum 2 ou bien plus ');
            $('#auftragsart_error').addClass('is-invalid');
            return false;
        }
        else if (!auftragsart.match(regex))
        {
            $('#auftragsart_error').html('Frontend :il ne doit pas comporter de chiffre dans cette field ');
            $('#auftragsart').addClass('is-invalid');
            return false;
        }
        else {
            $('#auftragsart_error').html('');
            $('#auftragsart').removeClass('is-invalid');
            return true;
        }
    }

    function  checkRufnummer(input, inputValue, errorMessage)
    {
        if ( inputValue !== '' && !inputValue.match(/^[0:]([0-9]{11,18})$/)) {
            errorMessage.html(' FRONTEND :nur telephone nummer');
            input.addClass('is-invalid');
            return false;
        }
        errorMessage.html('');
        input.removeClass('is-invalid');
        return true;
    }

    function  checkURLSc()
    {
        var URLSc = $('#urlSc').val();
        if ( URLSc !== '' && !URLSc.match(/((?:(?:http?)[s]*:\/\/)?[a-z0-9-%\/\&=?\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?)/gi))
        {
            $('#urlSc_erro').html('URL Sc Frontend validierung');
            $('#URLSc').addClass('is-invalid');
        }
        else {
            $('#urlSc_erro').html('');
            $('#URLSc').removeClass('is-invalid');
            return true;
        }
    }

    function  checkURLCc()
    {
        var urlCc = $('#urlCc').val();
        if ( urlCc !== '' && !urlCc.match(/((?:(?:http?)[s]*:\/\/)?[a-z0-9-%\/\&=?\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?)/gi))
        {
            $('#urlCc_erro').html(' Urlcc Frontend validierung');
            $('#urlCc').addClass('is-invalid');
        }
        else {
            $('#urlCc_erro').html('');
            $('#urlCc').removeClass('is-invalid');
            return true;
        }
    }
</script>
</body>
</html>
