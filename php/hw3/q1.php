<!DOCTYPE html>
<html>
<head>
    <title>Part 3 Q1</title>
    <link rel="stylesheet" href="../../css/default.css">
    <style>
        .info_msg p {
            font-family: 'Droid Sans', sans-serif;
            font-size: 16pt;
            color: blue;
        }
        .info_msg h3 {
            font-family: 'Droid Sans', sans-serif;
            font-size: 28pt;
        }
    </style>
</head>
<body>
    <ul class="nav-bar">
        <li><a href="../../index.html">Home</a></li>
        <li class="dropdown">Assigned Project
            <span class="dropdown-content">
                <a href="q1.php">Part 3 Q1</a>
                <a href="q2.php">Part 3 Q2</a>
                <a href="q6.php">Part 3 Q6</a>
            </span>
        </li>
    </ul>
    <?php
        require_once('hw3funcs.php');
        $srvr_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        switch ($srvr_method) {
            case "GET":
                echo "<span class=\"info_msg\">" . q1::$PartA_InputFormString . "</span>";
                echo util::to_html_table(util::active_user_v_headings(), get_user_table());
		break;
            case "POST":
                if(!add_user(
                        filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST, 'email' , FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING))) {
                    echo "<p>Errors have occurred. " . msg::$last_error . "</p>";
                    echo "<span class=\"info_msg\">" . q1::$PartA_AfterFailedInsertString . "</span>";
                } else {
                    echo "<span class=\"info_msg\">" . q1::$PartA_AfterSuccessfulInsertString . "</span>";
                }
                echo util::to_html_table(util::active_user_v_headings(), get_user_table());
                break;
        }
    ?>
</body>
</html>
	
