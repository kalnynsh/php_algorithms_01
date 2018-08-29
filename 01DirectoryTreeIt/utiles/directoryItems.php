<?php

defined('ROOT') or define('ROOT', __DIR__);

$path = $_SERVER['PATH_INFO'] ?: ROOT . '/../';
$directoryIt = new DirectoryIterator($path);

foreach ($directoryIt as $entry) {
    // Allow ./?hidden to show hidden files
    if ($_SERVER['QUERY_STRING'] == 'hidden') {
        $hide = '';
        $ahref = './';
        $atext = 'Hide';
    } else {
        $hide = '.';
        $ahref = './?hidden';
        $atext = 'show';
    }

    // Separates directories
    if ($entry->isDir()) {
        $class = 'dir';
        $extn = '&lt;Directory&gt;';
        $size = $entry->getSize();
        $name = $entry->getFilename();
        $namehref = $entry->getPathname();
    }
    // Cleans up . and .. dirs
    if ($entry->isDot()) {
        if ($entry->getFilename() == '.') {
            $name = '. (CurrentDirectory)';
            $extn = '&lt;System Dir&gt;';
            $namehref = $entry->getPathname();
        }
        if ($entry->getFilename() == '..') {
            $name = '.. (ParentDirectory)';
            $extn = '&lt;System Dir&gt;';
            $namehref = $entry->getPathname();
        }
    }
    // Not like .hiddenFile
    if ($entry->isFile() && (substr($entry->getFilename(), 0, 1) != $hide)) {
        $class = 'file';
        // Gets File names
        $name = $entry->getFilename();
        $namehref = $entry->getPathname();

        // Gets extensions
        $extn = $entry->getExtension();

        // Gets file size
        $size = $entry->getSize();

        // Prettifies File Types, add more to suit your needs.
        switch ($extn) {
            case "png":$extn = "PNG Image";
                break;
            case "jpg":$extn = "JPEG Image";
                break;
            case "svg":$extn = "SVG Image";
                break;
            case "gif":$extn = "GIF Image";
                break;
            case "ico":$extn = "Icon";
                break;

            case "txt":$extn = "Text File";
                break;
            case "log":$extn = "Log File";
                break;
            case "html":$extn = "HTML File";
                break;
            case "php":$extn = "PHP Script";
                break;
            case "js":$extn = "Javascript";
                break;
            case "css":$extn = "Stylesheet";
                break;
            case "pdf":$extn = "PDF Document";
                break;

            case "zip":$extn = "ZIP Archive";
                break;
            case "bak":$extn = "Backup File";
                break;

            default:$extn = strtoupper($extn) . " File";
                break;
        }
    }

    // Gets date Modified data
    $modetime = date('j M Y H:i:s', $entry->getATime());
    $timekey = date('YmdHis', $entry->getATime());

    // Print
    echo "
            <tr class='$class'>
                <td><a href='$namehref'>$name</a></td>
                <td><a href='$namehref'>$extn</a></td>
                <td><a href='$namehref'>$size</a></td>
                <td sorttable_customkey='$timekey'><a href='./$namehref'>$modetime</a></td>
            </tr>
        ";
}
