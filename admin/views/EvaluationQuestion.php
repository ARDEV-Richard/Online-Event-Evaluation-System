<?php include'../include/header.php';?>
<?php include'../include/topbar.php';?>
<?php include'../include/sidebar.php';?>
<?php include'../controller/dashboard.php';?>
<?php include'../include/session alert.php';?>
<main role="main" class="main-content">
  <div class="container-fluid"> <h3 class="row no-gutters bg-success text-white" style="padding: 30px; border-radius: 10px;">
          Make Evaluation Question for "<?php echo $_GET['title']; ?>"
        </h3>
              <a href="EventCalendar.php" type="button" class="btn mb-2 btn-light">Back</a>
    <div class="row">
      <div class="col-md-12 card"><br> 
             <form method="post" action="../model/AddQuestion.php">
             <input type="hidden" class="form-control" name="EventListID" value="<?php echo $_GET['EventListID']; ?>">
              <div id="questions-container">
                <div class="form-group question">
                  <label for="question-1">Question 1:</label>
                  <textarea class="form-control" id="question-1" name="question[]" rows="5" required></textarea>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="questionnaireType[]" id="multipleChoice 1" value="multiple_choice">
                    <label class="form-check-label" for="multipleChoice">Multiple Choice</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="questionnaireType[]" id="openEnded 2" value="open_ended" checked>
                    <label class="form-check-label" for="openEnded">Open Ended</label>
                  </div>
                  <br><br>
                  <label for="choices-1" id="choices-label" style="display:none;">Choices:</label>
                  <div id="choices-container" style="display:none;">
                    <div class="form-group">
                      <input type="text" class="form-control" name="multipleChoice[0][]" placeholder="A.">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="multipleChoice[0][]" placeholder="B.">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="multipleChoice[0][]"  placeholder="C.">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="multipleChoice[0][]" placeholder="D.">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="multipleChoice[0][]" placeholder="E.">
                    </div>
                  </div>
                </div>
              </div>
              <button type="button" class="btn mb-2 btn-outline-primary" id="add-question">Add Question</button>
              <button type="submit" class="btn mb-2 btn-outline-primary" id="save">Save</button>
            </form>
      </div>
  </div>
</main>

<?php include'../include/footer.php';?>
<script>
const multipleChoice = document.getElementById('multipleChoice 1');
const openEnded = document.getElementById('openEnded 2');
const choicesLabel = document.getElementById('choices-label');
const choicesContainer = document.getElementById('choices-container');

multipleChoice.addEventListener('change', () => {
  choicesLabel.style.display = 'block';
  choicesContainer.style.display = 'block';
});

openEnded.addEventListener('change', () => {
  choicesLabel.style.display = 'none';
  choicesContainer.style.display = 'none';
});



const addButton = document.getElementById('add-question');
const container = document.getElementById('questions-container');
let questionNumber = 1;

addButton.addEventListener('click', () => {
  const questionDiv = document.createElement('div');
questionDiv.classList.add('form-group', 'question');
questionDiv.innerHTML = `
  <label for="question-${questionNumber + 1}">Question ${questionNumber + 1}:</label>
  <textarea class="form-control" id="question-${questionNumber + 1}" name="question[]" rows="5" required></textarea>
  <div class="form-group"><br>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="questionnaireType[${questionNumber}]" id="multipleChoice-${questionNumber}" value="multiple_choice">
          <label class="form-check-label" for="multipleChoice-${questionNumber}">Multiple Choice</label>
      </div>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="questionnaireType[${questionNumber}]" id="openEnded-${questionNumber}" value="open_ended" checked>
          <label class="form-check-label" for="openEnded-${questionNumber}">Open Ended</label>
      </div>
      <br><br>
      <label for="choices-${questionNumber}" id="choices-label-${questionNumber}" style="display:none;">Choices:</label>
      <div id="choices-container-${questionNumber}" style="display:none;">
      <div class="form-group">
      <input type="text" class="form-control" name="multipleChoice[${questionNumber}][]" placeholder="A.">
      </div>
      <div class="form-group">
      <input type="text" class="form-control" name="multipleChoice[${questionNumber}][]" placeholder="B.">
      </div>
      <div class="form-group">
      <input type="text" class="form-control"  name="multipleChoice[${questionNumber}][]" placeholder="C.">
      </div>
      <div class="form-group">
      <input type="text" class="form-control" name="multipleChoice[${questionNumber}][]" placeholder="D.">
      </div>
      <div class="form-group">
      <input type="text" class="form-control" name="multipleChoice[${questionNumber}][]" placeholder="E.">
      </div>
      </div>
      <button type="button" class="btn btn-light btn-sm remove-question">Remove</button>
  </div>
`;
const removeButton = questionDiv.querySelector('.remove-question');
removeButton.addEventListener('click', () => {
  container.removeChild(questionDiv);
});


  container.appendChild(questionDiv);
  
  const choicesLabel = document.getElementById(`choices-label-${questionNumber}`);
  const choicesContainer = document.getElementById(`choices-container-${questionNumber}`);
  const multipleChoice = document.getElementById(`multipleChoice-${questionNumber}`);
  const openEnded = document.getElementById(`openEnded-${questionNumber}`);

  multipleChoice.addEventListener('change', (event) => {
    if (event.target.checked) {
      choicesLabel.style.display = 'block';
      choicesContainer.style.display = 'block';
    } else {
      choicesLabel.style.display = 'none';
      choicesContainer.style.display = 'none';
    }
  });

  openEnded.addEventListener('change', (event) => {
    if (event.target.checked) {
      choicesLabel.style.display = 'none';
      choicesContainer.style.display = 'none';
    } else {
      choicesLabel.style.display = 'none';
      choicesContainer.style.display = 'none';
    }
  });

  questionNumber++;
});

