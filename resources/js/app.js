require('./bootstrap');

require('alpinejs');

const axios = require('axios');

var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
  keyboard: false
})

var myModalEl = document.getElementById('exampleModal')


myModalEl.addEventListener('hidden.bs.modal', function (event) {
  // do something...
  console.log('hallo1234', $(this).data('lastClicked'))
  $(this).data('lastClicked').css('background-color', '')

})


/**
 * Auf Raum klicken
 */
$('.img-wrap > div').on('click', function () {

  var _parent = this;

  $(this).css('background-color', '#f58220')


  $('#exampleModalLabel b').text('Buchungsmenü ' + $(this).attr('name'))

  $('[name="raum"]').val($(this).data('id'))

  myModal.show()

  $(myModalEl).data('lastClicked', $(this));

})

$('input').on('change', function () {

  axios.get('/getRooms')

    .then(function (response) {
      console.log(response)
    })
    .catch(function (error) {
      console.log(response)
    })
    .then(function () {
    });
});

/**
 * Buchungsformular absenden
 */
$('.btn-primary').on('click', function () {
  console.log('1234hey')

  var start= $('[name="datum"]').val() + ' ' + $('[name="start"]').val();

  var ende= $('[name="datum"]').val() + ' ' + $('[name="ende"]').val();

  var stt = new Date('[name="datum"]').val() + ' ' + $('[name="start"]').val(),
  stt = stt.getTime();

  var endt = new Date('[name="datum"]').val() + ' ' + $('[name="ende"]').val(),
  endt = endt.getTime();

if(stt > endt) {
    $("start").after('<span class="error"><br>Start muss kleiner als Ende sein.</span>');
    $("ende").after('<span class="error"><br>Ende muss kleiner als Start sein.</span>');
        return false;}

  axios.post('/bookRoom', {
    
    notiz: $('[name="notiz"]').val(),
    start: $('[name="datum"]').val() + ' ' + $('[name="start"]').val(),
    ende: $('[name="datum"]').val() + ' ' + $('[name="ende"]').val(),
    datum: $('[name="datum"]').val(),
    raum: $('[name="raum"]').val()

  })
    .then(function (response) {
      console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });
});


$(function() {

  axios.get('/getBookedRoomsNow')
  .then(function(data) {

    console.log('data', data);

    for(var i in data.data) {
      if(data.data.hasOwnProperty(i)) {
        var raumbelegung = data.data[i]

        console.log('belegter raum', data.data[i]);

        $('[data-id="' + raumbelegung['raum'] + '"]').css('backgroundColor', '#ff0000')
      }
    }
  })
})