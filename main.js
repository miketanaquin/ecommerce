// NAVBAR FUNCTIONS ALL //
function collection() {
    window.location = 'collection.php'
  }
  function men() {
    window.location = 'men.php'
  }
  function women() {
    window.location = 'women.php'
  }
  function logo () {
    window.location = 'homepage.php'
  }
  function avatar() {
    document.getElementById("myDropdownAvatar").classList.toggle("show");
  }
  window.onclick = function (event) {
    if (!event.target.matches('.icon')) {
        var dropdowns = document.getElementsByClassName("dropdown-avatar");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
function opensidebar() {
    document.getElementById("mySidebar").style.width = "230px";
  }
  
  function closesidebar() {
    document.getElementById("mySidebar").style.width = "0";
  }
// END OF NAVBAR ALL //

