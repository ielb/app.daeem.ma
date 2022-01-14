<script>
    function load_unseen_notification(view = '')
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url         :  '{{ route('notification') }}',
            type        :   'GET',
            data        :   { view: view },
            dataType    :  "json",
            success:function(data)
            {
                // alert('test');
                //$('.dropdown-menu').html(data.notification);
                var html = '';
                //alert(data.orders[10].code);
                if(data.orderCount > 0)
                {
                    for(i=0;i<data.orderCount;i++)
                    {
                        html +=
                            '<a href="/orders/' + data.notifyOrders[i].id + '" class="list-group-item list-group-item-action">' +
                            '<div class="row align-items-center">' +
                            '<div class="col-auto">' +
                            '<span class="btn badge badge-success badge-pill">#' + data.notifyOrders[i].code + '</span>' +
                            '</div>' +
                            '<div class="col ml--2">' +
                            '<div class="d-flex justify-content-between align-items-center">' +
                            '<div>' +
                            '<h4 class="mb-0 text-sm">MAD ' + data.notifyOrders[i].order_price + '</h4>' +
                            '</div>' +
                            '<div class="text-right text-muted">' +
                            '<small>' + data.notifyOrders[i].notify_order_date + '</small>' +
                            '</div>' +
                            '</div>' +
                            '<p class="text-sm mb-0">A new order from ' + data.notifyOrders[i].client.name + '.</p>' +
                            '</div>' +
                            '</div>' +
                            '</a>';
                    }

                    if(data.unseenOrders > 0)
                    {

                        $('#notification_count_bell').html('<div class="badge badge-primary badge-pill">'+data.unseenOrders+'</div>');
                        blinkTitle({
                            title: 'Head\'s Up', //optional
                            message: '('+data.unseenOrders+') Newly order(s)!',
                            delay: 1200
                        });
                        // $('#notification_count').html('You have <strong class="text-primary">'+data.unseenOrders+'</strong> unseen notification.');
                    }

                }
                else
                {
                    html    +=
                        '<div class="text-center" >' +
                        '<i class="fas fa-mug-hot"></i> There is no notification yet!' +
                        '<div class="text-sm">Check another time.</div>' +
                        '</div>';
                }

                $('#notification_list').html(html);
            }
        });
    }

    load_unseen_notification();

    $("#notify_btn").click(function() {
        load_unseen_notification('yes');
        blinkTitleStop();
        $('#notification_count_bell').html('');
    });

    setInterval(() => {
        load_unseen_notification();
    }, 5000);

    $('#slimscroll').slimScroll({
        height: '350px',
        color: '#5E72E4',
        opacity: 1,
    });

    var hold

    function blinkTitle (opts) {
        if (!opts) opts = {}
        var delay = opts.delay || 0
        var message = opts.message || ''
        var notifyOffPage = opts.notifyOffPage || false
        var timeout = opts.timeout || false
        var title = opts.title || document.title

        if (notifyOffPage) {
            hold = setInterval(function () {
                if (document.hidden) blink()
            }, delay)
        } else {
            hold = setInterval(function () {
                blink()
            }, delay)
        }

        function blink () {
            document.title === title ?
                document.title = message :
                document.title = title
        }

        if (timeout) setTimeout(blinkTitleStop, timeout)

    }

    function blinkTitleStop () {
        clearInterval(hold)
    }


    $("#working_status").click(function() {
        let data = $("#working_status").val();
    });

    // CREATE
    $('body').delegate('#working_status', 'click', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).attr('worker-id');
        var formData = {
            data: $('#working_status').val(),
        };
        var type = "PUT";
        var url = '/driver/working/'+id;

        let text;
        if($('#working_status').val() == 1)
        {
            text = 'offline';
        }
        else {
            text = 'online';

        }
        Swal.fire({
            title: 'Do you want to go ' + text + '?',
            showDenyButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
            allowOutsideClick: false
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: type,
                    url: url,
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        location.reload()
                    },
                });
                Swal.fire('Saved!', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
                location.reload()
            }
        })


    });


</script>
@if (auth()->user()->role == "driver" && auth()->user()->working == 1)
    
<script>

function getDriverLocation(){
  
      if(navigator.geolocation){
     navigator.geolocation.getCurrentPosition(function(position)
    { 
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude,
        };
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : '{{ route('driverLocation') }}',
            type : 'POST',
            data : {
            lat: pos.lat,
            lng: pos.lng,
             },
            dataType : "json",
            success:function(data)
            {
              
            }
        });
    });
}
}
window.onload = function () {
    setInterval(getDriverLocation,1000)
 }


</script>
@endif