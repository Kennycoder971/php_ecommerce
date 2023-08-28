<?php 

require_once "Validation.php";
function base_url() {
    return BASE_URL;
}
function assets() {
    return BASE_URL."Assets/";
}

function createImgURL($imgName) {
    return BASE_URL."Assets/images/".$imgName;
}

function productImage($product) {
    $img = isset($product['imgUrl']) ? base_url(). $product['imgUrl'] : assets().'images/noImage.jpeg';
    return $img;
}
function dep($data) {
    $format = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}

function strClean($str) {
    $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $str);
    $string = trim($string); // Elimina espacios en blanco al inicio y al final
    $string = stripslashes($string); // Elimina las \ invertidas
    $string = str_ireplace("<script>", "", $string);
    $string = str_ireplace("</script>", "", $string);
    $string = str_ireplace("<script src>", "", $string);
    $string = str_ireplace("<script type=>", "", $string);
    $string = str_ireplace("SELECT * FROM", "", $string);
    $string = str_ireplace("DELETE FROM", "", $string);
    $string = str_ireplace("INSERT INTO", "", $string);
    $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
    $string = str_ireplace("DROP TABLE", "", $string);
    $string = str_ireplace("OR '1'='1'", "", $string);
    $string = str_ireplace('OR "1"="1"', "", $string);
    $string = str_ireplace('OR ´1´=´1´', "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("LIKE '", "", $string);
    $string = str_ireplace('LIKE "', "", $string);
    $string = str_ireplace("LIKE ´", "", $string);
    $string = str_ireplace("OR 'a'='a", "", $string);
    $string = str_ireplace('OR "a"="a', "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("--", "", $string);
    $string = str_ireplace("^", "", $string);
    $string = str_ireplace("[", "", $string);
    $string = str_ireplace("]", "", $string);
    $string = str_ireplace("==", "", $string);
    return $string;
}

function generateBcryptPassword($str) {
    $options = [
        'cost' => 12,
    ];
    return password_hash($str, PASSWORD_BCRYPT, $options);
}

// SESSIONS
function isSessionActive() {
    return session_status() === PHP_SESSION_ACTIVE;
}

function getUserSession() {
    if(!isSessionActive()) session_start();
    
    if (isset($_SESSION['userData'])) {
        return $_SESSION['userData'];
    } else {
        return null; // No active session
    }
}

function setSession($userData) {
    if(!isSessionActive()) session_start();
    $_SESSION['userData'] = $userData;
}

// END SESSIONS

function token() {
    $r1 = bin2hex(random_bytes(10));
    $r2 = bin2hex(random_bytes(10));
    $r3 = bin2hex(random_bytes(10));
    $r4 = bin2hex(random_bytes(10));
    $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
    return $token;
}

function formatMoney($cantidad) {
    $cantidad = number_format($cantidad, 2, SPD, SPM);
    return $cantidad;
}

function destroySession() {
    session_start();
    $_SESSION = array();
    session_destroy();
    
}

// FILE UPLOAD

function isInputFileEmpty($fileInputName) {
    return isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_NO_FILE;
}
function uploadImage ($fileInputName) {
    $arr =  [
        'error' => '',
        'targetFile' => '',
    ]; 
    
    if (!isInputFileEmpty($fileInputName)) {
        
        // Check if the uploaded file is an image
        if (!Validation::isFileImage($fileInputName)) {
            $arr['error'] = "Only JPEG PNG and GIF images are allowed.";
            return $arr;
        }

        // Check if the file size is less than 6MB (6,000,000 bytes)
        $maxFileSize = 6;
        if (Validation::isFileSizeExeeding($maxFileSize, $_FILES["image"]["size"])) {
            $arr['error'] = "Error: The file size should be less than $maxFileSize MB.";
            return $arr;
        }

        // Set the target folder where you want to store the image
        $targetDir = 'Assets/images/uploads/products/';

        // Generate a unique name
        $uniqueName = uniqid('image_',true);
        $fileExtension = pathinfo($_FILES[$fileInputName]['name'], PATHINFO_EXTENSION );
        $targetFile = $targetDir . $uniqueName . '.' .$fileExtension;
        
        // Upload image and return a boolean
        $isImageUploaded = move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile  );

        if (!$isImageUploaded) {
           $arr['error'] = "Failed to upload image.";
           return $arr;
        } 
        
        $arr['targetFile'] = $targetFile;
        return $arr;
        
    } else {
        $arr['error'] = "You have to upload an image.";
        return $arr;
    }
}


// END FILE UPLOAD