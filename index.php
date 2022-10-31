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


    <table  name="tableliste" id="onTouchCarrier" class="table table-bordered table-striped" style="width: 600px!important;">
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
    <form action='<?php echo strtok($_SERVER['REQUEST_URI']);?>phpspreadsheet/export' class='excel-upl' id='excel-upl'
          enctype='multipart/form-data' method='post' accept-charset='utf-8'>
        <div class='row padall'>
            <div class='col-lg-12'>
                <div class='float-right'>
                   <!-- <input type='radio' checked='checked' name='export_type' value='xlsx'> .xlsx
                    <input type='radio' name='export_type' value='xls'> .xls
                    <input type='radio' name='export_type' value='csv'> .csv-->
                    <button type='submit' name='import' class='btn btn-primary'>Export</button>
                </div>
            </div>
        </div>
    </form>
    <!--<div class='btn'>
        <form action='' method='POST'>
            <a href="<?php /*echo strtok($_SERVER['REQUEST_URI']); */?>
            <?php
/*            if(isset($_SERVER['QUERY_STRING'])){
           parse_str($_SERVER['QUERY_STRING'], $args);
          } else {
         $args = array();
            } */?>?action=export" target="_blank">
                <button type='button' id='btnExport' name='action' value='Export to Excel' class='btn btn-info'>Export
                    to Excel
                </button>
            </a>
        </form>
    </div>-->
