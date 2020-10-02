var input = document.getElementById('input');
var output_head = document.getElementById("head");
var output_body = document.getElementById("body");
var div = document.getElementById("confirm");
var addButton = document.getElementById('add');
var addField = document.getElementById('addBox');
var xhr = new XMLHttpRequest();
function isset() {
    return input.value != "";
}
if (isset()) {
    xhr.open("GET", "server.php?q=" + input.value);
    xhr.send();
}
input.onkeyup = function () {
    xhr.open("GET", "server.php?q=" + input.value);
    xhr.send();
}

xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        output_head.innerHTML = "<tr><th>ID</th><th>Name</th><th>Actions</th></tr>"
        output_body.innerHTML = this.responseText;
    }
}

function confirmation(id) {
    var r = confirm("You are going to delete an item..");
    if (r == true) {
        xhr.open("GET", "server.php?d=" + id + "&q=" + input.value);
        xhr.send();
    }
}
function add() {
    addField.style.display = "none";
    var elem = document.getElementById('name');
    xhr.open("GET", "server.php?u=" + elem.value + "&q=" + input.value);
    elem.value = "";
    xhr.send();
}
function edit(id) {
    var parent = document.getElementById('edit');
    var box = document.getElementById('edit-text');
    box.value = "";
    parent.style.display = "block";
    document.getElementById('edit1').addEventListener("click", function () {
        var value = box.value;
        xhr.open("GET", "server.php?e=" + id + "&text=" + value + "&q=" + input.value);
        parent.style.display = "none";
        xhr.send();
    })
}

addButton.addEventListener("click",function(){
    addField.style.display = "block";
})
