<?php
// Start session for authentication checks
session_start();

// Example static student data (Replace this section with your database queries, e.g., MySQLi or PDO)
$students = [
    [
        'id' => 1,
        'name' => 'Sophia Rose',
        'email' => 'sophia.rose@example.com',
        'course' => 'Computer Science',
        'year' => '3rd Year'
    ],
    [
        'id' => 2,
        'name' => 'Isabella Chen',
        'email' => 'isabella.c@example.com',
        'course' => 'Information Technology',
        'year' => '2nd Year'
    ],
    [
        'id' => 3,
        'name' => 'Emma Watson',
        'email' => 'emma.w@example.com',
        'course' => 'Software Engineering',
        'year' => '4th Year'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>

    <!-- Bootstrap 5 CSS (Required for Grid, Flexbox, and Modals) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS (Link to your stylesheet here) -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container my-5">
        <!-- HEADER / NAVIGATION -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h1 class="m-0">Student Directory</h1>
                <p class="text-pink-200 opacity-75 m-0 small">Manage registered students and academic profiles</p>
            </div>
            
            <div class="d-flex gap-2">
                <!-- Add Student Button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                    + Add Student
                </button>
                
                <!-- Logout Button -->
                <a href="logout.php" class="btn btn-logout text-decoration-none d-inline-flex align-items-center">
                    Logout
                </a>
            </div>
        </div>

        <!-- STUDENT TABLE -->
        <div class="table-responsive">
            <table class="table w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Email Address</th>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($students)): ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td>#<?= htmlspecialchars($student['id']) ?></td>
                                <td class="fw-semibold"><?= htmlspecialchars($student['name']) ?></td>
                                <td><?= htmlspecialchars($student['email']) ?></td>
                                <td><?= htmlspecialchars($student['course']) ?></td>
                                <td><?= htmlspecialchars($student['year']) ?></td>
                                <td class="text-center">
                                    <!-- Edit Button -->
                                    <button 
                                        type="button" 
                                        class="btn btn-warning btn-sm px-3 me-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editStudentModal"
                                        data-id="<?= $student['id'] ?>"
                                        data-name="<?= htmlspecialchars($student['name']) ?>"
                                        data-email="<?= htmlspecialchars($student['email']) ?>"
                                        data-course="<?= htmlspecialchars($student['course']) ?>"
                                        data-year="<?= htmlspecialchars($student['year']) ?>">
                                        Edit
                                    </button>
                                    
                                    <!-- Delete Button -->
                                    <a 
                                        href="delete_student.php?id=<?= $student['id'] ?>" 
                                        class="btn btn-danger btn-sm px-3"
                                        onclick="return confirm('Are you sure you want to delete this student record?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No student records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ADD STUDENT MODAL -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="add_student.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="addName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="addName" name="name" placeholder="e.g. Jane Doe" required>
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="addEmail" name="email" placeholder="e.g. jane@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="addCourse" class="form-label">Course / Major</label>
                            <input type="text" class="form-control" id="addCourse" name="course" placeholder="e.g. Computer Science" required>
                        </div>
                        <div class="mb-3">
                            <label for="addYear" class="form-label">Year Level</label>
                            <select class="form-control" id="addYear" name="year" required>
                                <option value="" disabled selected>Select Year Level</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT STUDENT MODAL -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">Edit Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="edit_student.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">
                        
                        <div class="mb-3">
                            <label for="editName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCourse" class="form-label">Course / Major</label>
                            <input type="text" class="form-control" id="editCourse" name="course" required>
                        </div>
                        <div class="mb-3">
                            <label for="editYear" class="form-label">Year Level</label>
                            <select class="form-control" id="editYear" name="year" required>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JavaScript Bundle (Includes Popper for Modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Populate Edit Modal Script -->
    <script>
        const editModal = document.getElementById('editStudentModal');
        if (editModal) {
            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                
                document.getElementById('editId').value = button.getAttribute('data-id');
                document.getElementById('editName').value = button.getAttribute('data-name');
                document.getElementById('editEmail').value = button.getAttribute('data-email');
                document.getElementById('editCourse').value = button.getAttribute('data-course');
                document.getElementById('editYear').value = button.getAttribute('data-year');
            });
        }
    </script>
</body>
</html>