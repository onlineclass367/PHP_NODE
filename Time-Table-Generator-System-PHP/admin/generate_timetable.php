<?php session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ttgaid']==0)) {
  header('location:logout.php');
  } else{

$classes = $dbh->query("SELECT id FROM classes")->fetchAll(PDO::FETCH_ASSOC);
    $classrooms = $dbh->query("SELECT id FROM classrooms")->fetchAll(PDO::FETCH_ASSOC);
    $timeslots = $dbh->query("SELECT id FROM timeslots")->fetchAll(PDO::FETCH_ASSOC);

    // Clear previous timetable
    $dbh->exec("DELETE FROM timetable");

    // Prepare SQL statements
    $subjectStmt = $dbh->prepare("SELECT subject_id FROM class_subject WHERE class_id = :class_id");
    $teacherStmt = $dbh->prepare("SELECT teacher_id FROM teacher_subject WHERE subject_id = :subject_id");
    $checkStmt = $dbh->prepare("SELECT COUNT(*) FROM timetable WHERE teacher_id = :teacher_id AND timeslot_id = :timeslot_id");
    $insertStmt = $dbh->prepare("INSERT INTO timetable (class_id, subject_id, teacher_id, classroom_id, timeslot_id) 
                                  VALUES (:class_id, :subject_id, :teacher_id, :classroom_id, :timeslot_id)");

    // Assign classes, subjects, teachers, and classrooms
    foreach ($classes as $class) {
        $class_id = $class['id'];

        // Fetch subjects assigned to this class
        $subjectStmt->execute(['class_id' => $class_id]);
        $subjects = $subjectStmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($timeslots as $timeslot) {
            if (empty($subjects)) continue; // Skip if no subjects assigned

            // Shuffle subjects to randomize selection
            shuffle($subjects);

            foreach ($subjects as $subject) {
                $subject_id = $subject['subject_id'];

                // Get the teacher for this subject
                $teacherStmt->execute(['subject_id' => $subject_id]);
                $teacher = $teacherStmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$teacher) continue; // Skip if no teacher found
                $teacher_id = $teacher['teacher_id'];

                // Check if the teacher is already assigned at this time
                $checkStmt->execute(['teacher_id' => $teacher_id, 'timeslot_id' => $timeslot['id']]);
                $isAssigned = $checkStmt->fetchColumn();

                if ($isAssigned) continue; // Skip this slot if teacher is already occupied

                // Random classroom assignment
                $classroom = $classrooms[array_rand($classrooms)];
                $classroom_id = $classroom['id'];

                // Insert into timetable
                $insertStmt->execute([
                    'class_id' => $class_id,
                    'subject_id' => $subject_id,
                    'teacher_id' => $teacher_id,
                    'classroom_id' => $classroom_id,
                    'timeslot_id' => $timeslot['id']
                ]);

                break; // Ensure only one subject per timeslot per class
            }
        }
    }

echo '<script>alert("Class-wise Timetable generated successfully!")</script>';
echo '<script>window.location.href ="time-table.php"</script>';


} 

?>
