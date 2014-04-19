<?php
require_once 'NaturalUser.php';
function check(&$post, $n){
    global $db;
    foreach ($n as $value){
        if(empty($post[$value])){
            echo "empty field";
            exit();
        }
        $post[$value]= $db->escapeString(trim($post[$value]));
    }
}
    if(isset($_POST['submited'])){
        global $db;
        if($_POST['type']==1){
            $n=array("username", "password", "email", "phone", "mobile", "first", "last", "address", "city", "country");
            check($_POST, $n);
            try{         
                $user= new NaturalUser($db, $_POST['username'], sha1($_POST['password']), $_POST['email'],$_POST['phone'],
                        $_POST['mobile'], $_POST['first'], $_POST['last'], $_POST['address'], $_POST['city'], $_POST['country']);
                $user->authenticate($_POST['username'], $_POST['password']);
                $id=$user->create();
                echo 'user created with id: '. $id;
        } catch (Exception $e){ echo $e->getMessage(); }
        }
    } else {
        echo 'nije submitovana forma';
    }
?>
<html>
    <head>
        <title>Registration</title>
    </head>
    <body>
        <form method="POST" action="registration.php">
            <table>
                <tr><td>User name:</td><td><input type="text" name="username"></td></tr>
                <tr><td>Password:</td><td><input type="text" name="password"></td></tr>
                <tr><td>Email:</td><td><input type="text" name="email"></td></tr>
                <tr><td>Phone:</td><td><input type="text" name="phone"></td></tr>
                <tr><td>Mobile:</td><td><input type="text" name="mobile"></td></tr>
                <tr><td>User type:</td><td><select name="type">
                            <option value="1">natural person</option>
                            <option value="2">legal person</option>
                        </select></td></tr>
                <tr><td colspan="2" align="center">Natural user</td></tr>
                <tr><td>First name:</td><td><input type="text" name="first"></td></tr>
                <tr><td>Last name:</td><td><input type="text" name="last"></td></tr>
                <tr><td>Address:</td><td><input type="text" name="address"></td></tr>
                <tr><td>City:</td><td><input type="text" name="city"></td></tr>
                <tr><td>Country:</td><td><input type="text" name="country"></td></tr>
                 <tr><td colspan="2" align="center">Legal user</td></tr>
                 <tr><td>Company name:</td><td><input type="text" name="companyname"></td></tr>
                 <tr><td>Company address:</td><td><input type="text" name="companyaddress"></td></tr>
                 <tr><td>Company city:</td><td><input type="text" name="companycity"></td></tr>
                 <tr><td>Company country:</td><td><input type="text" name="companycountry"></td></tr>
                 <tr><td>Tax number:</td><td><input type="text" name="tax"></td></tr>
                <tr><td>Fax:</td><td><input type="text" name="fax"></td></tr>
                <tr><td colspan="2" align="center"><input type="submit" name="submited" value="register"></td></tr>
            </table>
        </form>
    </body>
</html>