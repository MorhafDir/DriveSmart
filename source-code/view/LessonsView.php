<?php
require_once '../controller/LessonController.php';

$lesson = new Lesson();

$lessons = $lesson->getAllLessons();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Driving School DriveSmart - Lessons</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Driving School DriveSmart - Lessons</h1>
        <nav>
            <?php include 'templates/navbar.php'; ?>
        </nav>
    </header>
    <main>


        <table>
            <tr>
                <th>Lesson ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
            <?php foreach ($lessons as $lesson): ?>
                <tr>
                    <td><?php echo $lesson['lesson_id']; ?></td>
                    <td>
                        <form action="../controller/LessonController.php" method="post">
                            <input type="hidden" name="action" value="updateLesson">
                            <input type="hidden" name="lessonId" value="<?php echo $lesson['lesson_id']; ?>">
                            <input type="date" name="date" value="<?php echo $lesson['date']; ?>">
                    </td>
                    <td><input type="time" name="time" value="<?php echo $lesson['time']; ?>"></td>

                    

                    <td>
                        <button type="submit">Edit</button>
                        </form>
                        <form action="../controller/LessonController.php" method="post">
                            <input type="hidden" name="action" value="deleteLesson">
                            <input type="hidden" name="lessonId" value="<?php echo $lesson['lesson_id']; ?>">
                            <button type="submit">Cancel</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>


</body>

</html>