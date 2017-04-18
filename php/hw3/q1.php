<!DOCTYPE html>
<html>
<head>
    <title>Part 3 Q1</title>
    <link rel="stylesheet" href="../../css/default.css">
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
        echo "<span class=\"info_msg\">" . q1::$PartA_QuestionHeading . "</span>";
        switch (filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING)) {
            case "GET":
                echo "<span class=\"info_msg\">" . q1::$PartA_FillFormPrompt . "</span>";
                //echo q1::$AddUserForm;
                echo get_signup_form("q1.php");
                echo "<span class=\"info_msg\">" . q1::$PartA_BeforePromptString01 . "</span>";
                echo util::to_html_table(util::active_user_v_headings(), get_user_table());
                echo "<span class=\"info_msg\">" . q1::$PartB_QuestionHeading . "</span>";
		break;
            case "POST":
                if(!sign_up(
                        filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST, 'email' , FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING))) {
                    echo "<p>Errors have occurred. " . msg::$last_error . "</p>";
                    echo "<span class=\"info_msg\">" . q1::$PartA_AfterFailedInsertString . "</span>";
                } else {
                    echo "<span class=\"info_msg\">" . q1::$PartA_AfterSuccessfulInsertString . "</span>";
                }                    
                echo "<span class=\"info_msg\">" . q1::$PartA_FillFormPrompt . "</span>";
                echo get_signup_form("q1.php");
                echo "<span class=\"info_msg\">" . q1::$PartA_AfterPromptString01 . "</span>";               
                echo util::to_html_table(util::active_user_v_headings(), get_user_table());
                break;
        }
    ?>
</body>
</html>
	
