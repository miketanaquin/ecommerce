
// INDEX  //
function thumbnail0() {
  var thumbnail0 = document.getElementById("thumbnail0").src;
  var splitVal = thumbnail0.split('/');
  console.log(splitVal);
  var newSrc = `${splitVal[5]}/${splitVal[6]}`;
  document.getElementById("index-imgproduct1").src = newSrc;
};
function thumbnail1() {
  var thumbnail1 = document.getElementById("thumbnail1").src;
  var splitVal = thumbnail1.split('/');
  var newSrc = `${splitVal[5]}/${splitVal[6]}`;
  document.getElementById("index-imgproduct1").src = newSrc;
};
function thumbnail2() {
  var thumbnail2 = document.getElementById("thumbnail2").src;
  var splitVal = thumbnail2.split('/');
  var newSrc = `${splitVal[5]}/${splitVal[6]}`;
  document.getElementById("index-imgproduct1").src = newSrc;
};
function thumbnail3() {
  var thumbnail3 = document.getElementById("thumbnail3").src;
  var splitVal = thumbnail3.split('/');
  var newSrc = `${splitVal[5]}/${splitVal[6]}`;
  document.getElementById("index-imgproduct1").src = newSrc;
};

// NAVBAR FUNCTIONS //
function collection() {
  window.location = 'collection.php'
}
function men() {
  window.location = 'men.php'
}
function women() {
  window.location = 'women.php'
}
function logo() {
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

// QUANTITY OF ITEMS //
var numorder = document.getElementById('index-numorder');
var j = 1;

function setVal(val) {
  j = val;
}

function inc() {
  numorder.value = ++j;
}

function dec() {
  var qty = numorder.value;
  if (qty <= 1) {
    numorder.value = 1;
  } else {
    numorder.value = --j;
  }
}

// END OF QUANTITY OF ITEMS  //


// END OF CONTENT //

// MODAL //
var modal = document.getElementById("myModal");

var zoom = document.getElementById("index-imgproduct1");

var span = document.getElementsByClassName("close")[0];

zoom.onclick = function () {
  modal.style.display = "block";
}

span.onclick = function () {
  modal.style.display = "none";
}

function close() {
  modal.style.display = "none";
}


function modalthumbnail0() {
  var modalthumbnail0 = document.getElementById("modalthumbnail0").src;
  var splitVal = modalthumbnail0.split('/');
  var newSrc = `${splitVal[5]}/${splitVal[6]}`;
  document.getElementById("modalimgproduct0").src = newSrc;
};
function modalthumbnail1() {
  var modalthumbnail1 = document.getElementById("modalthumbnail1").src;
  var splitVal = modalthumbnail1.split('/');
  var newSrc = `${splitVal[5]}/${splitVal[6]}`;
  document.getElementById("modalimgproduct0").src = newSrc;
};
function modalthumbnail2() {
  var modalthumbnail2 = document.getElementById("modalthumbnail2").src;
  var splitVal = modalthumbnail2.split('/');
  var newSrc = `${splitVal[5]}/${splitVal[6]}`;
  document.getElementById("modalimgproduct0").src = newSrc;
};
function modalthumbnail3() {
  var modalthumbnail3 = document.getElementById("modalthumbnail3").src;
  var splitVal = modalthumbnail3.split('/');
  var newSrc = `${splitVal[5]}/${splitVal[6]}`;
  document.getElementById("modalimgproduct0").src = newSrc;
};

var slide_Index = 0;
function prev(arr) {
  if (slide_Index <= 0) slide_Index = arr.length; slide_Index--;
  setImg(arr);
};

function next(arr) {
  if (slide_Index >= arr.length - 1) slide_Index = -1; slide_Index++;
  setImg(arr);
};

function setImg(arr) {
  var src = 'imagescollected/' + arr[slide_Index];
  document.getElementById("modalimgproduct0").setAttribute('src', src);
};

document.addEventListener('keydown', function (event) {

  if (event.key == "ArrowLeft") {
    prev();
  } else if (event.key == "Escape") {
    close();
  } else if (event.key == "ArrowRight") {
    next();
  }
}, true);

// END OF MODAL //




