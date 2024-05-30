<?php
include '../connections.php';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

//Fetch posts
$result = $mysqli->query("SELECT * FROM insight ORDER BY dateadd DESC LIMIT $limit OFFSET $offset");
$posts = '';
while ($row = $result->fetch_assoc()) {
    $dateadd = $row['dateadd']; // Example: '2024-05-26 22:02:00'

// Create a DateTime object from the date string
$date = new DateTime($dateadd);
$formattedDate = $date->format('F j, Y g:i A');
    $posts .= '
    <div class="custom-block custom-block-topics-listing bg-white shadow-lg mb-5">
        <div class="d-flex">
            <div class="custom-block-topics-listing-info d-flex">    
                <div>
                    <span class="datePost">'.$formattedDate.'</span>
                    <span class="badge bg-advertising ms-auto tag-badge">'.$row['tag_Category'].'</span>
                    <h5 class="mb-2 mt-2">'.$row['title'].'</h5>
                    <p class="mb-0">'.$row['description'].'</p>
                    <a href="javascript:void(0);" class="reportPost mt-3 mt-lg-4" onclick="showReportModal('.$row['id'].')">Report Fallacy</a>
                </div>
            </div>
        </div>
    </div>';
}

// Fetch total posts count for pagination
$total_result = $mysqli->query("SELECT COUNT(*) as total FROM insight");
$total_posts = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_posts / $limit);

$pagination = '';
for ($i = 1; $i <= $total_pages; $i++) {
    $active = $i == $page ? 'active' : '';
    $pagination .= '<li class="page-item '.$active.'"><a class="page-link" href="javascript:void(0);" onclick="loadPosts('.$i.')">'.$i.'</a></li>';
}

echo json_encode(['posts' => $posts, 'pagination' => $pagination]);
?>
