var modal = document.getElementById("insightModal");

var btn = document.getElementById("openModalBtn");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}
function closeInsight(){
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

document.getElementById("insightForm").onsubmit = function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/submit_insight.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert("Insight submitted successfully!");
            modal.style.display = "none";
            document.getElementById("insightForm").reset();
        } else {
            alert("An error occurred while submitting the insight.");
        }
    };
    xhr.send(formData);
}