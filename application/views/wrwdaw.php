<head>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="au theme template">
  <meta name="author" content="Hau Nguyen">
  <meta name="keywords" content="au theme template">

  <!-- Title Page-->

  <!-- start style socket from here -->

  <!-- <link rel="stylesheet" href="<?= base_url() ?>/assets/new/bootstrap/dist/css/bootstrap.min.css"> -->
  <!-- Font Awesome -->
  <!--  <link rel="stylesheet" href="<?= base_url() ?>/assets/new/font-awesome/css/font-awesome.min.css"> -->
  <!-- Ionicons -->
  <!--  <link rel="stylesheet" href="<?= base_url() ?>/assets/new/Ionicons/css/ionicons.min.css"> -->
  <!-- DataTables -->
  <!--   <link rel="stylesheet" href="<?= base_url() ?>/assets/new/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/new/toastr/build/toastr.min.css">
  <!-- Theme style -->
  <!--   <link rel="stylesheet" href="<?= base_url() ?>/assets/new/adminlte/css/AdminLTE.min.css">  -->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->

     
     <!-- datatable script -->
     <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"> </script>
     <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"> </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>

     
     <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">


     <!-- datatable script end -->
     






     <!-- style socket ended here -->

     <!-- Fontfaces CSS-->
     <link href="<?php echo base_url('assets/back/')?>css/font-face.css" rel="stylesheet" media="all">
     <link href="<?php echo base_url('assets/back/')?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
     <link href="<?php echo base_url('assets/back/')?>vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
     <link href="<?php echo base_url('assets/back/')?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

     <!-- Bootstrap CSS-->
     <link href="<?php echo base_url('assets/back/')?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

     <!-- Vendor CSS-->
     <link href="<?php echo base_url('assets/back/')?>vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
     <link href="<?php echo base_url('assets/back/')?>vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
     <link href="<?php echo base_url('assets/back/')?>vendor/wow/animate.css" rel="stylesheet" media="all">
     <link href="<?php echo base_url('assets/back/')?>vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
     <link href="<?php echo base_url('assets/back/')?>vendor/slick/slick.css" rel="stylesheet" media="all">
     <link href="<?php echo base_url('assets/back/')?>vendor/select2/select2.min.css" rel="stylesheet" media="all">
     <link href="<?php echo base_url('assets/back/')?>vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

     <!-- Main CSS-->
     <link href="<?php echo base_url('assets/back/')?>css/theme.css" rel="stylesheet" media="all">

     <link rel="stylesheet" href="<?php echo base_url('assets/back/jquery-ui/jquery-ui.min.css'); ?>" /> <!-- Load file css jquery-ui -->
     <script src="<?php echo base_url('assets/back/jquery.min.js'); ?>"></script> <!-- Load file jquery -->

     <link href='<?php echo base_url('assets/back/')?>vendor/fullcalendar-3.10.0/fullcalendar.css' rel='stylesheet' media="all" />
     <script src="<?php echo base_url('assets/back/')?>vendor/fullcalendar-3.10.0/lib/moment.min.js"></script>
     <script src="<?php echo base_url('assets/back/')?>vendor/fullcalendar-3.10.0/fullcalendar.js"></script>
     <script>
      $(document).ready(function(){
        var calendar = $('#calendar').fullCalendar({
          editable:true,
          header:{

            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
          },
          events:"<?php echo base_url(); ?>admin/fullcalendar/load",
          selectable:true,
          selectHelper:true,
          select:function(start, end, allDay)
          {
            var title = prompt("Tambahkan Judul Event");
            if(title)
            {
              var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
              var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
              $.ajax({
                url:"<?php echo base_url(); ?>admin/fullcalendar/insert",
                type:"POST",
                data:{title:title, start:start, end:end},
                success:function()
                {
                  calendar.fullCalendar('refetchEvents');
                  alert("Event Berhasil Ditambahkan");
                }
              })
            }
          },
          editable:true,
          eventResize:function(event)
          {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

            var title = event.title;

            var id = event.id;

            $.ajax({
              url:"<?php echo base_url(); ?>admin/fullcalendar/update",
              type:"POST",
              data:{title:title, start:start, end:end, id:id},
              success:function()
              {
                calendar.fullCalendar('refetchEvents');
                alert("Ubah Event");
              }
            })
          },
          eventDrop:function(event)
          {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                //alert(start);
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                //alert(end);
                var title = event.title;
                var id = event.id;
                $.ajax({
                  url:"<?php echo base_url(); ?>admin/fullcalendar/update",
                  type:"POST",
                  data:{title:title, start:start, end:end, id:id},
                  success:function()
                  {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Diubah");
                  }
                })
              },
              eventClick:function(event)
              {
                if(confirm("yakin ingin menghapus event ini?"))
                {
                  var id = event.id;
                  $.ajax({
                    url:"<?php echo base_url(); ?>admin/fullcalendar/delete",
                    type:"POST",
                    data:{id:id},
                    success:function()
                    {
                      calendar.fullCalendar('refetchEvents');
                      alert('Event Terhapus');
                    }
                  })
                }
              }
            });
      });

    </script>





    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <style type="text/css">
      .txtedit{
        display: none;
        width: 98%;
      }

      .fc-event, .fc-event:hover {
        color: #fff !important;
        text-decoration: none;
      }


      /*remove search datatable start*/
      .dataTables_filter {
       display: none;
     }
     
     /*remove search datatable end*/

   </style>


   <style type="text/css">

    .canvaschart {

      width: 100%;
      height: auto;
    }

  </style>

</head>
