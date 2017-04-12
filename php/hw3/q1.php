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
                <a href="q2.php">Part 3 Q2</a>
            </span>
        </li>
    </ul>
    <?php
        require_once('hw3funcs.php');
        $functs = new q1;
        $srvr_method = filter_var($_SERVER['REQUEST_METHOD']);
        switch ($srvr_method) {
            case "GET":
                echo "<span class=\"info_msg\">" . q1::$PartA_InputFormString . "</span>";
                if(!$user_view = $functs->get_user_table()) {
                    echo $functs->errors();
                }
                util::to_html_table(util::active_user_v_headings(), $functs->get_user_table());
		break;
            case "POST":
                if(!$functs->add_user($_POST['name'], $_POST['email'], $_POST['password'], $_POST['type'])) {
                    echo "<p>Errors have occurred.</p>";
                    echo $functs->errors();
                    echo "<span class=\"info_msg\">" . q1::$PartA_AfterFailedInsertString . "</span>";
                } else {
                    echo "<span class=\"info_msg\">" . q1::$PartA_SuccessfulInsertString . "</span>";
                }
        }

    ?>
</body>
</html>
	