<?php
// Include database connection
include('partials/menu.php'); 
include('../config/constants.php');

// Fetch feedback records from database
$result = mysqli_query($conn, "SELECT * FROM customer_feedback ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
        }

        .review-box {
            background: white;
            max-width: 700px;
            margin: 15px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.1);
        }

        .review-box h4 {
            margin: 0;
            color: #007bff;
        }

        .rating {
            color: #ffc107;
            margin-left: 10px;
        }

        .date {
            color: #888;
            font-size: 0.9em;
        }

        .comment {
            margin-top: 10px;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Customer Reviews</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="review-box">
                <h4>
                    <?= htmlspecialchars($row['customer_name']) ?>
                    <span class="rating"><?= str_repeat('⭐', (int)$row['rating']) ?></span>
                </h4>
                <div class="date">
                    <?= date("F j, Y, g:i a", strtotime($row['submitted_at'])) ?>
                </div>
                <div class="comment">
                    <?= nl2br(htmlspecialchars($row['comment'])) ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center;">No feedback has been submitted yet.</p>
    <?php endif; ?>
</body>
</html>
<?php include('partials/footer.php'); ?>