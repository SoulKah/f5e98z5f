$(function(){
  var currencies = [
      { value: 'Alfaromeo', data: 'Alfaromeo' },
      { value: 'Audi', data: 'Audi' },
      { value: 'Citro&euml;n', data: 'Citroën' },
      { value: 'BMW', data: 'BMW' },
      { value: 'Ford', data: 'Ford' },
      { value: 'Landrover', data: 'Landrover' },
      { value: 'Mercedes', data: 'Mercedes' },
      { value: 'Opel', data: 'Opel' },
      { value: 'Peugeot', data: 'Peugeot' },
      { value: 'Renault', data: 'Renault' },
      { value: 'Seat', data: 'Seat' },
      { value: 'Skoda', data: 'Skoda' },
      { value: 'Volkswagen', data: 'Volkswagen' },
      { value: 'Volvo', data: 'Volvo' },
  ];

  
  $('#autocomplete').autocomplete({
    lookup: currencies,
    onSelect: function (suggestion) {
      $('#outputcontent').html(thehtml);
    }
  });

});