</div>
<div name="modalForms"  id="carrierModal" class="modal fade"  tabindex="-1" role="dialog" >
    <div class="modal-dialog">
        <form method="post" id="carrierForm">
            <div class="modal-content">
                <div class="modal-header">
                    <span id="message"></span>
                    <button name="closeModal" type="button" class="close" >&times;</button>
                    <!--<button name="closeModal" type="button" class="close" data-dismiss="modal">&times;</button>-->
                    <h4  name="modaltitle" class="modal-title"><i class="fa fa-plus"></i>Edit User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group"
                    <label name="kunndenn" for="kundennummer" class="control-label">Kundennummer</label>
                    <input type="text" class="form-control" id="kundennummer" name="kundennummer" placeholder="kundennummer" >
                    <span class="invalid-feedback" id="kundennummer_error"> </span>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="name" >
                    <span class="invalid-feedback" id="name_error"> </span>
                </div>
                <div class="form-group">
                    <label for="urlSc" class="control-label">UrlSc</label>
                    <input type="text" class="form-control"  id="urlSc" name="urlSc" placeholder="urlSc" >
                    <span class="invalid-feedback" id="urlSc_error"> </span>
                </div>
                <div class="form-group">
                    <label for="rufnummerSc" class="control-label">RufnummerSc</label>
                    <input type="tel" class="form-control"  id="rufnummerSc" name="rufnummerSc">
                    <span class="invalid-feedback" id="rufnummerSc_error"> </span>
                </div>
                <div class="form-group">
                    <label for="urlCc" class="control-label">UrlCc</label>
                    <input type="text" class="form-control" id="urlCc" name="urlCc" placeholder="urlCc">
                    <span class="invalid-feedback" id="urlCc_error"> </span>
                </div>
                <div class="form-group">
                    <label for="$rufnummerCc" class="control-label">RufnummerCc</label>
                     <input type="tel" class="form-control" id="rufnummerCc" name="rufnummerCc" placeholder="rufnummerCc">
                     <span class="invalid-feedback" id="rufnummerCc_error"> </span>
                </div>

                        <select name='auftragsart'id="auftragsart" class='form-group'>
                            <label for="auftragsart" class='control-label'>auftragsart</label>
                            <option> Problem</option>
                            <option >Beauftrags</option>
                        </select>





                <!--div class="form-group">
                    <label for="auftragsart" class="control-label">Auftragsart</label>
                    <input type="text" class="form-control" id="auftragsart" name="auftragsart" placeholder="auftragsart">
                    <span class="invalid-feedback" id="auftragsart_error"> </span>
                </div>-->
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
            /*"processing": true,
            "serverSide": true,*/
            "paging":true,
            responsive: true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'order': [],
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
                        return '<div class="btn-group"> ' +
                            '<button  type="button" name="edit" class="btn btn-primary edit mx-2" id="' + data.id +'" data-toggle="modal" data-target="#carrierModa" title="Edit">' + '<i class="fa fa-edit" style="font-size:24px"></i>' + '</button>'+
                            '<button  type="button" name="delete" class="btn btn-primary delete" id="' + data['DT_RowId'] +'" data-toggle="modal" data-target="#carrierModa" title="Delete">' + '<i class="fa fa-trash" style="font-size:24px"></i>' + '</button>'+
                           '</div>'
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


            // variable parametter
            let rufnummerSC = $('#rufnummerSc');
            let rufnummerSCValue = $('#rufnummerSc').val();
            let rufnummerSCError = $('#rufnummerSc_error');
            let rufnummerCC = $('#rufnummerCc');
            let rufnummerCCValue = $('#rufnummerCc').val();
            let rufnummerCCError = $('#rufnummerCc_error');
            let urlCC = $('#urlCc');
            let urlCCValue = $('#urlCc').val();
            let urlCcError = $('#urlCc_error');
            let urlSC = $('#urlSc');
            let urlSCValue = $('#urlSc').val();
            let urlScError = $('#urlSc_error');
            let inputrufCc = 'rufnummerCc';
            let inputrufSc = 'rufnummerSc';
            let inputUrlCc = 'UrlCc';
            let inputUrlSc = 'UrlSc';


            /*$('#kundennummer').on('keyup', function() {

                checkckundennummer();
            });
            $('#name').on('keyup', function() {
                checkcname();
            });
            $('#rufnummerSc').on('keyup', function(){
                checkRufnummer( rufnummerSC,rufnummerSCValue,rufnummerSCError,inputrufSc );
            });
            $('#rufnummerCc').on('keyup', function() {
                checkRufnummer( rufnummerCC,rufnummerCCValue,rufnummerCCError,inputrufCc );
            });
            $('#urlCc').on('keyup', function() {
                checkURL( urlCC,urlCCValue,urlCcError);
            });
            $('#urlSc').on('keyup', function() {
                checkURL( urlSC,urlSCValue,urlScError );
            });
            $('#auftraggsart').on('keyup', function(){
                checkauftragsart();
            });

            $('#name').on('keypress', function(key) {
                if((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode !== 45)) {
                    checkcname();
                }
            });
            $('#auftraggsart').on('keypress', function(key) {
                if(key.charCode < 48 || key.charCode > 57) {
                    checkauftragsart();
                }
            });*/

        /*    if ( !checkckundennummer() && !checkcname() && !checkauftragsart() )
            {
                $('.invalid-feedback').css('display', 'block');
            }*/


            if ( !checkckundennummer() || !checkcname() || !checkauftragsart() ||
                !checkURL( urlSC,urlSCValue,urlScError) ||
                !checkRufnummer(rufnummerSC,rufnummerSCValue,rufnummerSCError,inputrufSc )
                || !checkRufnummer(rufnummerSC,rufnummerSCValue,rufnummerSCError,inputrufSc ) ||
                !checkURL( urlCC,urlCCValue,urlCcError ) )
            {
           if ( !checkckundennummer()  )
           {

               $('.invalid-feedback').addClass('d-block');
           }

            if ( !checkcname()  )
            {
                $('.invalid-feedback').addClass('d-block');
            }

            if ( !checkauftragsart() )
            {
                $('.invalid-feedback').addClass('d-block');
            }

           if ( !checkURL( urlSC,urlSCValue,urlScError) )
           {
               $('.invalid-feedback').addClass('d-block');
           }
           if ( !checkRufnummer(rufnummerSC,rufnummerSCValue,rufnummerSCError,inputrufSc  ))
           {
               $('.invalid-feedback').addClass('d-block');
           }
            if (!checkURL( urlCC,urlCCValue,urlCcError ) )
           {
               $('.invalid-feedback').addClass('d-block');
           }
           if ( !checkRufnummer( rufnummerCC,rufnummerCCValue,rufnummerCCError,inputrufCc ))
           {
               $('.invalid-feedback').addClass('d-block');
           }

            if ( !checkauftragsart() )
            {
                $('.invalid-feedback').addClass('d-block');
            }
        }else
           {
               //$('.invalid-feedback').css('display', 'block');
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
                            $('#kundennummer_error').html(data.error.kundennummer);
                            $('#kundennummer').addClass('is-invalid');
                        }

                        if (data.error.urlCc)
                        {
                            $('#urlCc_error').html(data.error.urlCc);
                            $('#urlCc').addClass('is-invalid');

                        }

                        if (data.error.urlSc)
                        {
                            $('#urlSc_error').html(data.error.urlSc);
                            $('#urlSc').addClass('is-invalid');

                        }

                        if (data.error.name)
                        {
                            $('#name_error').html(data.error.name);
                            $('#name').addClass('is-invalid');
                        }


                        if (data.error.rufnummerCc)
                        {
                            $('#rufnummerCc_error').html(data.error.rufnummerCc);

                            $('#rufnummerCc').addClass('is-invalid');
                        }

                        if (data.error.rufnummerSC)
                        {
                            $('#rufnummerSc_error').html(data.error.rufnummerSC);
                            $('#rufnummerSc').addClass('is-invalid');
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

        // Moggler Modal and reset error class and message error
        $('#add').click(function () {$('#carrierModal').modal('show');});
        $('#carrierModal').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
            $(this).find('form').trigger('reset');
            $(this).find('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').html('').hide();

        });

        // update scripts
        /*$("#onTouchCarrier ").on('click', '.edit', function(e)
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
        });*/

        const employee = {
            modaltitle: 'massinga',
            inputsubmit: 'James',
            templete: 'Spy'
        };
        const myFoods = {a: 'masingacite', b: 'toit', c: 'carrot', d: 'donut'}
        // ranger Adimistration telekom
        let maindiv = $('#onTouchCarrier_wrapper');
         maindiv.on('click','button[name=edit]' ,function () {
             rendermodal(myFoods);
             rendershowmodal();
             inputwithValue();

         });


         //Delete Aktion  row

        $('#onTouchCarrier ').on('click', '.delete', function () {
            var $ele = $(this).parent().parent();
            var table = $('#onTouchCarrier').DataTable();
            var row  = $(this).parents('tr')[0];
            var rowData = table.row( row ).data();
            console.log($ele);
            $.ajax({
                url: 'delete_ajax.php',
                type: 'POST',
                cache: false,
                data: {
                    id: $(this).attr('id')
                },
                success: function (data) {
                    console.log(data);
                    var dataResult = JSON.parse(data);
                    if (dataResult.statusCode === 200) {
                       // row.fadeOut().remove();
                        $('#onTouchCarrier').DataTable().ajax.reload();
                    }
                }
            });
        });




    });


