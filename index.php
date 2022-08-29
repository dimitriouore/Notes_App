<?php

$connection = require_once './lib/pdo.php';
$notes = $connection -> getNotes();

$currentNote = [
    'id' => '',
    'title' => '',
    'description' => ''
];
if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>

    <div class="notes" id="app">
        <div class="notes__sidebar">
            <div class="notes_listing">
                <div class="notes__list">
                <?php foreach ($notes as $notes__list_item): ?>
                <div class="notes__list_item notes__list_item__selected">
                    
                    <div class="notes__small-title" id="update_note">
                        <a href="?id=<?php echo $notes__list_item['id'] ?>"><?php echo $notes__list_item['title'] ?></a>
                    </div>

                    <div class="notes__small-body">
                        <?php echo $notes__list_item['description'] ?>
                    </div>
                    
                    <div class="notes__small-updated">
                        <?php echo $notes__list_item['create_date'] ?>   
                    </div>
                    
                    <form action="./lib/delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $notes__list_item['id'] ?>">
                        <button class="close">X</button>    
                    </form>
                </div>
                <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="notes__preview">  
        <div id="myModal" class="modal">
	        <div class="modal-content">
                <div class="modal-header">
	                <CENTER> <h2>New Note</h2> </CENTER>
	            </div>
                <div class="modal-body">
		            <CENTER>
		            <form class="form-container" action="./lib/create.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $currentNote['id'] ?>"> 
			            <input type="text" name="title" placeholder="Add title" name="title" autocomplete="off" 
                            value="<?php echo $currentNote['title'] ?>" required>
                        <textarea type="text" name="description" rows="5"
                            placeholder="Note description" required><?php echo $currentNote['description'] ?></textarea>
		                <button class='btn btn-primary'>
                            <?php if ($currentNote['id']): ?>
                                Update
                            <?php else: ?>
                                New note
                            <?php endif ?>
                        </button>
                    </form>
		            </CENTER>
	            </div>
	        </div>  
        </div>
    </div>
</body>
</html>