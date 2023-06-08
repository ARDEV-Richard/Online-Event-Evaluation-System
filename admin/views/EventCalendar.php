<?php include'../include/header.php';?>
<?php include'../include/topbar.php';?>
<?php include'../include/sidebar.php';?>
<?php include'../controller/dashboard.php';?>
<?php include'../include/session alert.php';?>
<main role="main" class="main-content">
  <div class="container-fluid"> <h3 class="row no-gutters bg-success text-white" style="padding: 30px; border-radius: 10px;">
          Event Calendar
        </h3>
    <div class="row">
      <div class="col-md-4">
        <div class="row d-flex flex-wrap">
          <div class="col-sm-12 card">
            <div class="card-header">
              <b>Event List</b>
            </div>
            
            <div id="eventList"></div>
          </div>
        </div>
      </div>
      <div class="col-md-8 card"> 
      <div class="card-header">
            <b>Event Calendar</b>
            </div>
            
            <div id="event_calendar"></div>
      </div>
    </div>
  </div>
</main>

<?php include'../include/footer.php';?>
<script>$(document).ready(function() {
    function loadEventList() {
        $.ajax({
            url: '../model/FetchEventList.php',
            type: 'GET',
            success: function(response) {
                $('#eventList').html(response);
                // Add a click event to each event
                $('.event-item').click(function() {
                    var eventId = $(this).attr('id');
                    alert('Clicked on event with ID ' + eventId);
                    // You can add more code here to perform additional actions
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    loadEventList(); setInterval(function() {
        loadEventList();
    }, 1000);
});

$(document).ready(function() {
  var calendar = $('#event_calendar').fullCalendar({
    editable: true,
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    events: '../model/FetchEvent.php',
    selectable: true,
    selectHelper: true,
    select: function(start, end, allDay) {
  var title = prompt("Create Event Name");
  if (title) {
    var start_datetime = moment(start.format("YYYY-MM-DD"));
    var end_datetime = moment(end.format("YYYY-MM-DD"));
    var today = moment().startOf('day'); // get today's date without time

    if (start_datetime.isBefore(today)) { // check if start date is before today
      alert("You can't book an event in the past.");
    } else if (end_datetime.isBefore(start_datetime)) { // check if end date is before start date
      alert("The event end date can't be before the start date.");
    } else {
      $.ajax({
        url: "../model/FetchEvent.php", // create a new PHP file to check if date already exists
        type: "POST",
        data: {
          start: start_datetime.format("YYYY-MM-DD HH:mm:ss"),
          end: end_datetime.format("YYYY-MM-DD HH:mm:ss")
        },
        success: function(response) {
          if (response == "exists") {
            alert("The selected date range already has an event booked.");
          } else {
            $.ajax({
              url: "../model/AddEvent.php",
              type: "POST",
              data: {
                title: title,
                start: start_datetime.format("YYYY-MM-DD HH:mm:ss"),
                end: end_datetime.format("YYYY-MM-DD HH:mm:ss")
              },
              success: function() {
                calendar.fullCalendar('refetchEvents');
                alert("Event Booked Successfully");
              }
            })
          }
        }
      })
    }
  }
},

    editable: true,
    eventResize: function(event) {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url: "../model/UpdateEvent.php",
        type: "POST",
        data: {
          title: title,
          start: start,
          end: end,
          id: id
        },
        success: function() {
          calendar.fullCalendar('refetchEvents');
          alert('Event Updated Successfully');
        }
      })
    },

    eventDrop: function(event) {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url: "../model/UpdateEvent.php",
        type: "POST",
        data: {
          title: title,
          start: start,
          end: end,
          id: id
        },
        success: function() {
          calendar.fullCalendar('refetchEvents');
          alert("Event Updated Successfully");
        }
      });
    },

    eventClick: function(event) {
      if (confirm("Are you sure you want to cancel the event?")) {
        var id = event.id;
        $.ajax({
          url: "../model/DeleteEvent.php",
          type: "POST",
          data: {
            id: id
          },
          success: function() {
            calendar.fullCalendar('refetchEvents');
            alert("Event Removed Successfully");
          }
        })
      }
    },

  });
});

</script>