function rendershowmodal() {
    $('#carrierModal').modal('show');
    $('#carrierModal').on('click','button[name=closeModal]' ,function () {
        $('#carrierModal').modal('hide');
        console.log('close');
    });
}


function rendermodal({a:modaltitle,b:inputsubmit, c:templete}) {
    let maindiv = $('#carrierModal');
    console.log(modaltitle);
    console.log(inputsubmit);
    console.log(templete);
    maindiv.find('[name=kunndenn]').html(inputsubmit);
    maindiv.find('input[name=save]').append(templete);

}





    function inputwithValue ()
{
    var table = $('#onTouchCarrier').DataTable();
    var row  = $(this).parents('tr')[0];
    var rowData = table.row( row ).data();
    var modalFormId = $('#carrierModal');
    modalFormId.find('input[name=kundennummer]').val( rowData.kundennummer );
    modalFormId.find("input[name='name']").val(rowData.name);
    modalFormId.find("input[name='urlSc']").val(rowData.urlSc);
    modalFormId.find("input[name='rufnummerCc']").val(rowData.rufnummerCc);
    modalFormId.find("input[name='urlCc']").val(rowData.urlCc);
    modalFormId.find("input[name='rufnummerCc']").val(rowData.rufnummerCc);
    modalFormId.find("input[name='auftragsart']").val(rowData.auftragsart);
}
    function checkckundennummer() {

        var kundennummer = $('#kundennummer').val();

        if ( kundennummer === '' ) {
            $('#kundennummer_error').html('kundennunner est obligatoire et doit pas etre vide ');
            $('#kundennummer').addClass('is-invalid');
            return false;
        }
        //SABINA  SARAN  DIARRISSO

        else if ( !kundennummer.match(/^\d+$/) ) {
            //it's all digits
            $('#kundennummer_error').html('kundennunner doit avoir des chiffres ');
            $('#kundennummer').addClass('is-invalid');

        } else if ($('#kundennummer').val().length !== 10) {
            $('#kundennummer_error').html('le Numero de Cient doit etre de 10 Chiffres');
            $('#kundennummer').addClass('is-invalid');
            return false;

        }
        else {
            $('#kundennummer_error').html('');
            $('#kundennummer').removeClass('is-invalid');
            return true;
        }
    }

    function checkcname() {

        var name = $('#name').val();

        if (name === '') {
            $('#name_error').html('name is Field is required');
            $('#name').addClass('is-invalid');
            return false;
        }

        else if ($('#name').val().length < 4)
        {
            $('#name_error').html('nane soll große als  4');
            return false;
        }
        else
        {
            $('#name_error').html('');
            $('#name').removeClass('is-invalid');
            return true;
        }
    }
    function checkauftragsart() {

        var regex = /^[a-zA-Z ]*$/ ; // cool
        var auftragsart = $('#auftragsart').val();


        if ( auftragsart === '' ) {
            $('#auftragsart_error').html(' Frondend : Auftragsart est obligatoire  et doit etre des nomm pas de chiffre');
            $('#auftragsart').addClass('is-invalid');
            return false;

        }
        else if ( $('#auftragsart').val().length < 2)
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

    function  checkRufnummer(input, inputValue, errorMessage, inputId)
    {
        if ( inputValue !== '' && !inputValue.match(/^[0:]([0-9]{11,18})$/)) {
            errorMessage.html(' FRONTEND :le '+inputId+' de Telephone pas valide');
            input.addClass('is-invalid');
            return false;
        }
        errorMessage.html('');
        input.removeClass('is-invalid');
        return true;
    }

    function checkURL(input,inputValue,errorMessage)
    {
        if ( inputValue !== '' && !inputValue.match(/^https?:\/\/\w+(\.\w+)*(:[0-9]+)?(\/.*)?$/))
        //if ( inputValue !== '' && inputValue.match(/^https?:\/\/\w+(\.\w+)*(:[0-9]+)?(\/.*)?$/)
            //&& inputValue.match(/((?:(?:http?)[s]*:\/\/)?[a-z0-9-%\/\&=?\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?)/) )
        {
            errorMessage.html('Frontend: URL ist nicht valide');
            input.addClass('is-invalid');
            return false;
        }
        errorMessage.html('');
        input.removeClass('is-invalid');
        return true;

    }

</script>
</body>
</html>
