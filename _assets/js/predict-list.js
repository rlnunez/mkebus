$("#bus-predict-btn").click(function(e) {
  hash.stpid   =  $('#stid').val(),
  hash.rt      =  $('#rt').val();
  newHash(hash);
  clearListUpdate();
  updateListvar = setInterval(
    function() {
      updateList();
    }, 60000);
  updateList();
});

$("#rt-predict-btn").click(function(e) {
  hash.stpid   =  $('#rt-stop').val(),
  hash.rt      =  $('#bus-rt-num').val();
  hash.dir     =  $('#rt-dir').val();
  newHash(hash);
  clearListUpdate();
  updateListvar = setInterval(
    function() {
      updateList();
    }, 60000);
  updateList();
});

function updateList() {
  $('#loadingSpinner').show();
  hash = hashtoObj(window.location.hash);
  if (typeof hash.rt == 'undefined') {
      hash.rt = '';
  }
  $('.list-group, .error-message').empty();

  var listURL = './_assets/json/list-predictions.php?stid=' + hash.stpid + '&rt=' + hash.rt;
  console.log(listURL);
  $.getJSON(listURL, function(data) {
    $.each(data, function(k, v) {
      $('.list-group').append(v);
    });
  });
  $('#loadingSpinner').hide();
}

function newHash(updateHash) {
  var newhash = '#' + ObjtoStr(updateHash);
  window.location.hash = newhash;
}

function clearListUpdate() {
  clearInterval(updateListvar);
}

function ObjtoStr(obj) {
  var str = '';
  for (var key in obj) {
    if (obj.hasOwnProperty(key)) {
      str += key + "=" + obj[key] + "&";
    }
  }
  str = str.slice(0, str.length - 1);
  return str;
}