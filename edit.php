<?php
ob_start();
session_start();
include_once 'template/header.php';
include_once 'database/connection.php';
include_once 'helper.php';


$message = $_SESSION['message'] ??  "";

// remove message
unset($_SESSION['message']);

?>

<main class="container my-3">

    <h6 class="display-6 text-center text-info mb-2">
        To-Do List
    </h6>

    <!-- Message -->
    <div>
        <?php if ($message): ?>
        <div>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Waring: </strong>
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php
    $conn = getConnection();
    if (isset($_GET['id'])) {
        if (is_numeric($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            message("No such item to edit");
            header('Location:index.php');
            die();
        }
    }
    $checkQuery = "select * from lists where id=$id";
    $checkResult = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($checkResult) < 1) {

        message("No such item to edit");
        header('Location:index.php');
        die();
    }

    $getListItemQuery = "select * from lists where id=$id";
    $result = mysqli_query($conn, $getListItemQuery);
    $list = mysqli_fetch_assoc($result);

    if (isset($_POST['rename'])) {
        $item = $_POST['item'];
        $renameQuery = "update lists set item='$item' where id=$id";
        $result = mysqli_query($conn, $renameQuery);
        if ($result) {
            message("Rename successfully");
            header("Location:index.php");
        } else {
            message("Rename failed");
        }
    }

    ?>

    <!-- Create Todo List Item -->
    <form action="" method="post">

        <div class="mb-3">
            <input class="form-control" type="text" name="item" placeholder="Rename Item" value="<?= $list['item'] ?>">
        </div>

        <div class="text-end">
            <button class="btn btn-outline-primary" type="submit" name="rename">Rename</button>

        </div>
    </form>



</main>



<?php
include_once 'template/footer.php';
ob_flush();
?>