function fetchRecords(page = 1) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `pages/ajax/fetch_reportFallacy.php?page=${page}`, true);
    xhr.onload = function() {
        if (this.status === 200) {
            const response = JSON.parse(this.responseText);
            const tableBody = document.getElementById('reportTableBody');
            const pagination = document.getElementById('pagination');
            tableBody.innerHTML = '';
            pagination.innerHTML = '';

            response.records.forEach(record => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${record.count}</td>
                    <td>${record.datetime}</td>
                    <td>${record.title}</td>
                    <td class="text-danger">${record.reportFallacy} Times</td>
                    <td><a href="#" class="open-modal" data-id="${record.id}"><label class="badge badge-info c-pointer">Open</label></a></td>
                `;
                tableBody.appendChild(row);
            });

            // Pagination
            for (let i = 1; i <= response.totalPages; i++) {
                const pageLink = document.createElement('a');
                pageLink.href = '#';
                pageLink.innerText = i;
                pageLink.classList.add('page-link');
                if (i === page) {
                    pageLink.style.fontWeight = 'bold';
                }
                pageLink.onclick = function(event) {
                    event.preventDefault();
                    fetchRecords(i);
                }
                pagination.appendChild(pageLink);
            }

            // Attach modal open event listeners
            document.querySelectorAll('.open-modal').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const id = this.getAttribute('data-id');
                    openModal(id);
                });
            });
        }
    };
    xhr.send();
}

// Open modal with details
function openModal(id) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `pages/ajax/reportFallacy_details.php?id=${id}`, true);
    xhr.onload = function() {
        if (this.status === 200) {
            const record = JSON.parse(this.responseText);
            document.getElementById('modalDateTime').innerText = record.datetime;
            document.getElementById('modalTitle').innerText = record.title;
            document.getElementById('modalDescription').innerText = record.description;
            document.getElementById('modalTag').innerText = record.tag_Category;
            document.getElementById('modalReportTimes').innerText = record.reportFallacy+" Times";
            document.getElementById('deleteButton').setAttribute('data-id', record.id);
            document.getElementById('detailModal').style.display = 'block';
        }
    };
    xhr.send();
}

// Delete record
document.getElementById('deleteButton').addEventListener('click', function() {
    const id = this.getAttribute('data-id');
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'pages/ajax/delete_record.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status === 200) {
            alert('Record deleted successfully');
            document.getElementById('detailModal').style.display = 'none';
            fetchRecords();
        }
    };
    xhr.send(`id=${id}`);
});

// Close modal
document.querySelector('.closeDelete').addEventListener('click', function() {
    document.getElementById('detailModal').style.display = 'none';
});
function closeDelete(){
    document.getElementById('detailModal').style.display = 'none';
}

// Initial fetch
fetchRecords();