<nav>
    <a href="appointment_form.php">Make an Appointment</a>
    <?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        echo '<a href="report.php">Generate Report</a>';
    }
    ?>
</nav>
