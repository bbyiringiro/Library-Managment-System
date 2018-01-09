<?php
include_once 'include/func.php';
if (isset($_GET['allstud'])){
export('all_student');header("location:admin.php");}
elseif (isset($_GET['report'])){
exportReport('students_debts');header("location:admin.php");}