<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Tax Calculator - Result</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Service Tax Calculator - Result</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $amount = $_POST["amount"];
            $frequency = $_POST["frequency"];

            if (!is_numeric($amount)) {
                echo '<div class="alert alert-danger" role="alert">Please enter a valid numeric amount.</div>';
            } else {
                // Adjust annual salary based on frequency
                $annualSalary = ($frequency == 'monthly') ? $amount * 12 : $amount * 24;

                // Computation for annual tax based on income ranges
                if ($annualSalary <= 250000) {
                    $annualTax = 0;
                } elseif ($annualSalary <= 400000) {
                    $basicAmount = 0;
                    $additionalRate = 0.20;
                    $excessOver = 250000;
                    $annualTax = $basicAmount + ($additionalRate * ($annualSalary - $excessOver));
                } elseif ($annualSalary <= 800000) {
                    $basicAmount = 22500;
                    $additionalRate = 0.25;
                    $excessOver = 400000;
                    $annualTax = $basicAmount + ($additionalRate * ($annualSalary - $excessOver));
                } elseif ($annualSalary <= 2000000) {
                    $basicAmount = 102500;
                    $additionalRate = 0.30;
                    $excessOver = 800000;
                    $annualTax = $basicAmount + ($additionalRate * ($annualSalary - $excessOver));
                } elseif ($annualSalary <= 8000000) {
                    $basicAmount = 402500;
                    $additionalRate = 0.32;
                    $excessOver = 2000000;
                    $annualTax = $basicAmount + ($additionalRate * ($annualSalary - $excessOver));
                } else {
                    $basicAmount = 2202500;
                    $additionalRate = 0.35;
                    $excessOver = 8000000;
                    $annualTax = $basicAmount + ($additionalRate * ($annualSalary - $excessOver));
                }

                // Computation for monthly tax
                $monthlyTax = round($annualTax / 12, 2);

                echo '<div class="alert alert-success" role="alert">';
                echo "<p>Annual Salary: ₱" . number_format($annualSalary, 2) . "</p>";
                echo "<p>Annual Tax: ₱" . number_format($annualTax, 2) . "</p>";
                echo "<p>Monthly Tax: ₱" . number_format($monthlyTax, 2) . "</p>";
                echo '</div>';
            }
        } else {
            header("Location: index.php");
            exit();
        }
        ?>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>