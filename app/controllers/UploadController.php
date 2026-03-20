<?php

//* Load helper for JSON responses */
require_once __DIR__ . "/../helpers/Response.php";

/* Handles file upload */
class UploadController {

    /* Upload file function */
    public static function  uploadFile() {

        try {

            /* No file or empty upload */
            if (!isset($_FILES["file"]) || $_FILES["file"]["error"] == 4) {
                Response::json(false, "No file uploaded", null, 400);
            }

            /* Get file */
            $file = $_FILES["file"];

            /* Check errors */
            if ($file["error"] !== 0) {

                /* Check if file is too large (server limit) */
                if ($file["error"] == 1) {
                    Response::json(false, "File exceeds server limit", null, 400);
                }
                /* Other upload errors */
                Response::json(false, "Upload error", null, 400);
            }

            /* Check size (2MB limit in app) */
            if ($file["size"] > 2 * 1024 * 1024) {
                Response::json(false, "File too big (max 2MB)", null, 400);
            }

            /* Allowed file types */
            $allowed = ["jpg","jpeg","png","pdf"];

            /* Get file extension */
            $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

            /* Validate type */
            if (!in_array($ext, $allowed)) {
                Response::json(false, "Invalid file type", null, 400);
            }

            /* Create random file name */
            $newName = bin2hex(random_bytes(8)) . "." . $ext;

            /* Set save path */
            $path = __DIR__ . "/../../uploads/" . $newName;

            /* Move file to folder */
            move_uploaded_file($file["tmp_name"], $path);

            /* Success response */
            Response::json(true, "File uploaded", [
                "file" => $newName
            ], 200);

        } catch (Exception $e) {

            /* Error fallback */
            Response::error("Upload failed", 500);

        }
    }
}