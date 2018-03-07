$(function(){
  // $('svg').each(function(i,v){
  //   var svg = v;
  //   var bbox = svg.getBBox();
  //   var viewBox = [bbox.x, bbox.y, bbox.width, bbox.height].join(" ");
  //   svg.setAttribute("viewBox", viewBox);
  // });

  $('#btnRestart').click(function(){
    $('svg').each(function(i,v){
      var elm = v;
      var newone = elm.cloneNode(true);
      elm.parentNode.replaceChild(newone, elm);
    });
  });
});
