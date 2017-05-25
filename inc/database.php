<?php

mysqli_report(MYSQLI_REPORT_STRICT);

function open_database() 
{
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        return $conn;
    } catch (Exception $e) {
        echo $e->getMessage();
        return null;
    }
}

function close_database($conn) 
{
    try {
        mysqli_close($conn);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function find( $table = null, $id = null ) 
{  
    $database = open_database();
    $found = null;
    try {
        if ($id) {
            $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                $found = $result->fetch_assoc();
            }
        } else {
            $sql = "SELECT * FROM " . $table;
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                $numRows = $result->num_rows;
                for ($i=0; $i < $numRows; $i++) { 
                    $found[$i] = $result->fetch_assoc();
                }
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
    
    return $found;
}

function find_all( $table ) 
{
    return find($table);
}

function save($table = null, $data = null) 
{
    $database = open_database();
    $columns = null;
    $values = null;
    //print_r($data);
    foreach ($data as $key => $value) {
        $columns .= trim($key, "'") . ",";
        $values .= "'$value',";
    }
    // remove a ultima virgula
    $columns = rtrim($columns, ',');
    $values = rtrim($values, ',');

    $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
    try {
        $database->query($sql);
        $_SESSION['message'] = 'Registro cadastrado com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (Exception $e) { 
        $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        $_SESSION['type'] = 'danger';
    } 
    close_database($database);
}

function update($table = null, $id = 0, $data = null) 
{
    $database = open_database();
    $items = null;
    foreach ($data as $key => $value) {
        $items .= trim($key, "'") . "='$value',";
    }
    // remove a ultima virgula
    $items = rtrim($items, ',');
    $sql  = "UPDATE " . $table;
    $sql .= " SET $items";
    $sql .= " WHERE id=" . $id . ";";
    try {
        $database->query($sql);
        $_SESSION['message'] = 'Registro atualizado com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (Exception $e) { 
        $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        $_SESSION['type'] = 'danger';
    } 
    close_database($database);
}

function remove( $table = null, $id = null ) 
{
    $database = open_database();

    try {
        if ($id) {
            $sql = "DELETE FROM " . $table . " WHERE id = " . $id;
            $result = $database->query($sql);
            if ($result = $database->query($sql)) {       
                $_SESSION['message'] = "Registro Removido com Sucesso.";
                $_SESSION['type'] = 'success';
            }
        }
    } catch (Exception $e) { 
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
    close_database($database);  
}
