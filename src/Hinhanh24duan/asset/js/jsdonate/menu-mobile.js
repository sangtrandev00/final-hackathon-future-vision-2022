// menu mobile
var btn_menu = document.getElementById("btnmenu");
btn_menu.addEventListener("click", function () {
  var item_menu = document.getElementById("menutop");
  if (item_menu.style.display === "block") {
    item_menu.style.display = "none";
  } else {
    item_menu.style.display = "block";
  }
})