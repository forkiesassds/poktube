<?php
include("header.php");
// Load Last 10 Git Logs
$git_history = [];
$git_logs = [];
exec("git log", $git_logs);

// Parse Logs
$last_hash = null;
foreach ($git_logs as $line)
{
    // Clean Line
    $line = trim($line);

    // Proceed If There Are Any Lines
    if (!empty($line))
    {
        // Commit
        if (strpos($line, 'commit') === 0)
        {
            $hash = explode(' ', $line);
            $hash = trim(end($hash));
            $git_history[$hash] = [
                'message' => ''
            ];
            $last_hash = $hash;
        }

        // Author
        else if (strpos($line, 'Author') !== false) {
            $author = explode(':', $line);
            $author = trim(end($author));
            $git_history[$last_hash]['author'] = $author;
        }

        // Date
        else if (strpos($line, 'Date') !== false) {
            $date = explode(':', $line, 2);
            $date = trim(end($date));
            $git_history[$last_hash]['date'] = date('F j, Y, g:i a', strtotime($date));
        }

        // Message
        else {
            $git_history[$last_hash]['message'] .= $line ." ";
        }
    }
}

echo "TODO: Improve this, and make it look better. prehaps pagination and PFP loading would be epic.";
echo "<pre>";
print_r($git_history);
echo "</pre>";
include("footer.php");
?>