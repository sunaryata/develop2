


<script>
    $(document).ready(function() {


        
        $.fn.dataTable.ext.search.push( function(oSettings, aData, iDataIndex) { var dateIni = $('#min').val(); var dateFin = $('#max').val(); var indexCol = 2; dateIni = dateIni.replace(/-/g, ""); dateFin= dateFin.replace(/-/g, ""); var dateCol = aData[indexCol].replace(/-/g, ""); if (dateIni === "" && dateFin === "") { return true; } if(dateIni === "") { return dateCol <= dateFin; } if(dateFin === "") { return dateCol >= dateIni; } return dateCol >= dateIni && dateCol <= dateFin; } );


        var table = $('#pegawai').DataTable( {
            initComplete: function() {
            $('#pegawai_paginate').appendTo($('#haha'))//memindahkan info ke tag outside
        },


        
        "language": {
            "info": "Tampilkan _START_ ke _END_ dari _TOTAL_ data",
            "paginate": {
                "previous": "Sebelumnya",
                "next": "Selanjutnya",
            }

        },
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
        $('#min,#max').keyup( function() { table.draw(); });



        table.buttons().container()
        .appendTo( '#pegawai_wrapper .col-md-6:eq(0)' );
    } );
</script>


<script>



   $(function () {
    let ipAddress = "<?= $ip ?>";

    if (ipAddress == "::1") {
        ipAddress = "localhost"
    }

    const port = "3000";
    const socketIoAddress = `http://${ipAddress}:${port}`;
    const socket = io(socketIoAddress);

    const pegawaiTable = $('#pegawai').DataTable();

    var pegawaiID = $(this).data('id');

    const reloadTable = function () {
        $.ajax({
            url: "<?= base_url('pegawai/list_pegawai') ?>",
            method: "GET",
            dataType: "json",
            async: false,
            success: function (data) {
                console.log(data);
                const pegawai = data.data;

                if (pegawai.length != 0) {

                    pegawaiTable.clear();
                    for (let x of pegawai) {
                        if (x.status=='1'){statusku='<a href="javascript:void(0);" class="btn btn-sm btn-primary ubah_status" data-id="'+ x.id +'" data-status="'+ x.status +'">Dibayar</a>'} 
                        if (x.status=='0'){statusku='<a href="javascript:void(0);" class="btn btn-sm btn-warning ubah_status" data-id="'+ x.id +'" data-status="'+ x.status +'">Belum Dibayar</a>'}
                        pegawaiTable.row.add([
                            x.name,
                            statusku,
                            x.created_at,

                            '<a href="javascript:void(0);" class="btn btn-sm btn-danger fa fa-trash item_delete" data-id="'+ x.id +'"></a>',

                            ]).draw(false);
                        $('#pegawai_id').val(x.id);
                    }

                }
                else
                {
                    console.log('0');
                    pegawaiTable.clear().draw();
                }
            },
        });
    }



    reloadTable();

    $("#add_pegawai").click(function () {
        const pegawaiName = $("#pegawai_name");
        const pegawaiStatus = $("#pegawai_status");
        if (pegawaiName != null && pegawaiName != "") {
            $.ajax({
                url: "<?= base_url('pegawai/add_pegawai') ?>",
                method: "POST",
                async: false,
                data: JSON.stringify({
                    pegawai_name: pegawaiName.val(),
                    pegawai_status: pegawaiStatus.val(),
                }),
                type: "application/json",
                success: function (data) {
                    socket.emit('reload-table');
                    reloadTable();
                    toastr.success(data.message, 'Adding New Pegawai');
                }
            });
        }
        pegawaiName.empty();
    });

  //// delete start

  $('#pegawai').on('click','.item_delete',function(){
    var id = $(this).data('id');
    $('#ModalDelete').modal('show');
    $('.id').val(id);
});


  var table = $('#pegawai').DataTable();

  $('#_10').on( 'click', function () {
    table.page.len( 2 ).draw();
    console.log('10 jadi');
} );

  $('#_20').on( 'click', function () {
    table.page.len( 3 ).draw();
    console.log("20 jadi");
} );






  $('.btn-delete').on('click',function(){
    var id = $('.id').val();
    $.ajax({
        url: "<?= base_url('pegawai/delete') ?>",
        method : 'POST',
        data   : {id: id},
        success: function(data){
            $('#ModalDelete').modal('hide');
            $('.id').val("");
            reloadTable();
            socket.emit('reload-table');
            toastr.warning(data.message, 'Pegawai Deleted');
        }
    });
});

  //// delete end

                //// change status start


                $('#pegawai').on('click','.ubah_status',function(){
                    var id = $(this).data('id');
                    var status = $(this).data('status');

                    $('#ModalStatus').modal('show');
                    $('.id').val(id);
                    $('.status').val(status);

                });


                $('.btn-status').on('click',function(){
                    var id = $('.id').val();
                    var status = $('.status').val();
                    $.ajax({
                        url: "<?= base_url('pegawai/ubah_status') ?>",
                        method : 'POST',
                        data   :
                        {
                            id: id,
                            status :status,
                        },
                        success: function(data){
                            $('#ModalStatus').modal('hide');
                            $('.id').val("");
                            socket.emit('reload-table');
                            reloadTable();
                            toastr.success(data.message, 'Pegawai Ubah');
                        }
                    });
                });
//// change status end






                // $('.btn-delete').on('click',function(){
                //     var id = $('.id').val();
                //     $.ajax({
                //         url    : '<?php echo site_url("pegawai/delete");?>',
                //         method : 'POST',
                //         data   : {id: id},

                //         success: function(data){
                //             $('#ModalDelete').modal('hide');
                //             $('.id').val("");
                //             socket.emit('reload-table');
                //             reloadTable();
                //             toastr.warning(data.message, 'Pegawai Deleted');
                //         }
                //     });
                // });


                
                socket.on('reload', () => {
                    toastr.info('Other User changed Pegawai', 'Reload');
                    reloadTable();
                });
            })
        </script>