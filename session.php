<?php
session_start();
if (!isset($_SESSION["userlogged"])){
    $_SESSION["userlogged"] = false;
}
?>