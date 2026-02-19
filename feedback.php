<?php
include('partials-front/menu.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $rating = (int)$_POST['rating'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    if ($name && $rating >= 1 && $rating <= 5 && $comment) {
        $sql = "INSERT INTO customer_feedback (customer_name, rating, comment)
                VALUES ('$name', $rating, '$comment')";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            $success = "Thank you for your feedback!";
        } else {
            $error = "Error submitting feedback.";
        }
    } else {
        $error = "Please fill in all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Feedback</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            padding: 30px;
        }

        .feedback-form {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .stars {
            display: flex;
            gap: 10px;
            margin: 12px 0;
            font-size: 24px;
            cursor: pointer;
        }

        .stars span {
            color: #ccc;
            transition: color 0.3s;
        }

        .stars span.selected,
        .stars span:hover,
        .stars span:hover ~ span {
            color: #ffc107;
        }

        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 12px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="feedback-form">
    <h2>Leave Your Feedback</h2>

    <?php if (isset($success)) echo "<div class='message success'>$success</div>"; ?>
    <?php if (isset($error)) echo "<div class='message error'>$error</div>"; ?>

    <form method="POST">
        <label>Your Name</label>
        <input type="text" name="name" required>

        <label>Rating</label>
        <div class="stars" id="starRating">
            <span data-value="1">&#9733;</span>
            <span data-value="2">&#9733;</span>
            <span data-value="3">&#9733;</span>
            <span data-value="4">&#9733;</span>
            <span data-value="5">&#9733;</span>
        </div>
        <input type="hidden" name="rating" id="ratingInput" required>

        <label>Your Comments</label>
        <textarea name="comment" rows="4" required></textarea>

        <button type="submit">Submit Feedback</button>
    </form>
</div>

<script>
    const stars = document.querySelectorAll('#starRating span');
    const ratingInput = document.getElementById('ratingInput');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            const rating = star.getAttribute('data-value');
            ratingInput.value = rating;

            stars.forEach(s => s.classList.remove('selected'));
            for (let i = 0; i <= index; i++) {
                stars[i].classList.add('selected');
            }
        });
    });
</script>
</body>
</html>
