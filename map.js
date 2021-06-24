/* Adapted from https://www.kirupa.com/snippets/move_element_to_click_position.htm, 02.15.2019
*/

var dot = document.querySelector("#dot");
var container = document.querySelector("#contentContainer");

// get dimensions of img
var img = document.getElementById('map'); 
var imgwidth = img.clientWidth;
var imgheight = img.clientHeight;

// sets canvas dimensions to same as image
var contentContainer = document.querySelector("#contentContainer");
contentContainer.width = imgwidth;
contentContainer.height = imgheight;

container.addEventListener("click", getClickPosition, false);

// function that gets the coordinates
function getClickPosition(e) {
    var parentPosition = getPosition(e.currentTarget);
    var xPosition = e.clientX - parentPosition.x - (dot.clientWidth / 2);
    var yPosition = e.clientY - parentPosition.y - (dot.clientHeight / 2);

    var coords = "Coordinates x: " + xPosition + ", y: " + yPosition; // string to display coordinates
    //document.getElementById("click_location").innerHTML = coords; // display coords string
	document.getElementById("xcoord").value = xPosition;
	document.getElementById("ycoord").value = yPosition;

    // moves dot by changing css
    dot.style.left = xPosition + "px";
    dot.style.top = yPosition + "px";
}
 
// Helper function to get an element's exact position
function getPosition(el) {
  var xPos = 0;
  var yPos = 0;
 
  while (el) {
    if (el.tagName == "BODY") {
      // deal with browser quirks with body/window/document and page scroll
      var xScroll = el.scrollLeft || document.documentElement.scrollLeft;
      var yScroll = el.scrollTop || document.documentElement.scrollTop;
 
      xPos += (el.offsetLeft - xScroll + el.clientLeft);
      yPos += (el.offsetTop - yScroll + el.clientTop);
    } else {
      // for all other non-BODY elements
      xPos += (el.offsetLeft - el.scrollLeft + el.clientLeft);
      yPos += (el.offsetTop - el.scrollTop + el.clientTop);
    }
 
    el = el.offsetParent;
  }
  return {
    x: xPos,
    y: yPos
  };
}