</script>
<script>
   $('.select2').select2(
   {
     theme: 'bootstrap4',
   });
   $('.select2-multi').select2(
   {
     multiple: true,
     theme: 'bootstrap4',
   });
   $('.drgpicker').daterangepicker(
   {
     singleDatePicker: true,
     timePicker: false,
     showDropdowns: true,
     locale:
     {
       format: 'MM/DD/YYYY'
     }
   });
   $('.time-input').timepicker(
   {
     'scrollDefault': 'now',
     'zindex': '9999' /* fix modal open */
   });
   /** date range picker */
   if ($('.datetimes').length)
   {
     $('.datetimes').daterangepicker(
     {
       timePicker: true,
       startDate: moment().startOf('hour'),
       endDate: moment().startOf('hour').add(32, 'hour'),
       locale:
       {
         format: 'M/DD hh:mm A'
       }
     });
   }
   var start = moment().subtract(29, 'days');
   var end = moment();
   
   function cb(start, end)
   {
     $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
   }
   $('#reportrange').daterangepicker(
   {
     startDate: start,
     endDate: end,
     ranges:
     {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
     }
   }, cb);
   cb(start, end);
   $('.input-placeholder').mask("00/00/0000",
   {
     placeholder: "__/__/____"
   });
   $('.input-zip').mask('00000-000',
   {
     placeholder: "____-___"
   });
   $('.input-money').mask("#.##0,00",
   {
     reverse: true
   });
   $('.input-phoneus').mask('(000) 000-0000');
   $('.input-mixed').mask('AAA 000-S0S');
   $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ',
   {
     translation:
     {
       'Z':
       {
         pattern: /[0-9]/,
         optional: true
       }
     },
     placeholder: "___.___.___.___"
   });
   // editor
   var editor = document.getElementById('editor');
   if (editor)
   {
     var toolbarOptions = [
       [
       {
         'font': []
       }],
       [
       {
         'header': [1, 2, 3, 4, 5, 6, false]
       }],
       ['bold', 'italic', 'underline', 'strike'],
       ['blockquote', 'code-block'],
       [
       {
         'header': 1
       },
       {
         'header': 2
       }],
       [
       {
         'list': 'ordered'
       },
       {
         'list': 'bullet'
       }],
       [
       {
         'script': 'sub'
       },
       {
         'script': 'super'
       }],
       [
       {
         'indent': '-1'
       },
       {
         'indent': '+1'
       }], // outdent/indent
       [
       {
         'direction': 'rtl'
       }], // text direction
       [
       {
         'color': []
       },
       {
         'background': []
       }], // dropdown with defaults from theme
       [
       {
         'align': []
       }],
       ['clean'] // remove formatting button
     ];
     var quill = new Quill(editor,
     {
       modules:
       {
         toolbar: toolbarOptions
       },
       theme: 'snow'
     });
   }
   // Example starter JavaScript for disabling form submissions if there are invalid fields
   
</script>