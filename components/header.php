<?php
// Prototype data - replace with db queries in part 2
include("data.php");

// Gets the logged in users details from the current session if available
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Logged in as admin by default during development
    // Delete these 2 lines and uncomment the next 2 in production
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = "admin";
    // header("location: login.php");
    // exit;
}

// Lists the pages for navigation. The "users" array determines which user types can access that page
$pages = [
    array(
        "name" => "Problems",
        "link" => "index.php",
        "users" => ["admin", "analyst", "operator", "specialist"]
    ),
    array(
        "name" => "Specialists",
        "link" => "specialists.php",
        "users" => ["admin", "analyst", "operator"]
    ),
    array(
        "name" => "Company Equipment",
        "link" => "company-equipment.php",
        "users" => ["admin", "analyst", "operator", "specialist"]
    ),
    array(
        "name" => "Analytics",
        "link" => "analytics.php",
        "users" => ["admin", "analyst"]
    ),
    array(
        "name" => "Operator Activity",
        "link" => "operator-activity.php",
        "users" => ["admin", "analyst"]
    ),
    array(
        "name" => "Specialist Activity",
        "link" => "specialist-activity.php",
        "users" => ["admin", "analyst"]
    ),
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title ? $title : "Make-It-All Helpdesk" ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section>
        <div class="primary-nav">
            <div class="container">
                <div class="navbar">
                    <div>
                        <a href="index.php" class="logo">
                            Make-It-All
                            <span>Helpdesk</span>
                        </a>
                    </div>
                    <div>
                        <span class="text-gray-300" style="font-size: .875rem">Signed in as <?php echo $_SESSION["username"]; ?></span>
                        <a href="php/logout.php" class="nav-link">Sign Out</a>
                    </div>
                </div>
                <nav>
                    <?php
                    // Adds all the pages that the user currently logged in has access to to the navigation
                    foreach ($pages as $page) {
                        if (in_array(strtolower($_SESSION["username"]), $page["users"])) {
                            if ($page["name"] == $title)
                                echo '<a href="' . $page["link"] . '" class="nav-link active">' . $page["name"] . '</a>';
                            else
                                echo '<a href="' . $page["link"] . '" class="nav-link">' . $page["name"] . '</a>';
                        }
                    }
                    ?>
                </nav>
            </div>
        </div>