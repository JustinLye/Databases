<!DOCTYPE html>
<html>
<head>
    <title>Part 3 Q6</title>
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
        echo q6::$TriggerSourceFile;
        echo "<span class=\"info_msg\">" . q6::$QuestionHeading . "</span>";
        switch (filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING)) {
            case "GET":
                echo "<span class=\"info_msg\">" . q6::$AddUserFormString . "</span>";
                echo "<span class=\"info_msg\">" . q6::$BeforeInsertPromptString01 . "</span>";
                echo util::to_html_table_chg_width(util::active_user_v_headings(), get_user_table(), "50%");
                echo "<span class=\"info_msg\">" . q6::$BeforeInsertPromptString02 . "</span>";
                echo util::to_html_table_chg_width(array('User ID', 'Diner ID', 'User Name'), get_diner_table(), "35%");
                echo "<span class=\"info_msg\">" . q6::$BeforeInsertPromptString03 . "</span>";
                echo util::to_html_table_chg_width(array('User ID', 'Restaurant ID', 'User Name'), get_restaurant_table(), "35%");
                break;
            case "POST":
                if(!add_user(
                        filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST, 'email' , FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING))) {
                    echo "<span class=\"info_msg\">" . q6::$AddUserFailurePromptString . "</span>";
                    echo "<span class=\"info_msg\"><p>Errors have occurred. " . msg::$last_error . "</p></span>";
                } else {
                    echo "<span class=\"info_msg\">" . q6::$AddUserSuccessPromptString . "</span>";
                }   
                echo "<span class=\"info_msg\">" . q6::$AddUserFormString . "</span>";
                echo "<span class=\"info_msg\">" . q6::$AfterInsertPromptString01 . "</span>";
                echo util::to_html_table_chg_width(util::active_user_v_headings(), get_user_table(), "50%");
                echo "<span class=\"info_msg\">" . q6::$AfterInsertPromptString02 . "</span>";
                echo util::to_html_table_chg_width(array('User ID', 'Diner ID', 'User Name'), get_diner_table(), "35%");
                echo "<span class=\"info_msg\">" . q6::$AfterInsertPromptString03 . "</span>";
                echo util::to_html_table_chg_width(array('User ID', 'Restaurant ID', 'User Name'), get_restaurant_table(), "35%");
                break;                
        }
            
        
    ?>
</body>
</html>
