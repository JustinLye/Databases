<?php
require_once('../output_functs.php');
require_once('../dbtools.php');
class q1 {
    public static $PartA_InputFormString = "<h3>Query that involves one table. (1.a)</h3>
                <p>Fill out the form and click the submit button to add a user to the table</p>
                <div class=\"usr-form\">
                    <form action=\"q1.php\" method=\"post\" id=\"add_user_form\">
                        <table>
                            <tr>
                                <td>User Name:</td>
                                <td><input type=\"text\" name=\"name\" size=\"32\" placeholder=\"Enter User Name...\" /></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><input type=\"email\" name=\"email\" size=\"128\" placeholder=\"Enter Email Address...\" /></td>
                            </tr>
                            <tr>
                                <td>User Type:</td>
                                <td>
                                    <select name=\"type\">
                                        <option value=\"diner\">Diner</option>
                                        <option value=\"restaurant\">Restaurant</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td><input type=\"password\" name=\"password\" placeholder=\"Enter a password...\" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type=\"submit\" name=\"submit\" value=\"Add User\" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <p>Table before adding new user.<p>";
    public static $PartA_AfterFailedInsertString = "<h3>Query that involves one table. (1.a)</h3>
                <p style=\"color: red;\">Add user failed</p>
                <p>Fill out the form and click the submit button to add a user to the table</p>
                <div class=\"usr-form\">
                    <form action=\"q1.php\" method=\"post\" id=\"add_user_form\">
                        <table>
                            <tr>
                                <td>User Name:</td>
                                <td><input type=\"text\" name=\"name\" size=\"32\" placeholder=\"Enter User Name...\" /></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><input type=\"email\" name=\"email\" size=\"128\" placeholder=\"Enter Email Address...\" /></td>
                            </tr>
                            <tr>
                                <td>User Type:</td>
                                <td>
                                    <select name=\"type\">
                                        <option value=\"diner\">Diner</option>
                                        <option value=\"restaurant\">Restaurant</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td><input type=\"password\" name=\"password\" placeholder=\"Enter a password...\" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type=\"submit\" name=\"submit\" value=\"Add User\" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <p>Table before adding new user.</p>";
    public static $PartA_AfterSuccessfulInsertString = "<h3>Query that involves one table. (1.a)</h3>
                <p style=\"color: green;\">New user successfully added</p>
                <p>Fill out the form and click the submit button to add a user to the table</p>
                <div class=\"usr-form\">
                    <form action=\"q1.php\" method=\"post\" id=\"add_user_form\">
                        <table>
                            <tr>
                                <td>User Name:</td>
                                <td><input type=\"text\" name=\"name\" size=\"32\" placeholder=\"Enter User Name...\" /></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><input type=\"email\" name=\"email\" size=\"128\" placeholder=\"Enter Email Address...\" /></td>
                            </tr>
                            <tr>
                                <td>User Type:</td>
                                <td>
                                    <select name=\"type\">
                                        <option value=\"diner\">Diner</option>
                                        <option value=\"restaurant\">Restaurant</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td><input type=\"password\" name=\"password\" placeholder=\"Enter a password...\" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type=\"submit\" name=\"submit\" value=\"Add User\" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <p>Table <strong>after</strong> adding new user.</p>";
}

class q6 {
    public static $AddUserFormString =
                "<div class=\"usr-form\">
                    <form action=\"q6.php\" method=\"post\" id=\"add_user_form\">
                        <table>
                            <tr>
                                <td>User Name:</td>
                                <td><input type=\"text\" name=\"name\" size=\"32\" placeholder=\"Enter User Name...\" /></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><input type=\"email\" name=\"email\" size=\"128\" placeholder=\"Enter Email Address...\" /></td>
                            </tr>
                            <tr>
                                <td>User Type:</td>
                                <td>
                                    <select name=\"type\">
                                        <option value=\"diner\">Diner</option>
                                        <option value=\"restaurant\">Restaurant</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td><input type=\"password\" name=\"password\" placeholder=\"Enter a password...\" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type=\"submit\" name=\"submit\" value=\"Add User\" /></td>
                            </tr>
                        </table>
                    </form>
                </div>";
    public static $QuestionHeading = "<h3>Implement a Trigger</h3>
                <p>Fill out the form and click the submit button to add a user to the table.<br>
                A trigger will be invoked that inserts a record, depending on the user type, into the diner or restaurant table.</p>";
    public static $BeforeInsertPromptString01 = "<p>User Table <strong>before</strong> adding new user.</p>";
    public static $BeforeInsertPromptString02 = "<p>Diner users <strong>before</strong> adding new user.</p>";
    public static $BeforeInsertPromptString03 = "<p>Restaurant users <strong>before</strong> adding new user.</p>";
    
    public static $AfterInsertPromptString01 = "<p>User Table <strong>after</strong> adding new user.</p>";
    public static $AfterInsertPromptString02 = "<p>Diner users <strong>after</strong> adding new user.</p>";
    public static $AfterInsertPromptString03 = "<p>Restaurant users <strong>after</strong> adding new user.</p>";
    
    public static $AddUserSuccessPromptString = "<p>User successfully added.</p>";
    public static $AddUserFailurePromptString = "<p>User failed to be added.</p>";
}