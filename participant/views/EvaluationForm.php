<?php include'../include/header.php';?>
<?php include'../include/topbar.php';?>
<?php include'../include/sidebar.php';?>
<?php include'../controller/dashboard.php';?>
<?php include'../include/session alert.php';?>
<main role="main" class="main-content">
  <div class="container-fluid"> <h3 class="row no-gutters bg-success text-white" style="padding: 30px; border-radius: 10px;">
  Event Evaluation Form
        </h3>
    <div class="row">
      <div class="col-md-4">
        <div class="row d-flex flex-wrap">
          <div class="col-sm-12 card">
            <div class="card-header">
            Event List
            </div>
            <div class="card">
            <div class="card-body">
              <form action="../model/SearchEvent.php" method="get" class="mb-3">
                <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="Search events">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                  </div>
                </div>
              </form>
                 <div id="eventList"></div>
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 card"> 
      <div class="card-header">
        Event Calendar
     </div>
     <br>
        <div id="event_calendar"></div><br>
      </div>
    </div>
  </div>
</main>
<?php include'../include/footer.php';?>
<script>
  
// In your JavaScript code
$(document).ready(function() {
  function loadEventList(searchTerm) {
    $.ajax({
      url: '../model/SearchEvent.php',
      type: 'GET',
      data: {
        q: searchTerm
      },
      success: function(response) {
        $('#eventList').html(response);
        // Add a click event to each event
        $('.event-link').click(function() {
          var eventId = $(this).data('id');
          // You can add more code here to perform additional actions
        });
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  }

  // Load the initial list of events
  loadEventList('');

  // Handle the search form submission
  $('form').submit(function(event) {
    event.preventDefault();
    var searchTerm = $('input[name="q"]').val();
    loadEventList(searchTerm);
  });
});
</script>
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
      $.ajax({
        url: "../model/FetchEvent.php", // create a new PHP file to check if date already exists
        type: "POST",
        data: {
          start: start_datetime.format("YYYY-MM-DD HH:mm:ss"),
          end: end_datetime.format("YYYY-MM-DD HH:mm:ss")
        },        
      })
    }
  });
});


</script>