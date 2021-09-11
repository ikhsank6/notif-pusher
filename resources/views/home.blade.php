<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
  <div class="row">
    <div class="col-sm-12">
      <div class="col-sm-6">
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Notifikasi <span class="badge badge-pill badge-light countNotif">2</span>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Helo World 2</a>
          <a class="dropdown-item" href="#">Hello World 1</a>
        </div>
      </div>
      </div>
    </div>
  </div>
</body>
  <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
  
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('{{ config('test.pusher_key')}}', {
      cluster: '{{config('test.pusher_cluster')}}'
    });

    var channel = pusher.subscribe('{{config('test.channel')}}');
    channel.bind('App\\Events\\NotifPusherEvent', function(data) {
      //alert(JSON.stringify(data));
      var existing = $('.dropdown .dropdown-menu').html();
      var ncount = $('.dropdown .countNotif').html();
      var notifcount = parseInt(ncount);
      var html='';
      if(data){
        
        html +=' <a class="dropdown-item" href="#">'+data.message+'</a>';

        notifcount +=1;
        $('.dropdown .countNotif').text(notifcount);
        var newNotifHtml = html + existing;
        $('.dropdown .dropdown-menu').html(newNotifHtml);
      }
      
    });
  </script>