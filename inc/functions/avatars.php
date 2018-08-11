<?php

	require_once __DIR__ . '/../config/avatars.php';


	function hasAvatar($userId)
	{
		return file_exists(__DIR__ . '/../../img/avatars/' . $userId . '.png');
	}


	function deleteAvatar($userId)
	{
		unlink(__DIR__ . '/../../img/avatars/' . $userId . '.png');
	}


	function processUploadedAvatar($userId)
	{
		$errorMessages = [];

		do
		{
			if (!isset($_FILES['avatar']['error'])
				|| is_array($_FILES['avatar']['error'])
				|| $_FILES['avatar']['error'] !== UPLOAD_ERR_OK
			)
			{
				$errorMessages[] = MSG_AVATAR_GENERAL_ERROR;
				break;
			}

			$finfo = new finfo(FILEINFO_MIME_TYPE);
			$fileExtension = array_search($finfo->file($_FILES['avatar']['tmp_name']), [
				'jpg' => 'image/jpeg',
				'png' => 'image/png',
				'gif' => 'image/gif',
			], true);

			if ($fileExtension === false)
			{
				$errorMessages[] = MSG_AVATAR_WRONG_FILE_FORMAT;
				break;
			}

			$filename = $_FILES['avatar']['tmp_name'];

			$avatar = loadImage($filename, $fileExtension);
			if ($avatar === null)
			{
				$errorMessages[] = MSG_AVATAR_WRONG_FILE_FORMAT;
				break;
			}

			$avatar = resizeImage($avatar, AVATAR_MAX_DIMENSIONS);

			imagepng($avatar, __DIR__ . '/../../img/avatars/' . $userId . '.png');

			imagedestroy($avatar);
		} while (false);

		return $errorMessages;
	}


	function loadImage($path, $ext)
	{
		switch ($ext)
		{
			case 'png':
				return imagecreatefrompng($path);
			case 'jpg':
			case 'jpeg':
				return imagecreatefromjpeg($path);
			case 'gif':
				return imagecreatefromgif($path);
			default:
				return null;
		}
	}


	function resizeImage($src, $maxDim)
	{
		$srcWidth = imagesx($src);
		$srcHeight = imagesy($src);

		$destWidth = min($srcWidth, $maxDim);
		$destHeight = min($srcHeight, $maxDim);
		$factor = ($srcWidth < $srcHeight) ? $destHeight / $srcHeight : $destWidth / $srcWidth;

		$destWidth = round($srcWidth * $factor);
		$destHeight = round($srcHeight * $factor);

		$dest = imagecreatetruecolor($destWidth, $destHeight);
		imagealphablending($dest, false);
		imagesavealpha($dest, true);

		imagecopyresampled($dest, $src, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight);

		return $dest;
	}