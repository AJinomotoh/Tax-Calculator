<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxxy: A Tax Calculator</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="header-container">
                    <!-- Header with the updated styles -->
                    <h1 class="text-center mb-4">Taxxy: A Tax Calculator</h1>
                    <!-- Icon at the right side of the header -->
                    <img src="images/calc.png" alt="Icon" class="header-image">
                </div>
                <form action="index.php" method="post">
                    <div class="form-group">
                        <label for="amount">Enter Amount:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" class="form-control" id="amount" name="amount" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Type:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="frequency" id="biMonthly" value="biMonthly" checked>
                                <label class="form-check-label" for="biMonthly">Bi-Monthly</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>&nbsp;</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="frequency" id="monthly" value="monthly">
                                <label class="form-check-label" for="monthly">Monthly</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="custom-btn-primary">Calculate Tax</button>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $amount = $_POST["amount"];
                    $frequency = $_POST["frequency"];

                    if (!is_numeric($amount)) {
                        echo '<div class="alert alert-danger mt-4" role="alert">Please enter a valid numeric amount.</div>';
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

                        echo '<div class="alert alert-success mt-4" role="alert">';
                        echo "<p>Annual Salary: ₱" . number_format($annualSalary, 2) . "</p>";
                        echo "<p>Annual Tax: ₱" . number_format($annualTax, 2) . "</p>";
                        echo "<p>Monthly Tax: ₱" . number_format($monthlyTax, 2) . "</p>";
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>