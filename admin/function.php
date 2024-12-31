<?php

include('config.php');

function select($sql, $values = [], $datatypes = '')
{
    $conn = $GLOBALS['conn'];

    // Prepare the SQL query
    if ($readyquery = mysqli_prepare($conn, $sql)) {
        // Bind parameters only if there are values to bind
        if (!empty($values) && !empty($datatypes)) {
            mysqli_stmt_bind_param($readyquery, $datatypes, ...$values);
        }

        // Execute the statement
        if (mysqli_stmt_execute($readyquery)) {
            $result = mysqli_stmt_get_result($readyquery);
            mysqli_stmt_close($readyquery);
            return $result;
        } else {
            mysqli_stmt_close($readyquery);
            die("Query Not Executed - Select");
        }
    } else {
        die("Query Not Prepared - Select");
    }
}


function insert($sql, $values, $datatypes)
{
    $conn = $GLOBALS['conn'];
    if ($queryprepared = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($queryprepared, $datatypes, ...$values);
        if (mysqli_stmt_execute($queryprepared)) {
            $result = mysqli_stmt_affected_rows($queryprepared);
            mysqli_stmt_close($queryprepared);
            return $result;
        } else {
            mysqli_stmt_close($queryprepared);
            die("Query Not Executed - Insert");
        }
    } else {
        die("Query Not Prepared - Insert");
    }
}

function update($sql, $values, $datatypes)
{
    $conn = $GLOBALS['conn'];
    if ($queryprepared = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($queryprepared, $datatypes, ...$values);
        if (mysqli_stmt_execute($queryprepared)) {
            $result = mysqli_stmt_affected_rows($queryprepared);
            mysqli_stmt_close($queryprepared);
            return $result;
        } else {
            // Provide more detailed error information
            $error = mysqli_stmt_error($queryprepared);
            mysqli_stmt_close($queryprepared);
            die("Query Not Executed - Update: $error");
        }
    } else {
        die("Query Not Prepared - Update");
    }
}

function updateIdAvaliable($sql, $values, $datatypes) {
    $conn = $GLOBALS['conn'];
    if ($queryprepared = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($queryprepared, $datatypes, ...$values);
        if (mysqli_stmt_execute($queryprepared)) {
            $result = mysqli_stmt_affected_rows($queryprepared);
            mysqli_stmt_close($queryprepared);
            return $result; // Return the number of affected rows
        } else {
            // Provide detailed error information
            $error = mysqli_stmt_error($queryprepared);
            mysqli_stmt_close($queryprepared);
            die("Query Not Executed - Update: $error");
        }
    } else {
        die("Query Not Prepared - Update");
    }
}

function delete($sql, $values, $datatypes)
{
    $conn = $GLOBALS['conn'];
    if ($preparequery = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($preparequery, $datatypes, ...$values);
        if (mysqli_stmt_execute($preparequery)) {
            $result = mysqli_stmt_affected_rows($preparequery);
            mysqli_stmt_close($preparequery);
            return $result;
        } else {
            mysqli_stmt_close($preparequery);
            die('Query Not Executed - Delete');
        }
    } else {
        die('Query Not Prepared - Delete');
    }
}

function selectquerydata($tablename, $recordtype)
{
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $tablename)) {
        die("Invalid table name");
    }
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM $tablename WHERE recordtype = ?";
    $value = [$recordtype];
    return select($sql, $value, 's');
}

function selectalldata($tablename)
{
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $tablename)) {
        die("Invalid table name");
    }
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM $tablename";
    $result = mysqli_query($conn, $sql) or die("Query Failed - Select All Data");
    return $result;
}

function selectSingleValue($sql, $params, $param_types)
{
    // Assuming you have an existing mysqli connection
    global $conn;

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {

        // Bind the parameters to the statement
        $stmt->bind_param($param_types, ...$params);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the first row (single value)
        $row = $result->fetch_assoc();

        // Close the statement
        $stmt->close();

        // Return the value of the first column
        return $row ? array_values($row)[0] : null;
    } else {
        // Handle query error
        return null;
    }
}

function selectSingleParams($sql, $params = [], $param_types = '')
{
    // Assuming you have an existing mysqli connection
    global $conn;

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {

        // Bind parameters only if there are any
        if (!empty($params) && $param_types) {
            $stmt->bind_param($param_types, ...$params);
        }

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the first row (single value)
        $row = $result->fetch_assoc();

        // Close the statement
        $stmt->close();

        // Return the value of the first column
        return $row ? array_values($row)[0] : null;
    } else {
        // Handle query error
        return null;
    }
}

// This is the fetch function using MySQLi
function fetch($sql, $values = [], $types = '') {
    global $conn;  // Assuming $conn is your MySQLi connection

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        // Handle error in preparing statement
        echo "Error in preparing the statement: " . $conn->error;
        return false;
    }

    // Bind parameters if any
    if ($values) {
        $stmt->bind_param($types, ...$values);
    }

    // Execute the statement
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result()->fetch_assoc();  // Fetch associative array

    return $result ? $result : false; // Return the fetched result or false if no result
}

function selectSingleRow($query, $params, $param_types) {
    // Database connection (replace with your connection details)
    global $conn;
    // Prepare the SQL statement
    $stmt = $conn->prepare($query);

    // Bind parameters
    if (!empty($params)) {
        $stmt->bind_param($param_types, ...$params);
    }

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the single row
    $row = $result->fetch_assoc();

    // Free result and close statement
    $result->free();
    $stmt->close();


    // Return the single row
    return $row;
}


