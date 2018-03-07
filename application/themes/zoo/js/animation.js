$(function(){
  // $('svg').each(function(i,v){
  //   var svg = v;
  //   var bbox = svg.getBBox();
  //   var viewBox = [bbox.x, bbox.y, bbox.width, bbox.height].join(" ");
  //   svg.setAttribute("viewBox", viewBox);
  // });

  $('svg').click(function(){
    $('g').each((i, elem)=>{clone = elem.cloneNode(true); elem.parentNode.replaceChild(clone, elem);});
  });
});
