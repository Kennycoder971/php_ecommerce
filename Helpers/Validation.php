<?php 

class Validation {
    public static function is_password_match (string $password, string $confirm_password) {
        return $password === $confirm_password;
    }

    public static function verify_password (string $login_password, string $hashed_password) {
      return password_verify($login_password, $hashed_password);
    }

    public static function isFileImage(string $fileInputName) {
        $allowedTypes = array("image/jpeg", "image/png", "image/gif");
        return in_array($_FILES[$fileInputName]["type"], $allowedTypes);
    }

    public static function isFileSizeExeeding(int $fileSizeInMb, int $fileSize) {
        $maxFileSize = $fileSizeInMb * 1024 * 1024;
        return $fileSize > $maxFileSize;
    }
}