<html>
    <body>
<h1>Les Annuleren</h1>

<form method="post" action="CancelLessonController.php">
    <input type="hidden" name="action" value="saveMessage">
    <input type="hidden" name="lessonId" value="<?php echo $lessonId; ?>">
    <textarea name="message" placeholder="Voer hier je bericht in"></textarea>
    <button type="submit">Bericht opslaan</button>
    

</form>
</body>
</html>