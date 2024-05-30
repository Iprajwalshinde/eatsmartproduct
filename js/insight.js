document.addEventListener('DOMContentLoaded', function() {
    loadPosts(1);

    document.getElementById('reportFallacyForm').addEventListener('submit', function(e) {
        e.preventDefault();
        reportFallacy();
    });
});

function loadPosts(page) {
    fetch(`ajax/fetch_posts.php?page=${page}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('posts-container').innerHTML = data.posts;
            document.getElementById('pagination').innerHTML = data.pagination;
        });
}

function showReportModal(postId) {
    document.getElementById('postId').value = postId;
    $('#reportFallacyModal').modal('show');
}

function reportFallacy() {
    const postId = document.getElementById('postId').value;
    const reason = document.getElementById('reason').value;

    fetch('ajax/report_fallacy.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ postId, reason }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('messageAlert').classList.add('green');
            document.getElementById('messageAlert').innerText = "Report Submitted successfully!";
            setTimeout(() => {
                $('#reportFallacyModal').modal('hide');
            }, 3000);
        } else {
            document.getElementById('messageAlert').classList.add('red');
            document.getElementById('messageAlert').innerText = "Failed to submit report!";
        }
    });
}
function closeModal(){
    $('#reportFallacyModal').modal('hide');
}